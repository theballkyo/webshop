<?php
class Products extends Eloquent{

	protected $table = "Products";

	public function fields()
	{
		return $this->hasMany('ProductsDetailFields', 'id');
	}

	public function data()
	{
		return $this->hasMany('ProductsDetailData', 'fid');
	}
}