@extends('layouts.app')

@section('content')
<div class="container mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                @if(Session::has('message'))
                <div class="card-header"> {{ Session::get('message') }}</div>     
            </div>
            @endif
            {{ Form::open(array('route' => array('store_address'))) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Add Address') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Add', array('class' => 'btn btn-outline-secondary', 'name' => 'add','value' =>'','type' => 'submit' )) }}
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Address identifier</span>
                        {{Form::text('address' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Address Details</span>
                        {{Form::text('address_details' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Phone</span>
                        {{Form::text('phone' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
