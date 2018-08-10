<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UserController extends Controller
{
    public function getList() {

    	$user = User::all();

    	return view('admin.user.list', ['user' => $user]);
    }

    public function getAddNew() {

    	return view('admin.user.addNew');
    }

    public function postAddNew(Request $request) {

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
        $user->quyen = $request->quyen;
        $user->save();

        return redirect('admin/user/addNew')->with('message', 'Thêm thành công');
    }

    public function getEdit($id) {

        $user = User::find($id);

        return view('admin.user.edit', ['user' => $user]);
    }

    public function postEdit(Request $request, $id) {

        $this->validate($request, 
            [
                'name' => 'required|min:3'
            ], 
            [
                'name.required' => 'Bạn chưa nhập tên đăng nhập',
                'name.min' => 'Tên đăng nhập phải có độ dài ít nhất 3 kí tự'
            ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->quyen = $request->quyen;

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

        return redirect('admin/user/edit/' . $id)->with('message', 'Cập nhật thành công');
    }

    public function delete($id) {

        $user = User::find($id)->delete();

        return redirect('admin/user/list')->with('message', 'Xoá thành công');
    }
}
