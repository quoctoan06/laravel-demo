@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif
                    
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Tóm tắt</th>
                                <th>Thể loại</th>
                                <th>Loại tin</th>
                                <th>Số lượt xem</th>
                                <th>Nổi bật</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tintuc as $tt)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$tt->id}}</td>
                                    <td>
                                        <p>{{$tt->TieuDe}}</p>
                                        <img src="upload/tintuc/{{$tt->Hinh}}" width="100px" height="100px">
                                    </td>
                                    <td>{{$tt->TomTat}}</td>
                                    <td>{{$tt->loaitin->theloai->Ten}}</td>
                                    <td>{{$tt->loaitin->Ten}}</td>
                                    <td>{{$tt->SoLuotXem}}</td>
                                    <td>
                                        @if($tt->NotBat == 1)
                                            {{'Có'}}
                                        @else 
                                            {{'Không'}}
                                        @endif
                                    </td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/tintuc/delete/{{$tt->id}}" onclick="return confirm('Bạn có chắc muốn xoá?')"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/edit/{{$tt->id}}">Edit</a></td>
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