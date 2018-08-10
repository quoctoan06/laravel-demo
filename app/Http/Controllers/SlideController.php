<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Slide;

class SlideController extends Controller
{
    public function getList() {
    	$slide = Slide::all();
    	return view('admin.slide.list', ['slide' => $slide]);
    }

    public function getAddNew() {
    	return view('admin.slide.addNew');
    }

    public function postAddNew(Request $request) {
    	$this->validate($request, 
    		[
    			'Ten' => 'required',
    			'NoiDung' => 'required' 
    		], 
    		[

    			'Ten.required' => 'Bạn chưa nhập tên slide',

    			'NoiDung.required' => 'Bạn chưa nhập nội dung'
    		]);

    	$slide = new Slide();
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link')) {
    		$slide->link = $request->link;
    	}

    	if($request->hasFile('Hinh')) {

    		$file = $request->file('Hinh');

    		$fileExtension = $file->getClientOriginalExtension('Hinh');

    		if($fileExtension != 'jpg' && $fileExtension != 'png' && $fileExtension != 'jpeg') {
    			return redirect("admin/slide/addNew")->withErrors('Chỉ được chọn file có đuôi jpg, png hoặc jpeg');
    		}

    		$fileName = $file->getClientOriginalName();

    		// đảm bảo khi lưu tên hình không bị trùng
    		$Hinh = str_random(4) . "_" . $fileName;

    		// trong TH vẫn trùng, cho chạy while loop đến khi hết trùng
    		while(file_exists('upload/slide/' . $Hinh)) {
    			$Hinh = str_random(4) . "_" . $fileName;
    		}

    		// lưu file vào thư mục đã chỉ định
    		$file->move("upload/slide", $Hinh);

    		$slide->Hinh = $Hinh;

    	} else {
    		$slide->Hinh = "";
    	}

    	$slide->save();

    	return redirect("admin/slide/addNew")->with('message', 'Thêm thành công');
    }

    public function getEdit($id) {

    	$slide = Slide::find($id);

    	return view('admin.slide.edit', ['slide' => $slide]);
    }

    public function postEdit(Request $request, $id) {

    	$this->validate($request, 
    		[
    			'Ten' => 'required',
    			'NoiDung' => 'required' 
    		], 
    		[

    			'Ten.required' => 'Bạn chưa nhập tên slide',

    			'NoiDung.required' => 'Bạn chưa nhập nội dung'
    		]);

    	$slide = Slide::find($id);
    	$slide->Ten = $request->Ten;
    	$slide->NoiDung = $request->NoiDung;
    	if($request->has('link')) {
    		$slide->link = $request->link;
    	}

    	if($request->hasFile('Hinh')) {

    		$file = $request->file('Hinh');

    		$fileExtension = $file->getClientOriginalExtension('Hinh');

    		if($fileExtension != 'jpg' && $fileExtension != 'png' && $fileExtension != 'jpeg') {
    			return redirect("admin/slide/addNew")->withErrors('Chỉ được chọn file có đuôi jpg, png hoặc jpeg');
    		}

    		$fileName = $file->getClientOriginalName();

    		// đảm bảo khi lưu tên hình không bị trùng
    		$Hinh = str_random(4) . "_" . $fileName;

    		// trong TH vẫn trùng, cho chạy while loop đến khi hết trùng
    		while(file_exists('upload/slide/' . $Hinh)) {
    			$Hinh = str_random(4) . "_" . $fileName;
    		}

    		// lưu file vào thư mục đã chỉ định
    		$file->move("upload/slide", $Hinh);

    		// Xoá file cũ
    		unlink("upload/slide/" . $slide->Hinh);

    		$slide->Hinh = $Hinh;

    	} 

    	$slide->save();

    	return redirect("admin/slide/edit/" . $id)->with('message', 'Cập nhật thành công');
    }

    public function delete($id) {

    	$slide = Slide::find($id)->delete();

    	return redirect("admin/slide/list")->with('message', 'Xoá thành công');
    }
}
