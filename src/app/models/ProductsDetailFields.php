<?php
class ProductsDetailFields extends Eloquent {

	protected $table = "products_detail_fields";
	public $timestamps = False;
	public function fields()
    {
        return $this->morphTo();
    }
    public function data()
    {
        return $this->hasOne('ProductsDetailData', 'fid');
    }

    public function datas()
    {
        return $this->hasMany('ProductsDetailData', 'fid');
    }
    public function detail()
    {
    	return $this->hasOne('Products', 'id');
    }
    
}
?>