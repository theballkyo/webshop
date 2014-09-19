<?php
class TestController extends BaseController
{
	public function Index()
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
			$n[] = count($products[$i]['detail']);
			$i++;
		}
		
		print "<pre>";
		print_r($n);
		var_dump($products);
	}
}