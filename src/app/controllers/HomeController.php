<?php

class HomeController extends BaseController {

	public function Index()
	{
		return View::make('home');
	}

	public function getShop()
	{
		print Cookie::get('remeber');
	}
}
