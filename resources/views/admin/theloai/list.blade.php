@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Thể loại
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
                                <th>Tên thể loại</th>
                                <th>Tên không dấu</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($theloai as $tl)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$tl->id}}</td>
                                    <td>{{$tl->Ten}}</td>
                                    <td>{{$tl->TenKhongDau}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/theloai/delete/{{$tl->id}}" onclick="return confirm('Bạn có chắc muốn xoá?')"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/theloai/edit/{{$tl->id}}">Edit</a></td>
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