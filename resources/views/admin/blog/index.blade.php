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
            <div class="card-header">Liet ke blog game</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <a href="{{route('blog.create')}}" class="btn btn-success">Them blog game</a>
                <!-- <table class="table table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Slug</th>
                            <th>Mô tả</th>
                            <th>Hiển thị</th>
                            <th>Hình ảnh</th>
                            <th>Quản lý</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>-->
            </div>
        </div>
    </div>
</div>
@endsection