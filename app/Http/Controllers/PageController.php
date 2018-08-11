<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TheLoai;
use App\Slide;

class PageController extends Controller
{
	public function __construct() 
	{
		$theloai = TheLoai::all();
		$slide = Slide::all();
		
		view()->share(['theloai' => $theloai, 'slide' => $slide]);
	}

    public function getHomePage() {
    	return view('web.pages.home');
    }

    public function getContactPage() {
    	return view('web.pages.contact');
    }
}
