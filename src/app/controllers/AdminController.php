<?php

class AdminController extends BaseController{

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
			print $code;
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

		if(input::has('add')){
			$num = (int) abs(Input::get('add_num'));
			$this->updateStock($code, $num, 'plus');
		}
		elseif(input::has('del')){
			$num = (int) -abs(Input::get('add_num'));
			$this->updateStock($code, $num, 'plus');
		}
		elseif(input::has('update')){
			$num = (int) Input::get('add_num');
			$this->updateStock($code, $num, 'set');
		}
	}

	public function postAddColor($pid)
	{
		$color = Input::get('color');
	}

	public function postAddSize($pid)
	{
		$size = Input::get('size');
	}

	private function updateStock($code, $num, $type='set')
	{
		if(!is_int($num))
		{
			return "Error";
		}

		$stock = ProductsStock::where('code', '=', $code)->first();
		if($type == "set"){
			$stock->stock = $num;
		}elseif($type == "plus"){
			$stock->stock += $num;			
		}
		$stock->save();
	}

}