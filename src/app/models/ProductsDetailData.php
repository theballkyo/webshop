<?php
class ProductsDetailData extends Eloquent {

	protected $table = "products_detail_data";
	public $timestamps = False;

	public function Color()
    {
    	return $this->hasOne('Color', 'id');
    }

    public function stock()
    {
    	return $this->hasOne('ProductsStock', 'pid');
    }
}