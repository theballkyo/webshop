<?php

class BaseController extends Controller {

	protected $stock;
	protected $cache_pd = [];
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function loadProduct($code)
	{
		$data_id = explode(',', $code);
		# $detail['stock'] = $this->stockProduct($code);
		$stock = ProductsStock::where('code', '=', $code)->remember(1)->first();
		//Not found product
		if($stock == "")
		{
			return $detail;
		}
		$detail = Products::find($stock->pid)
						  ->first()
						  ->toarray();
		$detail['detail'] = $this->detailProduct($stock->pid, $data_id);
		$detail['stock'] = $stock->pid;
		return $detail;
	}

	protected function loadProductFromCode($code)
	{
		$code = $this->deGenerateCode($code);
		$pid = $code[0];
		unset($code[0]);
		$product = Products::find($pid)->first()->toArray();
		$product['detail'] = $this->detailProduct($pid, $code);
		return $product;
	}

	/**
	 * Load product from Reserve ID
	 * @param Array, Int $rid
	 * @return Mixed
	 *
	 */
	protected function loadProductRID($rid)
	{
		if(!is_array($rid))
		{
			$code = ProductsReserve::find($rid)->code_id;
			$code = $this->deCode($code);

			$product = Products::find($code[0])->first()->toArray();
			$product['detail'] = $this->detailProduct($code[0], $code[1]);
			return $product;
		}
		foreach ($rid as $id)
		{
			$reserve = ProductsReserve::find($id);
			$code = $this->deCode($reserve->code_id);

			$product[$reserve->id] = Products::find($code[0])->first()->toArray();
			$product[$reserve->id]['detail'] = $this->detailProduct($code[0], $code[1]);

			$stock = $this->loadStock($reserve->code_id);
			$product[$reserve->id]['price'] = $stock->price;
			$product[$reserve->id]['rid'] = $reserve->id;
			$product[$reserve->id]['discount'] = $reserve->discount;
			$product[$reserve->id]['dis_type'] = $reserve->discount_type;
			$product[$reserve->id]['amount']   = $reserve->amount;

		}
		return $product;
	}

	protected function detailPDFromCode($code)
	{
		#$detail = Products
	}

	/**
	 * Get detail product from reserve ID
	 * @param Array,String $rid
	 * @return Mixed
	 *
	 */
	protected function getDetailRID($rid)
	{
		if(!is_array($rid))
		{
			$code = ProductsReserve::find($rid)->code_id;
			$code = $this->deCode($code);
			$detail = $this->detailProduct($code[0], $code[1]);
			return $detail;
		}
		foreach ($rid as $id)
		{
			$code = ProductsReserve::find($id)->code_id;
			$code = $this->deCode($code);
			$detail[] = $this->detailProduct($code[0], $code[1]);
		}
		return $detail;
	}

	/**
	 * Get detail product from reserve ID
	 * @param Array,String $rid
	 * @return Mixed
	 *
	 */
	protected function getProductRID($rid)
	{

	}

	protected function detailProduct($pid, $data_id)
	{
	 	$detail = ProductsDetailFields::with(array('data' => function($query) use ($pid, $data_id)
		{
			$query->whereIn('products_detail_data.id', $data_id)
				  ->select(
					'products_detail_data.pid',
					'products_detail_data.fid',
					'products_detail_data.text',
					'products_detail_data.imgurl',
					'products_detail_data.id',
					'products_detail_data.code'
					);
		}
		))
					->get()
					->toArray();
		return $detail;
	}

	/**
	 * Get Field product detail
	 * @prame Int $pid Product ID
	 *        Int $fid Field ID > Optional
	 * @return Object
	 *
	 */
	protected function getField($pid, $fid = "")
	{
		$field = ProductsDetailData::where('pid', '=', $pid);
		if(!empty($fid))
			$field->where('fid', '=', $fid);
		return $field->get();
	}

	/**
	 * Get stock product
	 *
	 */
	protected function stockProduct($code)
	{
	 	$s = ProductsStock::where('code', '=', $code)->select('id', 'stock', 'price')->first();
	 	if(empty($s))
	 		$s = $this->createStock($code);
	 	return $s;
	}

	/**
	 * Get price product
	 *
	 */
	protected function getPrice($code)
	{
		return ProductsStock::where('code', '=', $code)->select('price')->first()->price;
	}

	/**
	 * Load stock in DB
	 * if stock not in DB, this function will create defualt stock
	 * Assign var $this->stock = Stock model
	 * Return Stock Model
	 */
	protected function loadStock($code)
	{
		# If already loadstock
		if(!empty($this->stock) and $this->stock->code == $code)
			return $this->stock;

		$data_id = $this->deGenerateCode($code);
		$pid = $data_id[0];

		# Validator product id
		if(Products::find($pid)->count() < 1)
			return False;
		# Unset data Product ID
		unset($data_id[0]);
		# Validator code
		if(ProductsDetailData::whereIn('id', $data_id)->where('pid', '=', $pid)->get()->count() < count($data_id))
			return False;

		$this->stock = ProductsStock::where('code', '=', $code)->first();
		#If empty, create new
		if(empty($this->stock))
		{
			$this->stock = New ProductsStock;
			$this->stock->stock = 0;
			$this->stock->code = $code;
			$this->stock->price = 0;
			$this->stock->show = 0;
			$this->stock->pid = $pid;
			$this->stock->save();
		}
		return $this->stock;
	}

	/**
	 * Create Default stock
	 * set amount product = 0
	 * @prame Int $code
	 */
	public function createStock($code)
	{
		$this->stock = New ProductsStock;
		$this->stock->stock = 0;
		$this->stock->code = $code;
		$this->stock->price = 0;
		$this->stock->show = 0;
		$this->stock->pid = $this->getID($code);
		$this->stock->save();
		return $this->stock;
	}

	/**
	 * Generate Stock code
	 *	@prams  String Product ID, Array Product data ID
	 *	@return String
	 *
	 */
	protected function generateCode($pid, $data_id)
	{
		return implode('-', array($pid, $data_id[0], $data_id[1]));
	}

	/**
	 * Degenerate Stock code
	 * @prame String code
	 * @return Array
	 *
	 */
	protected function deGenerateCode($code)
	{
		return explode('-', $code);
	}

	/**
	 * Decode of Stock code
	 * @param String $code
	 * @return Array -> PID, Field ID...
	 *
	 */
	protected function deCode($code)
	{
		$de = explode('-', $code);
		$pid = $de[0];
		unset($de[0]);
		return [$pid, $de];
	}

	/**
	 * Get ID Product from Code Product
	 * @param Int Code Product
	 * @return ID Product
	 *
	 */
	protected function getID($code)
	{
		$c = $this->deGenerateCode($code);
		return $c[0];
	}

	/**
	 * Get all details of product
	 * Old function ! don't use it!!!
	 *
	 */
	protected function allDetailsProduct()
	{
	 	$products['detail'] = ProductsDetailFields::with(array('datas' => function($query) use ($pid)
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
	}

	/**
	 * Random string
	 * @prame Int length
	 * @return String
	 *
	 */
	protected function generateRandomString($length = 10)
	{
    	return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
	}

}
