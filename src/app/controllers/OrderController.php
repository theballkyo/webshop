<?php
class OrderController extends BaseController
{

	public function __construct()
    {
        $this->beforeFilter('auth.admin');
    }

	/**
	 * New order
	 * Create new order 
	 *
	 */
	public function newOrder($pid = 1)
	{
		$pid = 1;
		$detail = [
			'pd_c' => $this->getField($pid, 1),
		    'pd_s' => $this->getField($pid, 2),
		    'cus'  => CustomerProfile::orderBy('name', 'ASC')->get()
		];
		foreach ($detail['pd_c'] as $c) {
			foreach ($detail['pd_s'] as $s) {
				$code = $this->generateCode($pid, array($c->id, $s->id));
				$stock = $this->stockProduct($code);
				$detail['stock'][$c->id][$s->id]['stock'] = $stock->stock;
				$detail['stock'][$c->id][$s->id]['code'] = $stock->id;
			}
		}
		# print '<pre>';
		# dd($detail['pd_s'][0]);
		return View::make('admins.order.new', $detail);
	}

	/**
	 * Create New order
	 *
	 */
	public function postNewOrder()
	{
		Input::flash();

		$rules = array('amount' => 'required');
		$cus_id = Input::get('old_cus');
		if(empty($cus_id))
		{
			$rules = array_add($rules, 'name', 'required');
		}

		$validator = Validator::make(Input::all(), $rules);

		if($validator->fails())
		{
			return Redirect::action('AdminController@newOrder')->withErrors($validator->messages());
		}

		if(empty($cus_id))
		{
			$customer = New CustomerProfile;
			$customer->name = Input::get('name');
			$customer->address = Input::get('address');
			$customer->email = Input::get('email');
			$customer->tel = Input::get('tel');
			$customer->note = Input::get('note');
			$customer->save();
			$cus_id = $customer->id;
		}
		foreach (Input::get('amount') as $id => $amount) {
			if((int) $amount > 0)
			{
				$stock = ProductsStock::find($id);
				$stock->stock -= abs($amount);
				$stock->save();

				$reserve = New ProductsReserve;
				$reserve->stock_id = $stock->id;
				$reserve->code_id = $stock->code;
				$reserve->amount = $amount;
				$reserve->cus_id = $cus_id;
				$reserve->save();
				$reserve_id[] = $reserve->id;
			}
		}
		$order = New Order;
		$order->reserve_id = implode(',', $reserve_id);
		$order->cus_id = $cus_id;
		$order->source = $this->source[Input::get('source')];
		$order->save();

		return Redirect::action('AdminController@viewOrder')->with('msg', 'Created Order!');
	}

	/**
	 * View all orders
	 *
	 */
	public function viewOrder()
	{
		$type = !empty(Input::get('type')) ? Input::get('type') : 4;

		$orders = Order::join('customer_profile', 'customer_profile.id', '=', 'order.cus_id')
						->select(
							'customer_profile.name',
							'customer_profile.tel',
							'order.id',
							'order.updated_at',
							'order.type',
							'order.source'
						)
						->orderBy('id', 'DECS');
		switch ($type) {
			case 6:
				# Order is waiting for payment
				$orders->where('type', '=', 0);
				break;
			case 1:
				# Order is pay
				$orders->where('type', '=', 1);
				break;
			case 2:
				# Order is cancelled
				$orders->where('type', '=', 2);
				break;
			case 3:
				# Order open time > 1 Day
				$date = new DateTime();
				$date->setTimestamp($date->getTimestamp() - (60*60*24));
		
				$orders->where('type', '=', 0);
				$orders->where('updated_at', '<', $date->format('Y-m-d H:i:s'));
				break;
			case 4:
				# All orders
				break;
			case 5:
				# Order is sender
				$orders->where('type' ,'=', 3);
				break;
			default:
				break;
		}

		// $orders = $orders->paginate(5);
		$orders = $orders->get()->toArray();

		$len = count($orders);

		// for ($i=0;$i<$len;$i++) {
		// 	$reserve = explode(',' ,$orders[$i]['reserve_id']);
		// 	foreach ($reserve as $r)
		// 	{
		// 		$orders[$i]['detail'] = $this->loadProductFromCode($r);
		// 	}
		// }
		// print '<pre>';
		// dd($orders);
		return View::make('admins.order.view', ['orders' => $orders]);
	}

	/**
	 * Show order
	 * @param Int $id
	 */
	public function showOrder($id)
	{
		$order = Order::join('customer_profile', 'customer_profile.id', '=', 'order.cus_id')
						->select(
							'customer_profile.name',
							'customer_profile.tel',
							'customer_profile.address',
							'order.id',
							'order.updated_at',
							'order.reserve_id',
							'order.type',
							'order.source'
						)
						->where('order.id', '=', $id)
						->orderBy('id', 'DECS')
						->first()
						->toArray();
		$rid = explode(',', $order['reserve_id']);

		$products = $this->loadProductRID($rid);
		# print '<pre>';
		# dd($products);
		return View::make('admins.order.show', ['products' => $products, 'order' => $order]);
	}

