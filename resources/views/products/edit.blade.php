@extends('layout.app')

@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-danger alert-block">
            <strong>{{ $message }}</strong>
        </div>
    @endif

    <div class="container">
        <h1>New Product</h1>
    </div>

    <div class="container">
        <div class="row">
            <form action="/product/{{$product->id}}/update" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="">Name</label>
                    <input type="text" name="name" class="form-control" value="{{old('name', $product->name)}}">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Description</label>
                    <textarea name="description" class="form-control" >{{old('description', $product->description)}}</textarea>
                    @if ($errors->has('description'))
                        <span class="text-danger">{{ $errors->first('description') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" name="image" class="form-control" value="{{old('image', $product->image)}}">
                    @if ($errors->has('image'))
                        <span class="text-danger">{{ $errors->first('image') }}</span>
                    @endif
                </div>

                <button class="btn btn-dark" type="submit">Submit</button>
            </form>
        </div>
    </div>
@endsection


