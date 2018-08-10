<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;

class LoaiTinController extends Controller
{
    public function getList() {
    	$loaitin = LoaiTin::all();
    	return view('admin.loaitin.list', ['loaitin' => $loaitin]);
    }

    public function getAddNew() {
    	$theloai = TheLoai::all();
    	return view('admin.loaitin.addNew', ['theloai' => $theloai]);
    }

    public function postAddNew(Request $request) {
    	// validate data
    	$this->validate($request, 
    		[
    			'Ten' => 'required|unique:LoaiTin,Ten|min:1|max:100',
    			'idTheLoai' => 'required'
    		], 
    		[
    			'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
    			'Ten.min' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'Ten.max' => 'Tên loại tin phải có độ dài từ 1loại tin kí tự',

    			'idTheLoai.required' => 'Bạn chưa chọn thể loại'
    		]);

    	$loaitin = new LoaiTin();
    	$loaitin->Ten = $request->Ten;
    	$loaitin->TenKhongDau = changeTitle($request->Ten);
    	$loaitin->idTheLoai = $request->idTheLoai;
    	$loaitin->save();

    	return redirect('admin/loaitin/addNew')->with('message', 'Thêm thành công');
    }

    public function getEdit($id) {
    	$loaitin = LoaiTin::find($id);
    	$theloai = TheLoai::all();
        return view('admin.loaitin.edit', ['loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function postEdit(Request $request, $id) {
        $loaitin = LoaiTin::find($id);

        $this->validate($request, 
    		[
    			'Ten' => 'required|unique:LoaiTin,Ten|min:1|max:100',
    			'idTheLoai' => 'required'
    		], 
    		[
    			'Ten.required' => 'Bạn chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
    			'Ten.min' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
    			'Ten.max' => 'Tên loại tin phải có độ dài từ 1loại tin kí tự',

    			'idTheLoai.required' => 'Bạn chưa chọn thể loại'
    		]);

        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->idTheLoai;
        $loaitin->save();

        return redirect('admin/loaitin/edit/' . $id)->with('message', 'Cập nhật thành công');
    }

    public function delete($id) {
        $loaitin = LoaiTin::find($id)->delete();

        return redirect('admin/loaitin/list')->with('message', 'Xoá thành công');
    }
}
