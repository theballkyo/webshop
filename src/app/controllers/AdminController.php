<?php

class AdminController extends BaseController{

	private $pid = 0;

	public function __construct()
    {
        $this->beforeFilter('auth.admin');
    }

	public function Index()
	{
		return Redirect::action('OrderController@newOrder');
		Session::flash('error', 'True');
		Session::push('error.msg', 'developers');
		Session::push('error.msg', 'developers2');
		$products = Products::all()
					->toArray();
		$i = 0;
		foreach($products as $product)
		{
			$pid = $product['id'];
			$products[$i]['detail'] = ProductsDetailFields::with(array('datas' => function($query) use ($pid)
			{
				$query->join('products_detail_fields', 'products_detail_fields.id', '=', 'products_detail_data.fid')
					->where('products_detail_data.pid', '=', $pid)
					->select(
						'products_detail_data.pid',
						'products_detail_data.fid',
						'products_detail_data.text',
						'products_detail_data.imgurl',
						'products_detail_data.id'
						);
			}
			))
						->get()
						->toArray();
			$i++;
		}

		return View::make('admins.home', array('products' => $products));
	}

	public function getProducts()
	{
		$products = Products::all();
		return View::make('admins.products');
	}

	public function getStocks()
	{
		$products = Products::all()->toArray();

		# Index products
		$i = 0;
		foreach($products as $product)
		{
			$pid = $product['id'];

			# Get color in product
			$products[$i]['detail'] = ProductsDetailFields::with(array('datas' => function($query) use ($pid)
			{
				$query->join('products_detail_fields', 'products_detail_fields.id', '=', 'products_detail_data.fid')
					->where('products_detail_data.pid', '=', $pid)
					->select(
						#'products_detail_data.pid',
						'products_detail_data.fid',
						'products_detail_data.text',
						'products_detail_data.imgurl',
						'products_detail_data.id'
					);
			}))
			#->where('name', '=', 'color')
			->get()
			->toArray();

			$i++;
		}
		// Debug !
		#print '<pre>';
		#print_r ($products);
		#print '</pre>';

		return View::make('admins.stocks', array('products' => $products));
	}

	public function getStock($pid, $color)
	{
		$product = Products::where('id', '=', $pid)->first()->toArray();
		$product['size'] = ProductsDetailData::where('fid', '=', 2)
						->where('pid', '=', $pid)
						->select(array('id', 'text'))
						->get()
						->toArray();
		# Get stock
		$i = 0;
		foreach ($product['size'] as $size) {
			$code = $this->generateCode($pid, array($color, $product['size'][$i]['id']));
			#$code = implode(',', array($pid, $color, $product['size'][$i]['id']));
			#print $code;
			# Load stock in database
			$this->loadStock($code);

			if(empty($this->stock))
				return Redirect::action('AdminController@getStocks')->withErrors('code_err', '');

			$product['size'][$i]['stock'] = $this->stock->stock;
			$product['size'][$i]['price'] = $this->stock->price;
			$product['size'][$i]['show']  = $this->stock->show;
			$product['size'][$i]['code']  = $code;
			$i++;
		}

		$product['color'] = ProductsDetailData::where('id', '=', $color)
						->select(array('code'))
						->first()->code;
		#print '<pre>';
		# print_r($product);

		return View::make('admins.stock', array('product' => $product));
	}

	/**
	 * GET Add color page
	 * Render add color to product page
	 *
	 */
	public function getAddColor($pid)
	{
		$product = Products::find($pid)->toArray();
		
		return View::make('admins.add.color', array('product' => $product));
	}

	/**
	 * GET Add size page
	 * Render add size to product page
	 *
	 */
	public function getAddSize($pid)
	{
		return View::make('admins.add.size');
	}

	/**
	 * Show all customer profile
	 * 
	 */
	public function getAllCustomer()
	{
		$cus_users = CustomerProfile::paginate(10);
		return View::make('admins.customer.index', array('cus_users' => $cus_users));
	}

