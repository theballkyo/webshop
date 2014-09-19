<?php

class ProductController extends BaseController {

	public function Index()
	{

	}

	public function getProduct($pid)
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
						->get()
						->toArray();
			$i++;
		}
		
		print "<pre>";
		 print_r($products);
		# Get product Options
		$product_options = ProductsDetailFields::join('products_detail_data', function($join)
						{
							$join->on('products_detail_data.fid', '=', 'products_detail_fields.id');
						})
						->get()
						->toArray();
		print_r($product_options);

		$myproducts = ProductsStock::find(1)->toArray();
		# print_r($myproducts);
		print_r($this->loadProduct('1,3'));
		#return View::make('products.detail', array('pd_data' => $products));
	}
}
