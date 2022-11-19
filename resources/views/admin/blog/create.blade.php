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
            <div class="card-header">Them blogs game</div>
            
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
                <a href="{{route('blog.index')}} " class="btn btn-success">Liet ke danh muc</a>
                <form action="{{route('blog.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" required id="slug" onkeyup="ChangeToSlug();" name="title" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" class="form-control" required name="slug" id="convert_slug" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" required name="image">
                    </div>
                    <div class="form-group">
                        <label >Description</label>
                        <textarea class="form-control" id="dest_blog" required name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label >Content</label>
                        <textarea class="form-control" id="content_blog" required name="content"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Example select</label>
                        <select class="form-control" name="status">
                            <option value="1">Hiển thị</option>
                            <option value="0">Không hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection