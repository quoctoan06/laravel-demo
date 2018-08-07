<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getList() {
    	$theloai = TheLoai::all();
    	return view('admin.theloai.list', ['theloai' => $theloai]);
    }

    public function getAddNew() {
    	return view('admin.theloai.addNew');
    }

    public function postAddNew(Request $request) {
    	// validate data
    	$this->validate($request, 
    		[
    			'Ten' => 'required|min:3|max:100'
    		], 
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
    			'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
    		]);

    	$theloai = new TheLoai();
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/addNew')->with('message', 'Thêm thành công');
    }

    public function edit() {
    	
    }
}
