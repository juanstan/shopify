@extends('layout')

@section('content')
<h1>Add a product</h1>
<div id='product_add'>
    <div class='alert alert-danger hidden'>
        <div>Form Submited With The Following Errors:</div>
        <div class='errors'></div>
    </div>
{!! Form::open(['files'=> 'true', 'route' => 'products.store', 'method' => 'post', 'class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}
        <div class="dropzone-previews"></div>
        <div class="form-group">
            {!! Form::label('title', 'Product\'s title') !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('description', 'Product\'s description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows'=>'5']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('price', 'Product\'s price') !!}
            {!! Form::number('price', '0.00', ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('sku', 'Product\'s sku') !!}
            {!! Form::text('sku', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!!Form::label('product_type', 'Product\'s Type:')!!}
            {!!Form::select('product_type', array('Unified','Shopify'), null, ['class'=>'form-control'])!!}
        </div>
        <div class="form-group">
            {!!Form::label('vendor', 'Vendor:')!!}
            {!!Form::select('vendor', array('Juanstan','Shopify'), null, ['class'=>'form-control'])!!}
        </div>
        {!!Form::label('image', 'Product\'s Image:')!!}
        <div class="form-group top-buffer">
            {!! Form::submit('Save changes', ['class' => 'save-changes btn btn-default btn-md pull-right']) !!}
            <div class="loading btn btn-default btn-lg hidden disabled pull-right"><i class="fa fa-refresh fa-spin"></i> Submitting</div>
        </div>
{!! Form::close() !!}
</div>

@stop