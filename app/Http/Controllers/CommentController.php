<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Comment;
use App\TinTuc;

class CommentController extends Controller
{
    public function delete($idComment, $idTinTuc) {

    	$comment = Comment::find($idComment)->delete();

    	return redirect("admin/tintuc/edit/" . $idTinTuc)->with('messageComment', 'Xoá bình luận thành công');
    }

    public function postComment(Request $request, $idTinTuc) {

    	$this->validate($request, 
            [
                'NoiDung' => 'required|min:3'
            ], 
            [
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'NoiDung.min' => 'Bình luận phải có ít nhất 3 kí tự',
            ]);

    	$tintuc = TinTuc::find($idTinTuc);
    	$comment = new Comment();
    	$comment->idTinTuc = $idTinTuc;
    	$comment->idUser = Auth::user()->id;
    	$comment->NoiDung = $request->NoiDung;

    	$comment->save();

    	return redirect('news/' . $idTinTuc . '/' . $tintuc->TieuDeKhongDau . '.html')->with('message', 'Cảm ơn vì ý kiến đóng góp của bạn');
    }
}
