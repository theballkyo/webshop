<?php
class Order extends Eloquent {

	protected $table = "order";
	public $timestamps = true;

	public function cus()
    {
        return $this->hasOne('CustomerProfile', 'cus_id');
    }
}