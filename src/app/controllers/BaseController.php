<?php

class BaseController extends Controller {

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
		$stock = ProductsStock::where('code', '=', $code)->first();
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
		$code = explode(',', $code);
		$pid = $code[0];
		unset($code[0]);
		$product = Products::find($pid)->first()->toArray();
		$product['detail'] = $this->detailProduct($pid, $code);
		return $product;
	}

	protected function detailPDFromCode($code)
	{
		#$detail = Products
	}

	protected function detailProduct($pid, $data_id)
	{
	 	$detail = ProductsDetailFields::with(array('data' => function($query) use ($pid, $data_id)
		{
			$query->join('products_detail_fields', 'products_detail_fields.id', '=', 'products_detail_data.fid')
				->where('products_detail_data.pid', '=', $pid)
				->whereIn('products_detail_data.id', $data_id)
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
		return $detail;
	}

	 protected function stockProduct($code)
	 {
	 	return ProductsStock::where('code', '=', $code)->select('stock')->first()->stock;
	 }

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
}
