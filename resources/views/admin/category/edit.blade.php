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
                <a href="{{route('category.index')}} " class="btn btn-success">Liet ke danh muc</a>
                <a href="{{route('category.create')}} " class="btn btn-success">Tao danh muc</a>
                <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" required value="{{$category->title}}" name="title">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{asset('uploads/category/'.$category->image)}}" height="150px" weight="150px">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" required name="description">{{$category->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Example select</label>
                        <select class="form-control" required name="status">
                            @if($category->status == 0)
                            <option value="0" selected>Hiển thị</option>
                            <option value="1">Không hiển thị</option>
                            @else
                            <option value="0">Hiển thị</option>
                            <option value="1" selected>Không hiển thị</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Edit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection