<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller {
	
	
    public function index(Request $request)	{
		return view("home_page");
	}
	
	public function about(){
		return view('about');
	}

}
