<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use DB;

class TinTucController extends Controller
{
    public function getList() {
    	// show newest news first
    	$tintuc = TinTuc::orderBy('id', 'DESC')->get();
    	return view('admin.tintuc.list', ['tintuc' => $tintuc]);
    }

    public function getAddNew() {
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	return view('admin.tintuc.addNew', ['loaitin' => $loaitin, 'theloai' => $theloai]);
    }

    public function postAddNew(Request $request) {

    	$this->validate($request, 
    		[
    			'idLoaiTin' => 'required',
    			'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
    			'TomTat' => 'required',
    			'NoiDung' => 'required' 
    		], 
    		[
    			'idLoaiTin.required' => 'Bạn chưa chọn loại tin',

    			'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
    			'TieuDe.min' => 'Tiêu đề phải có độ dài ít nhất 3 kí tự',
    			'TieuDe.unique' => 'Tiêu đề đã tồn tại',

    			'TomTat.required' => 'Bạn chưa nhập tóm tắt',

    			'NoiDung.required' => 'Bạn chưa nhập nội dung'
    		]);

    	$tintuc = new TinTuc();
    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->idLoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
    	$tintuc->NoiBat = $request->NoiBat;
    	$tintuc->SoLuotXem = 0;

    	if($request->hasFile('Hinh')) {

    		$file = $request->file('Hinh');

    		$fileExtension = $file->getClientOriginalExtension('Hinh');

    		if($fileExtension != 'jpg' && $fileExtension != 'png' && $fileExtension != 'jpeg') {
    			return redirect("admin/tintuc/addNew")->withErrors('Chỉ được chọn file có đuôi jpg, png hoặc jpeg');
    		}

    		$fileName = $file->getClientOriginalName();

    		// đảm bảo khi lưu tên hình không bị trùng
    		$Hinh = str_random(4) . "_" . $fileName;

    		// trong TH vẫn trùng, cho chạy while loop đến khi hết trùng
    		while(file_exists('upload/tintuc/' . $Hinh)) {
    			$Hinh = str_random(4) . "_" . $fileName;
    		}

    		// lưu file vào thư mục đã chỉ định
    		$file->move("upload/tintuc", $Hinh);

    		$tintuc->Hinh = $Hinh;

    	} else {
    		$tintuc->Hinh = "";
    	}

    	$tintuc->save();

    	return redirect("admin/tintuc/addNew")->with('message', 'Thêm thành công');

    }

    public function getEdit($id) {
    	$tintuc = TinTuc::find($id);
    	$loaitin = LoaiTin::all();
    	$theloai = TheLoai::all();
    	return view('admin.tintuc.edit', ['loaitin' => $loaitin, 'theloai' => $theloai, 'tintuc' => $tintuc]);

    }

    public function postEdit(Request $request, $id) {

    	$tintuc = TinTuc::find($id);

    	$this->validate($request, 
    		[
    			'idLoaiTin' => 'required',
    			'TieuDe' => 'required|min:3|unique:TinTuc,TieuDe',
    			'TomTat' => 'required',
    			'NoiDung' => 'required' 
    		], 
    		[
    			'idLoaiTin.required' => 'Bạn chưa chọn loại tin',

    			'TieuDe.required' => 'Bạn chưa nhập tiêu đề',
    			'TieuDe.min' => 'Tiêu đề phải có độ dài ít nhất 3 kí tự',
    			'TieuDe.unique' => 'Tiêu đề đã tồn tại',

    			'TomTat.required' => 'Bạn chưa nhập tóm tắt',

    			'NoiDung.required' => 'Bạn chưa nhập nội dung'
    		]);

    	$tintuc->TieuDe = $request->TieuDe;
    	$tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
    	$tintuc->idLoaiTin = $request->idLoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
    	$tintuc->NoiBat = $request->NoiBat;

    	if($request->hasFile('Hinh')) {

    		$file = $request->file('Hinh');

    		$fileExtension = $file->getClientOriginalExtension('Hinh');

    		if($fileExtension != 'jpg' && $fileExtension != 'png' && $fileExtension != 'jpeg') {
    			return redirect("admin/tintuc/addNew")->withErrors('Chỉ được chọn file có đuôi jpg, png hoặc jpeg');
    		}

    		$fileName = $file->getClientOriginalName();

    		// đảm bảo khi lưu tên hình không bị trùng
    		$Hinh = str_random(4) . "_" . $fileName;

    		// trong TH vẫn trùng, cho chạy while loop đến khi hết trùng
    		while(file_exists('upload/tintuc/' . $Hinh)) {
    			$Hinh = str_random(4) . "_" . $fileName;
    		}

    		// lưu file mới vào thư mục đã chỉ định
    		$file->move("upload/tintuc", $Hinh);

    		// Xoá file cũ
    		unlink("upload/tintuc/" . $tintuc->Hinh);

    		$tintuc->Hinh = $Hinh;

    	} 

    	$tintuc->save();

    	return redirect("admin/tintuc/edit/" . $id)->with('message', 'Cập nhật thành công');
       
    }

    public function delete($id) {
        DB::beginTransaction();
        try {
            $commentList = Comment::where('idTinTuc', $id)->delete();
            $tintuc = TinTuc::find($id)->delete();
            DB::commit();
            $success = true;
        } catch (\Exception $e) {
            $success = false;
            DB::rollback();
        }

        if ($success) {
            return redirect("admin/tintuc/list")->with('message', 'Xoá thành công');
        }
    }
}
