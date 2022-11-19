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
            
            @if ($errors->any()):
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

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
                        <input type="text" class="form-control" required value="{{$category->title}}" onkeyup="ChangeToSlug();" id="slug" name="title">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" required value="{{$category->slug}}" name="slug" id="convert_slug">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" required name="image">
                        <img src="{{asset('uploads/category/'.$category->image)}}" height="150px" weight="150px">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" required name="description">{{$category->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Example select</label>
                        <select class="form-control" name="status">
                            @if($category->status == 1)
                            <option value="1" selected>Hiển thị</option>
                            <option value="0">Không hiển thị</option>
                            @else
                            <option value="1">Hiển thị</option>
                            <option value="0" selected>Không hiển thị</option>
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