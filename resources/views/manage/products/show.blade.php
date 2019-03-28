@extends('adminlte::page')

@section('title', $product['style'].' size '.$product['size'])

@section('content')

        <div class="container">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-5">
                        <div width='100%' height='100%'>
                           <img src="storage/images/product_images/{{ $product['product_image'] }}" alt="{{ $product['style'] }} image"> 
                        </div>
                    </div>
                </div>
                        
                <div class="row">
                    <div class="col-md-5">
                        <hr>
                            <p><b>Brand: </b>{{$product['brand']}}</p>
                            <p><b>Style: </b>{{$product['style']}}</p>
                        <hr>
                            <div class="col-md-2" style="display: block;">
                                <a class="btn btn-primary btn-lg text-sm-left" href="#">Order</a>
                            </div>
                            <br>
                            <div class="col-md-2" style="display: block;">
                                <a class="btn btn-danger btn-lg" href="{{ route('products.index') }}">Stock Items List</a>
                            </div>
                        <hr>
                    </div>
                </div>
                        
            </div>
        </div>


@endsection