<?php

class AdminController extends BaseController{

	private $pid = 0;

	public function __construct()
    {
        $this->beforeFilter('auth.admin');
    }

	public function Index()
	{
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
						->where('name', '=', 'color')
						->first()
						->toArray();
			$i++;
		}
		print_r ($products);
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
			$code = implode(',', array($color, $product['size'][$i]['id']));
			#print $code;
			$stock = ProductsStock::where('code', '=', $code)->first();
			if(empty($stock))
			{
				$stock = 0;
			}
			else
			{
				$stock = $stock->stock;
			}
			$product['size'][$i]['stock'] = $stock;
			$i++;
		}

		$product['color'] = $color;
		#print '<pre>';
		print_r($product);

		return View::make('admins.stock', array('product' => $product));
	}

	public function getAddColor($pid)
	{
		Session::forget('msg');
		$product = Products::find($pid)->toArray();
		
		return View::make('admins.add.color', array('product' => $product));
	}

	public function getAddSize($pid)
	{
		return View::make('admins.add.size');
	}

	public function postStock($pid, $color)
	{
		$code = implode(',', array($color, Input::get('size_id')));
		if(!is_numeric(Input::get('add')))
		{
			Session::flash('msg.type', 'number');
		}
		else
		{
			if(input::has('add')){
				$num = (int) abs(Input::get('add'));
				$res = $this->updateStock($code, $num, 'plus');
			}
			elseif(input::has('del')){
				$num = (int) -abs(Input::get('del'));
				$res = $this->updateStock($code, $num, 'plus');
			}
			elseif(input::has('update')){
				$num = (int) Input::get('update');
				$res = $this->updateStock($code, $num, 'set');
			}
		}
		return Redirect::action('AdminController@getStock', array('pid' => $pid, 'color' => $color));
	}

	public function postAddColor($pid)
	{
		$validator = Validator::make(
			array('color' => Input::get('color')),
			array('color' => 'required')
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
				$detail->imgurl = Input::get('color_img');
				$detail->save();
				Session::flash('msg.type', 'success');
			}
		}
		#View::share('errors', $validator->messages());
		return View::make('admins.add.color', array('errors' => $validator->messages()));
	}

	public function postAddSize($pid)
	{
		$size = Input::get('size');
	}

	private function updateStock($code, $num, $type='set')
	{
		$stock = ProductsStock::where('code', '=', $code)->first();
		if(empty($stock))
		{
			print 33;
			$stock = New ProductsStock;
			$stock->stock = 0;
			$stock->code = $code;
			$stock->pid = Route::input('pid');
		}
		if($type == 'set'){
			print 1;
			$stock->stock = $num;
		}elseif($type == 'plus'){
			$stock->stock += $num;			
		}
		$stock->save();
		return True;
	}

}