	/**
	 * Set order is pay
	 * @param Int $id
	 *
	 */
	public function payOrder($id)
	{
		$order = Order::find($id);
		$rid = explode(',', $order->reserve_id);

		$len = count($rid);
		foreach($rid as $r)
		{
			$reserve = ProductsReserve::find($r);
			$reserve->type = 1;
			$reserve->save();
		}
		$order->type = 1;
		$order->save();

		return Redirect::back()->with('msg', "Order #$order->id is pay");
	}

	/**
	 * Cancel order
	 * @param Int $id
	 *
	 */
	public function cancelOrder($id)
	{
		$order = Order::find($id);
		$rid = explode(',', $order->reserve_id);

		$len = count($rid);
		foreach($rid as $r)
		{
			$reserve = ProductsReserve::find($r);
			$reserve->type = 2;
			$reserve->save();
		}
		$order->type = 2;
		$order->save();

		return Redirect::back()->with('msg', "Order #$order->id is cancel");
	}

	/**
	 * Print all orders is status pay
	 * and saved print order in log
	 *
	 */
	public function printOrder()
	{
		$orders = Order::where('type', '=', 1)->get();

		if($orders->count() < 1)
		{
			Session::flash('msg', 'ไม่มี Order ที่มีสถานะจ่ายเงินแล้ว');
			return Redirect::action('AdminController@viewOrder');
		}

		foreach($orders as $order)
		{
			$order->type = 3;
			$order->save();
			
			$order_id[] = $order->id;
		}
		# dd(implode(',', $order_id));
		$log = New PrintLog;
		$log->order_id = implode(',', $order_id);
		$log->save();

		return Redirect::action('AdminController@rePrintOrder');
	}

	/**
	 * Reprint order
	 * Show print order is printed
	 *
	 */
	public function rePrintOrder()
	{
		$log = PrintLog::orderBy('id', 'desc')->first();
		$o_id = explode(',', $log->order_id);
		$orders = Order::join('customer_profile', 'customer_profile.id', '=', 'order.cus_id')
						->select(
							'customer_profile.name',
							'customer_profile.tel',
							'customer_profile.address',
							'order.id',
							'order.updated_at',
							'order.reserve_id',
							'order.type',
							'order.source'
						)
						->whereIn('order.id', $o_id)
						->orderBy('id', 'DECS')
						->get()
						->toArray();
		$c = count($orders);
		if(!empty($c))
		{
			for($i=0;$i<$c;$i++)
			{
				$rid = explode(',', $orders[$i]['reserve_id']);

				$orders[$i]['pd'] = $this->loadProductRID($rid);
			}
			# print '<pre>';
			# dd($orders);
		}
		$time = $log->created_at;
		return View::make('admins.print.home', ['orders' => $orders, 'time' => $time]);
		$pdf = new \Thujohn\Pdf\Pdf();
		$html = View::make('admins.print.home', ['orders' => $orders]);
		$html = mb_convert_encoding($html, 'UTF-8', 'auto');
		$content = $pdf->load($html)->show();
    	# File::put(public_path('test'.$i.'.pdf'), $content);
		# $pdf = PDF::load($html, 'A4', 'portrait')->output();
	}

	/**
	 * View print order
	 *
	 */
	public function viewPrintOrder($id)
	{
		
		$orders = Order::join('customer_profile', 'customer_profile.id', '=', 'order.cus_id')
						->select(
							'customer_profile.name',
							'customer_profile.tel',
							'customer_profile.address',
							'order.id',
							'order.updated_at',
							'order.reserve_id',
							'order.type',
							'order.source'
						)
						->orderBy('id', 'DECS')
						->get()
						->toArray();
		$c = count($orders);
		if(!empty($c))
		{
			for($i=0;$i<$c;$i++)
			{
				$rid = explode(',', $orders[$i]['reserve_id']);

				$orders[$i]['pd'] = $this->loadProductRID($rid);
			}
			# print '<pre>';
			# dd($orders);
		}
	
		# return View::make('admins.print.home', ['orders' => $orders]);
		# $pdf = new \Thujohn\Pdf\Pdf();
		$mpdf=new mPDF("UTF-8");
		$html = View::make('admins.print.home', ['orders' => $orders])->render();
		#$html = mb_convert_encoding($html, 'UTF-8', 'auto');
		$mpdf->WriteHTML("ทดสอบ");
		return $mpdf->Output();
		# $html = mb_convert_encoding($html, 'UTF-8', 'auto');
		# $content = $pdf->load($html)->show();
    	# File::put(public_path('test'.$i.'.pdf'), $content);
		# $pdf = PDF::load($html, 'A4', 'portrait')->output();
	}

}