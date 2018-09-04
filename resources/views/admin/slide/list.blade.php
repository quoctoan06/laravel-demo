@extends('admin.layout.index')

@section('content')

<!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>Danh sách</small>
                        </h1>
                    </div>
                    @if(session('message'))
                        <div class="alert alert-success">
                            {{session('message')}}
                        </div>
                    @endif

                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Tên</th>
                                <th>Nội dung</th>
                                <th>Hình</th>
                                <th>Link</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($slide as $sl)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$sl->id}}</td>
                                    <td>{{$sl->Ten}}</td>
                                    <td>{{$sl->NoiDung}}</td>
                                    <td>
                                        <img src="upload/slide/{{$sl->Hinh}}" width="400px" height="300px">
                                    </td>
                                    <td>{{$sl->link}}</td>
                                    <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a href="admin/slide/delete/{{$sl->id}}" onclick="return confirm('Bạn có chắc muốn xoá?')"> Delete</a></td>
                                    <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/slide/edit/{{$sl->id}}">Edit</a></td>
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