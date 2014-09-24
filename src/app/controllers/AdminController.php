<?php

class AdminController extends BaseController{

	private $pid = 0;
	private $stock;

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
			$code = implode(',', array($color, $product['size'][$i]['id']));
			#print $code;
			$stock = ProductsStock::where('code', '=', $code)->first();
			if(empty($stock))
			{
				$stock = New ProductsStock;
				$stock->code = $code;
				$stock->stock = 0;
				$stock->show = 0;
				$stock->price = 0;
				$stock->pid = $pid;
				$stock->save();
			}
			$product['size'][$i]['stock'] = $stock->stock;
			$product['size'][$i]['price'] = $stock->price;
			$product['size'][$i]['show']  = $stock->show;
			$i++;
		}

		$product['color'] = $color;
		#print '<pre>';
		print_r($product);

		return View::make('admins.stock', array('product' => $product));
	}

	public function getAddColor($pid)
	{
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

		# Load stock in database
		$this->loadStockInDB($code);

		if(Input::has('price')){
			$price = (int) abs(Input::get('price'));
			$res = $this->updatePrice($price);
		}
		if(Input::has('add')){
			$num = (int) abs(Input::get('add'));
			$res = $this->updateStock($num, 'plus');
		}
		elseif(Input::has('del')){
			$num = (int) -abs(Input::get('del'));
			$res = $this->updateStock($num, 'plus');
		}
		elseif(Input::has('update')){
			$num = (int) Input::get('update');
			$res = $this->updateStock($num, 'set');
		}
		elseif(Input::has('show')){
			$this->stock->show = Input::get('show');
			$this->stock->save();
		}

		return Redirect::action('AdminController@getStock', array('pid' => $pid, 'color' => $color));
	}

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
				$detail->imgurl = Input::get('color_img');
				$detail->save();
				Session::flash('msg.type', 'success');
			}
		}
		View::share('errors', $validator->messages());
		return View::make('admins.add.color', array('errors' => $validator->messages()));
	}

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

	private function updateStock($num, $type='set')
	{
		if($type == 'set')
		{
			$this->stock->stock = $num;
		}elseif($type == 'plus')
		{
			$this->stock->stock += $num;			
		}
		$this->stock->save();
		return True;
	}

	private function updatePrice($price)
	{
		$this->stock->price = $price;
		$this->stock->save();
		return True;
	}
	/**
	 * Load stock in DB
	 * if stock not in DB, this function will create defualt stock
	 * Assign var $this->stock = Stock model
	 * Return Stock Model
	 */
	private function loadStockInDB($code)
	{
		if(!empty($this->stock))
			return $this->stock;
		$this->stock = ProductsStock::where('code', '=', $code)->first();
		#If empty, create new
		if(empty($this->stock))
		{
			$this->stock = New ProductsStock;
			$this->stock->stock = 0;
			$this->stock->code = $code;
			$this->stock->price = 0;
			$this->stock->show = 0;
			$this->stock->pid = Route::input('pid');
			$this->stock->save();
		}
		return $this->stock;
	}
}