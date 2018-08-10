@extends('admin.layout.index')

@section('content')
<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Sửa</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    {{$error}}<br>
                                @endforeach
                            </div>
                        @endif

                        @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                        @endif

                        <form action="admin/tintuc/edit/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}">
                            <div class="form-group">
                                <label>Thể loại</label>
                                <select class="form-control" name="idTheLoai" id="idTheLoai">
                                    @foreach($theloai as $tl)
                                        <option 
                                            @if($tintuc->loaitin->theloai->id == $tl->id)
                                                {{"selected"}}
                                            @endif
                                            value="{{$tl->id}}">{{$tl->Ten}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="idLoaiTin" id="idLoaiTin">
                                    @foreach($loaitin as $lt)
                                        <option 
                                            @if($tintuc->idLoaiTin == $lt->id)
                                                {{"selected"}}
                                            @endif
                                            value="{{$lt->id}}">{{$lt->Ten}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                            </div>
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control ckeditor" name="TomTat" id="demo" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" name="NoiDung" id="demo" rows="5">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <p><img src="upload/tintuc/{{$tintuc->Hinh}}" width="400px" height="300px"></p>
                                <input type="file" class="form-control" name="Hinh" />
                            </div>
                            <div class="form-group">
                                <label>Nổi bật</label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="1" type="radio" @if($tintuc->NoiBat == 1) {{"checked"}} @endif>Có
                                </label>
                                <label class="radio-inline">
                                    <input name="NoiBat" value="0" type="radio" @if($tintuc->NoiBat == 0) {{"checked"}} @endif>Không
                                </label>
                            </div>
                            <button type="submit" class="btn btn-default">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Bình luận
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('messageComment'))
                        <div class="alert alert-success">
                            {{session('messageComment')}}
                        </div>
                    @endif
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người viết</th>
                                <th>Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc->comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cm->id}}</td>
                                    <td>{{$cm->user->name}}</td>
                                    <td>{{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/comment/delete/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#idTheLoai').click(function() {
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/" + idTheLoai, function(data) {
                    $('#idLoaiTin').html(data);
                });
            });
        });
    </script>
@endsection