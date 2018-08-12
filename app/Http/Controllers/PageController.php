<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use App\User;

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

    public function getNewsCategory($id) {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
    	return view('web.pages.news_category', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function getNews($id) {
    	$tintuc = TinTuc::find($id);
    	$tinNoiBat = TinTuc::where('NoiBat', 1)->take(4)->get();

    	// tin liên quan là những tin cùng loại tin 
    	$tinLienQuan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
    	
    	return view('web.pages.news', ['tintuc' => $tintuc, 'tinNoiBat' => $tinNoiBat, 'tinLienQuan' => $tinLienQuan]);
    }

    public function getLogin() {
        return view('web.pages.login');
    }

    public function postLogin(Request $request) {
        $this->validate($request, 
            [
                'email' => 'required|email',
                'password' => 'required|min:3|max:32',
            ], 
            [
                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',

                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
                'password.max' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',

            ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            
            return redirect('home');
        } else {

            return redirect('login')->withErrors('Email hoặc mật khẩu sai');
        }
    }
}