	/**
	 * Show customer profile by ID
	 *
	 */
	public function getCustomer($id)
	{
		$cus_user = CustomerProfile::find($id);
		$cus_reserve = ProductsReserve::join('products_stock', 'products_stock.id',
												'=', 'products_reserve.stock_id')
										->where('cus_id', '=', $id)
										->whereIn('type', array(0, 1))
										->select('products_reserve.id', 'products_reserve.cus_id', 'products_reserve.code_id', 'products_reserve.amount',
												'products_stock.price', 'products_reserve.discount', 'products_reserve.discount_type', 'products_reserve.type',
												'products_reserve.created_at')
										->get();

		$count = $cus_reserve->count();
		# Convert object to array because it want to select index
		$cus_reserve = $cus_reserve->toArray();

		for($i=0;$i<$count;$i++)
		{
			$cus_reserve[$i]['product'] = $this->loadProductFromCode($cus_reserve[$i]['code_id']);
		}

		return View::make('admins.customer.view', array(
											'cus_user' => $cus_user,
											'cus_reserve' => $cus_reserve,
											#'products' => $products
											));
	}

	/**
	 * Add customer profile viewer
	 *
	 */
	public function getAddCustomer()
	{
		return View::make('admins.customer.add');
	}

	/**
	 * GET Show reserve for all product
	 *
	 */
	public function getReserve()
	{
		# Reserve
		$r_wait = ProductsReserve::where('type', '=', 0)->get();
		$r_succ = ProductsReserve::where('type', '=', 1)->get();
		$r_cancel = ProductsReserve::where('type', '=', 2)->get();

		$i=0;
		$count = $r_wait->count();
		$r_wait->toArray();
		for($i=0;$i<$count;$i++)
		{
			$r_wait[$i]['product'] = $this->loadProductFromCode($r_wait[$i]['code_id']);
			$r_wait[$i]['price'] = $this->getPrice($r_wait[$i]['code_id']);
		}
		$i=0;
		$count = $r_succ->count();
		$r_succ->toArray();
		for($i=0;$i<$count;$i++)
		{
			$r_succ[$i]['product'] = $this->loadProductFromCode($r_succ[$i]['code_id']);
			$r_succ[$i]['price'] = $this->getPrice($r_succ[$i]['code_id']);
		}

		$i=0;
		$count = $r_cancel->count();
		$r_cancel->toArray();
		for($i=0;$i<$count;$i++)
		{
			$r_cancel[$i]['product'] = $this->loadProductFromCode($r_cancel[$i]['code_id']);
			$r_cancel[$i]['price'] = $this->getPrice($r_cancel[$i]['code_id']);
		}

		return View::make('admins.reserve.index',
						array(
							'r_wait'   => $r_wait,
							'r_succ'   => $r_succ,
							'r_cancel' => $r_cancel
							));

	}

	/**
	 *	GET Reserve Product for customer
	 *
	 */
	public function getStockReserve($code)
	{
		if(!$this->loadStock($code))
			return Redirect::action('AdminController@getStocks')->withErrors('code_err', '');

		$cus_users = CustomerProfile::orderBy('name', 'ASC')->get()->toArray();
		return View::make('admins.reserve', array('cus_users' => $cus_users));
	}

