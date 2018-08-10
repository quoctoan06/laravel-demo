<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Comment;

class CommentController extends Controller
{
    public function delete($idComment, $idTinTuc) {

    	$comment = Comment::find($idComment)->delete();

    	return redirect("admin/tintuc/edit/" . $idTinTuc)->with('messageComment', 'Xoá bình luận thành công');
    }
}
