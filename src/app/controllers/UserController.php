<?php

class UserController extends BaseController{

	public function getLogin()
	{
		if (Auth::check())
		{
			return Redirect::to('/');
		}
		else
		{
			return View::make('user/getLogin');
		}
	}	

	public function postLogin()
	{
		if (Auth::check())
		{
			return Redirect::to('/');
		}
		$username = Input::get('username');
		$password = Input::get('password');
		if(Auth::attempt(array('username' => $username, 'password' => $password)))
		{
			return Redirect::to('user/login');
		}
		return View::make('user/getLogin', array('error_msg' => 'Username or passwor not correct!'));
	}

	public function getRegister()
	{
		if (Auth::check())
		{
			return Redirect::to('/');
		}
		return View::make('user/getRegister');
	}

	public function postRegister()
	{
		if (Auth::check())
		{
			return Redirect::to('/');
		}
		#var_dump(Input::all());
		$acc = New Accounts;
		$acc->username = Input::get('username');
		$acc->password = Hash::make(Input::get('password'));
		$acc->email = Input::get('email');
		$acc->status = 2;
		$acc->save();

		if(Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
		{
			return Redirect::to('user/login');
		}
	}

	public function getLogout()
	{
		Auth::logout();
		return Redirect::to('/');
	}
} 