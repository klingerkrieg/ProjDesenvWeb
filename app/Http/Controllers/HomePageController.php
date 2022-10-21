<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller {
	
	
    public function index(Request $request)	{
		return view("home");
	}
	
	public function about(){
		return view('about');
	}

}
