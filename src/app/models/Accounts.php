<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Accounts extends Eloquent implements UserInterface, RemindableInterface{

	use UserTrait, RemindableTrait;
	
	protected $table = 'accounts';
	public $timestamps = False;
}