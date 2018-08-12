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

        $this->middleware(function ($request, $next) {
            if(Auth::check()) {
                view()->share('userLogin', Auth::user());
            }
            return $next($request);
        });
	}

    public function getHomePage() {
    	return view('web.pages.home');
    }

    public function getContactPage() {
    	return view('web.pages.contact');
    }

    public function getNewsCategoryPage($id) {
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
    	return view('web.pages.news_category', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function getNewsPage($id) {
    	$tintuc = TinTuc::find($id);
    	$tinNoiBat = TinTuc::where('NoiBat', 1)->take(4)->get();

    	// tin liên quan là những tin cùng loại tin 
    	$tinLienQuan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
    	
    	return view('web.pages.news', ['tintuc' => $tintuc, 'tinNoiBat' => $tinNoiBat, 'tinLienQuan' => $tinLienQuan]);
    }

    public function getLoginPage() {
        return view('web.pages.login');
    }

    public function postLoginPage(Request $request) {
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

    public function logout() {
        Auth::logout();
        return redirect('home');
    }

    public function getUserPage() {
        return view('web.pages.user');
    }

    public function postUserPage(Request $request) {
        $this->validate($request, 
            [
                'name' => 'required|min:3'
            ], 
            [
                'name.required' => 'Bạn chưa nhập tên đăng nhập',
                'name.min' => 'Tên đăng nhập phải có độ dài ít nhất 3 kí tự'
            ]);

        $user = Auth::user();
        $user->name = $request->name;

        // nếu người dùng đổi mật khẩu
        if($request->changePassword == 'on') {

             $this->validate($request, 
                [
                    'password' => 'required|min:3|max:32',
                    'passwordAgain' => 'required|same:password'
                ], 
                [

                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
                    'password.max' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',

                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
                ]);

             $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect('user')->with('message', 'Cập nhật thành công');
    }

    public function getRegisterPage() {
        return view('web.pages.register');
    }

    public function postRegisterPage(Request $request) {
        $this->validate($request, 
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:3|max:32',
                'passwordAgain' => 'required|same:password'
            ], 
            [
                'name.required' => 'Bạn chưa nhập tên đăng nhập',
                'name.min' => 'Tên đăng nhập phải có độ dài ít nhất 3 kí tự',

                'email.required' => 'Bạn chưa nhập email',
                'email.email' => 'Bạn chưa nhập đúng định dạng email',
                'email.unique' => 'Email đã tồn tại',

                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',
                'password.max' => 'Mật khẩu phải có độ dài từ 3 đến 32 kí tự',

                'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp'
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->quyen = 0;
        $user->save();

        return redirect('register')->with('message', 'Đăng ký thành công');
    }
}
