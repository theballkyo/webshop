<?php
class Products extends Eloquent{

	protected $table = "products";
	public $timestamps = False;
	public function fields()
	{
		return $this->hasMany('ProductsDetailFields', 'id');
	}

	public function data()
	{
		return $this->hasMany('ProductsDetailData', 'fid');
	}
}