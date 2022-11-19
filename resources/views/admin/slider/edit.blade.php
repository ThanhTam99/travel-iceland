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
            <div class="card-header">Cap nhat slider game</div>
            
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
                <a href="{{route('slider.index')}} " class="btn btn-success">Liet ke slider</a>
                <a href="{{route('slider.create')}} " class="btn btn-success">Tao slider</a>
                <form action="{{route('slider.update', $slider->id)}}" method="POST" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" class="form-control" value="{{$slider->title}}" name="title">
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <input type="file" class="form-control" name="image">
                        <img src="{{asset('uploads/slider/'.$slider->image)}}" height="150px" weight="150px">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description">{{$slider->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Example select</label>
                        <select class="form-control" name="status">
                            @if($slider->status == 1)
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