	/**
	 * ANY Cancel product is reserved
	 * @prame $id = Index in product_reserve
	 * @return void
	 *
	 */
	public function cancelReserve($id)
	{
		$reserve = ProductsReserve::join('products_stock', 'products_stock.code', '=', 'products_reserve.code_id')
									->where('products_reserve.id', '=', $id)
									->select('products_reserve.id', 'products_reserve.cus_id', 'products_reserve.code_id', 'products_reserve.amount', 
											  'products_reserve.discount', 'products_reserve.discount_type', 'products_stock.price')
									->first();

		if(empty($reserve))
		{	
			Session::flash('res_id_err', '');
			return Redirect::back();
		}
		# Fixed id
		#$reserve->id = $id;
		$reserve->type = 2;
		$reserve->save();

		// if($this->loadStock($reserve->code_id))
		// {
		// 	$this->stock->stock += $reserve->amount;
		// 	$this->stock->save();
		// }

		// $res_cancel = New ProductsReserveCancel;
		// $res_cancel->cus_id 		= $reserve->cus_id;
		// $res_cancel->code_id 		= $reserve->code_id;
		// $res_cancel->amount 		= $reserve->amount;
		// $res_cancel->price 			= $reserve->price;
		// $res_cancel->discount 		= $reserve->discount;
		// $res_cancel->discount_type 	= $reserve->discount_type;
		// $res_cancel->save();

		// $reserve->delete();

		Session::flash('cancel_succ', '');
		return Redirect::back();
	}

	/**
	 * GET -> Discount reserve product
	 *
	 */
	public function getReserveDis($id)
	{
		$cus_reserve = ProductsReserve::join('products_stock', 'products_stock.id',
												'=', 'products_reserve.stock_id')
										->where('products_reserve.id', '=', $id)
										->select('products_reserve.id', 'products_reserve.cus_id', 'products_reserve.code_id', 'products_reserve.amount',
												'products_stock.price', 'products_reserve.discount', 'products_reserve.discount_type', 'products_reserve.type',
												'products_reserve.created_at')
										->get();

		$count = $cus_reserve->count();
		# Convert object to array because it want to select index
		$cus_reserve = $cus_reserve->toArray();

		for($i=0;$i<$count;$i++)
		{
			$cus_reserve[$i]['product'] = $this->loadProductFromCode($cus_reserve[$i]['code_id']);
		}

		return View::make('admins.reserve.discount', array('cus_reserve' => $cus_reserve));
	}

	/**
	 * Get -> Show stock of product
	 * @param Int $pid
	 *
	 */
	public function getShowStock($pid)
	{
		$detail = [
			'pd_c' => $this->getField($pid, 1),
		    'pd_s' => $this->getField($pid, 2),
		];
		foreach ($detail['pd_c'] as $c) {
			foreach ($detail['pd_s'] as $s) {
				$code = $this->generateCode($pid, array($c->id, $s->id));
				$stock = $this->stockProduct($code);
				$detail['stock'][$c->id][$s->id]['stock'] = $stock->stock;
				$detail['stock'][$c->id][$s->id]['code'] = $stock->id;
				$detail['stock'][$c->id][$s->id]['price'] =$stock->price;
			}
		}
		return View::make('admins.stock.show', $detail);
	}

	/**
	 * POST -> Edit stock of product
	 *
	 */
	public function postShowStock($pid)
	{
		foreach (Input::get('amount') as $id => $amount) {
			if((int) $amount !=0)
			{
				$stock = ProductsStock::find($id);
				$stock->stock += $amount;
			}
			if((int) Input::get('price')[$id] > 0)
			{
				if(empty($stock))
					$stock = ProductsStock::find($id);

				$stock->price = Input::get('price')[$id];
			}
			if(!empty($stock))
				$stock->save();
		}
		return Redirect::back()->with('msg', 'ok');
	}

	/**
	 * POST -> Discount reserve product
	 *
	 */
	public function postReserveDis($id)
	{
		$reserve = ProductsReserve::find($id);
		if(empty($reserve))
			return Redirect::action('AdminController@getAllCustomer');

		$reserve->discount_type = Input::get('discount_type');
		$reserve->discount      = Input::get('discount');
		$reserve->save();

		return Redirect::back();
	}

	/**
	 * POST Add detail Reserve product for customer to DB
	 *
	 */
	public function postStockReserve($code)
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
			return Redirect::action('AdminController@getStockReserve', array($code))->withErrors($validator->messages());
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

