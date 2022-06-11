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


<div class="row justify-content-between">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>My Products</h2>
            </div>
        </div>
    </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row gx-5">
        @foreach ($products as $prd)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="card" style="">
                <img class="card-img-top" src="{{ $prd->path }}" alt="Product Image Not Found">
                <div class="card-body">
                    <h5 class="card-title">{{ $prd->name }}</h5>
                    <p class="card-text">{{ $prd->price }} $</p>
                    <p class="card-text">{{ $prd->description }}</p>
                    
                    <form action="{{ route('products.destroy',$prd->id) }}" method="POST">
   
                    @csrf
                    @method('DELETE')
                    <a class="btn btn-primary" href="{{ route('products.edit',$prd->id) }}">Edit</a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
                </div>
            </div>
        </div>    
    @endforeach
    </div>
</div> 
@endsection
