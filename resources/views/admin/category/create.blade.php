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
                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" required name="title" placeholder="...">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" required name="image">
                    </div>
                    <div class="form-group">
                        <label >Description</label>
                        <textarea class="form-control" required name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Example select</label>
                        <select class="form-control" required name="status">
                            <option value="0">Hiển thị</option>
                            <option value="1">Không hiển thị</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection