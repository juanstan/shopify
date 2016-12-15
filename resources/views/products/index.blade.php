@extends('layout')

@section('content')

<div id='list-products'>
     <h1>My Product List</h1>
    @foreach ($products as $product)
    <div class="list-group">
        <figure class='figure product-img'>
             @if ($product->image)
                <img src='{{$product->image->src}}' width='100px' />
            @else
                <img src='/img/no_image.png' width='100px' class="img-thumbnail"/>
            @endif
        </figure>
        <div class='product-info'>
            <h5 class="list-group-item-heading">{{$product->title}}</h5>
            <div class="list-group-item-text">{{$product->body_html}}</div>
        </div>
    </div>    
    @endforeach
</div>
        
{{ HTML::linkRoute('products.create', 'Add a new product', false, ['class'=>'add-product-link']) }}

@stop