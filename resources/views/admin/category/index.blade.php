@extends('layouts.app')
@section('navbar')
<div class="container">
    @include('admin.include.navbar')
</div>
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header">Liet ke danh sach danh muc game</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <a href="{{route('category.create')}} " class="btn btn-success">Them danh muc game</a>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Mô tả</th>
                            <th>Hiển thị</th>
                            <th>Hình ảnh</th>
                            <th>Quản lý</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $key => $cate)
                        <tr>
                            <th>{{$key}}</th>
                            <td>{{$cate->title}}</td>
                            <td>{{$cate->description}}</td>
                            <td>
                                @if($cate->status == 0)
                                Khong hien thi
                                @else
                                Hien thi
                                @endif
                            </td>
                            <td><img src="{{asset('uploads/category/'.$cate->image)}}" height="150px" weight="150px"></td>
                            <td>
                                <form action="{{route('category.destroy',$cate->id)}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button onclick="return confirm('Ban co muon xoa');" class="btn btn-danger">Delete</button>
                                </form>
                                <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">Sửa</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection