<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use DB;

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
    			'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
    		], 
    		[
    			'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
    			'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
    			'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
    		]);

    	$theloai = new TheLoai();
    	$theloai->Ten = $request->Ten;
    	$theloai->TenKhongDau = changeTitle($request->Ten);
    	$theloai->save();

    	return redirect('admin/theloai/addNew')->with('message', 'Thêm thành công');
    }

    public function getEdit($id) {
    	$theloai = TheLoai::find($id);
        return view('admin.theloai.edit', ['theloai' => $theloai]);
    }

    public function postEdit(Request $request, $id) {
        $theloai = TheLoai::find($id);

        // validate data
        $this->validate($request, 
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
            ]);

        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        return redirect('admin/theloai/edit/' . $id)->with('message', 'Cập nhật thành công');
    }

    public function delete($id) {
        DB::beginTransaction();
        try {
            $loaitinList = LoaiTin::where('idTheLoai', $id)->get();
            foreach ($loaitinList as $loaitin) {
                $tintucList = TinTuc::where('idLoaiTin', $loaitin->id)->get();
                foreach ($tintucList as $tintuc) {
                    $commentList = Comment::where('idTinTuc', $tintuc->id)->delete();
                    TinTuc::find($tintuc->id)->delete();
                }
                LoaiTin::find($loaitin->id)->delete();
            }
            $theloai = TheLoai::find($id)->delete();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return redirect('admin/theloai/list')->with('message', 'Xoá thành công');
        }
    }
}