		if(!$this->loadStock($code))
			return Redirect::action('AdminController@getStockReserve', array($code))->withErrors(array('code_err'));

		#$stock = ProductsStock::where('code', '=', $code)->first()->id;
		$new_stock = (int) abs(Input::get('amount'));
		if($this->stock->stock < $new_stock)
		{
			Session::flash('stock', '');
			return Redirect::action('AdminController@getStockReserve', array($code));
		}
		$this->stock->stock -= $new_stock;
		$this->stock->save();

		$reserve = new ProductsReserve;
		$reserve->cus_id = $cus_id;
		$reserve->stock_id = $this->stock->id;
		$reserve->code_id = $code;
		$reserve->amount = (int) Input::get('amount');
		$reserve->note = Input::get('reserve_note');
		$reserve->save();

		Session::flash('success', '');
		return Redirect::action('AdminController@getStockReserve', array($code));
	}

	/**
	 * POST customer profile
	 * Insert customer profile to DB
	 *
	 */
	public function postAddCustomer()
	{
		$validator = Validator::make(
						Input::all(),
						array(
							'name' => 'required'
						)
		);
		# Validator input
		if($validator->fails())
		{
			return View::make('admins.customer.add')->withErrors($validator->messages());
		}

		$customer = New CustomerProfile;
		$customer->name = Input::get('name');
		$customer->address = Input::get('address');
		$customer->email = Input::get('email');
		$customer->tel = Input::get('tel');
		$customer->note = Input::get('note');
		$customer->save();
		Session::flash('success', '');
		return View::make('admins.customer.add');
	}

	/**
	 * POST -> Delete customer data
	 *
	 */
	public function postDelCustomer()
	{
		$id = Input::get('id');
		if(empty($id))
			return Redirect::back();

		$cus = CustomerProfile::find($id);
		if(!empty($cus))
		{
			Session::flash('del_succ', '');
			$cus->delete();
		}
		return Redirect::back();
	}

	/**
	 * POST -> Update customer profile
	 *
	 */
	public function postCustomer($id)
	{
		if(Input::has('payment'))
		{
			$reserve = ProductsReserve::find(Input::get('reserve_id'));
			if(empty($reserve))
			{
				Session::flash('reserve_id', '');
				return Redirect::back();
			}
			$reserve->payment = Input::get('payment') ? '1' : '0';
			$reserve->update();
			Session::flash('success', '');
			return Redirect::back();
		}

		$validator = Validator::make(
						Input::all(),
						array(
							'name' => 'required'
						)
		);

		# Validator input
		if($validator->fails())
		{
			return Redirect::action('AdminController@getCustomer', array($id))->withErrors($validator->messages());
		}

		$customer = CustomerProfile::find($id);
		$customer->name = Input::get('name');
		$customer->address = Input::get('address');
		$customer->email = Input::get('email');
		$customer->tel = Input::get('tel');
		$customer->note = Input::get('note');
		$customer->save();
		Session::flash('success', '');
		return Redirect::back();
	}

	/**
	 * POST -> Change Payment Reserve Status
	 *
	 */
	public function postReservePay()
	{
		$reserve = ProductsReserve::find(Input::get('reserve_id'));

		if(empty($reserve))
		{
			Session::flash('reserve_id', '');
			return Redirect::back();
		}

		$reserve->type = Input::get('payment') ? '1' : '0';
		$reserve->save();

		Session::flash('success', '');
		return Redirect::back();
	}

	/**
	 * Post -> Update product stock
	 * Price, Stock, Show 
	 *
	 */
	public function postStock($pid, $color)
	{
		#$code = implode(',', array($pid, $color, Input::get('size_id')));
		$code = $this->generateCode($pid, array($color, Input::get('size_id')));
		# Load stock in database
		$this->loadStock($code);

		if(empty($this->stock))
			return Redirect::action('AdminController@getStocks')->withErrors('code_err', '');

		if(Input::has('price')){
			$this->stock->price = (int) abs(Input::get('price'));
			#$res = $this->updatePrice($price);
		}
		if(Input::has('add')){
			$this->stock->stock += (int) abs(Input::get('add'));
			#$res = $this->updateStock($num, 'plus');
		}
		elseif(Input::has('del')){
			$this->stock->stock += (int) -abs(Input::get('del'));
			#$res = $this->updateStock($num, 'plus');
		}
		elseif(Input::has('update')){
			$this->stock->stock = (int) Input::get('update');
			#$res = $this->updateStock($num, 'set');
		}
		elseif(Input::has('show')){
			$this->stock->show = Input::get('show');
			#$this->stock->save();
		}
		$this->stock->save();
		return Redirect::action('AdminController@getStock', array('pid' => $pid, 'color' => $color));
	}

	/**
	 * POST Add new color to product
	 * @return void
	 *
	 */
	public function postAddColor($pid)
	{
		Session::flash('msg', '');
		$validator = Validator::make(
			array(
				'color' => Input::get('color'),
			),

			array(
				'color' => 'required'
			)
		);
		# Validator input
		if($validator->fails())
		{
			Session::flash('msg.type', 'validator');
		}
		# Check is has product in database
		elseif(Products::find($pid)->count() < 1)
		{
			Session::flash('msg.type', 'error');
		}
		else
		{
			if(ProductsDetailData::where('fid', '=', 1)
				->where('pid', '=', $pid)
				->where('text', '=', Input::get('color'))->count() > 0)
			{
				$validator->messages()->add('color', 'Color is already used.');
				Session::flash('msg.type', 'exist');
			}
			else
			{
				$detail = New ProductsDetailData;
				$detail->pid = $pid;
				# Field color id = 1
				$detail->fid = 1;
				$detail->text = Input::get('color');
				$detail->code = Input::get('color_hex');
				$detail->imgurl = Input::get('color_img');
				$detail->save();
				Session::flash('msg.type', 'success');
			}
		}
		View::share('errors', $validator->messages());
		return View::make('admins.add.color', array('errors' => $validator->messages()));
	}

	/**
	 * POST Add new size to product
	 * @return void
	 *
	 */
	public function postAddSize($pid)
	{
		Session::flash('msg', '');
		$validator = Validator::make(
			array(
				'size' => Input::get('size'),
			),

			array(
				'size' => 'required'
			)
		);
		# Validator input
		if($validator->fails())
		{
			Session::flash('msg.type', 'validator');
		}
		# Check is has product in database
		elseif(Products::find($pid)->count() < 1)
		{
			Session::flash('msg.type', 'error');
		}
		else
		{	# For size ; fid = 2
			# Check already size
			if(ProductsDetailData::where('fid', '=', 2)
				->where('pid', '=', $pid)
				->where('text', '=', Input::get('size'))->count() > 0)
			{
				$validator->messages()->add('color', 'Size is already used.');
				Session::flash('msg.type', 'exist');
			}
			else
			{
				$detail = New ProductsDetailData;
				$detail->pid = $pid;
				# Field color id = 2
				$detail->fid = 2;
				$detail->text = Input::get('size');
				$detail->save();
				Session::flash('msg.type', 'success');
			}
		}
		View::share('errors', $validator->messages());
		return View::make('admins.add.size', array('errors' => $validator->messages()));
	}

	/**
	 * Post Delete color
	 * Delete color from product
	 * Return Void
	 */
	public function postDeleteColor($color)
	{
		$detail = ProductsDetailData::find($color);
		if(!empty($detail))
		{
			$detail->delete();
		}
		return Redirect::action('AdminController@getStocks');
	}

	/**
	 * Post Delete size
	 * Delete size from product
	 * Return Void
	 */
	public function postDeleteSize($size)
	{
		$detail = ProductsDetailData::find($size);
		if(!empty($size))
		{
			$detail->delete();
		}
		return Redirect::action('AdminController@getStocks');
	}
}
