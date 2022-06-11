@extends('layouts.app')
@section('content')
<div class="container">
    @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="/home"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('products.update',[$prd->id]) }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" value = "{{ $prd->name }}" >
                </div>
            </div>

            <input type="hidden" name="user_id" value = {{ Auth::user()->id }} >

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                <strong>Description:</strong>
                    <textarea class="form-control" style="height:150px" name="description" >{{ $prd->description }}</textarea>
                </div>
            </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="number" step="0.01" name="price" class="form-control" value = "{{ $prd->price }}">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input type="file" name="file" placeholder="Choose file" id="file">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection