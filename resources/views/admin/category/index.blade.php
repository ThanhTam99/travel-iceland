@extends('layouts.app')
@section('navbar')
<div class="container">
    @include('admin.include.navbar')
</div>
@endsection
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
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
                            <th scope="col">Id</th>
                            <th scope="col">Tên danh mục</th>
                            <th scope="col">Mô tả</th>
                            <th scope="col">Hiển thị</th>
                            <th scope="col">Hình ảnh</th>
                            <th scope="col">Thứ tự</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($category as $key => $cate)
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                            <td>Jacob</td>
                            <td>Thornton</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection