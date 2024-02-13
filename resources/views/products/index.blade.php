@extends('layout.app')

@section('content')
    @if ($message = Session::get('danger'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif

    <div class="container">
        <div>
            <a href="products/create" class="btn btn-dark mt-5 mb-2">New Product</a>
        </div>
        <h1>Products</h1>

        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>SI</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)   
                    {{-- $prodId = $product->id; --}}
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>
                            <a href="product/{{$product->id}}/view" class="text-white">
                                {{$product->name}}
                            </a>
                        </td>
                        <td>{{$product->description}}</td>
                        <td>
                            <img 
                                src="products/{{$product->image}}" 
                                alt="{{$product->image}}" 
                                class="rounded-circle" 
                                height="30" width="30">
                        </td>
                        <td>
                            <a href="product/{{$product->id}}/edit" class="btn btn-primary">Edit</a>
                            <form action="product/{{$product->id}}/delete" class="d-inline" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
@endsection


