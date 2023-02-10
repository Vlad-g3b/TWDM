@extends('layouts.app')

@section('content')
<div class="container mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                @if(isset($message))
                <div class="card-header"> {{ $message }}</div>      
            </div>
            @endif
            {{ Form::open(array('route' => array('add'))) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Add bill') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Add', array('class' => 'btn btn-outline-secondary', 'name' => 'add','value' =>'','type' => 'submit' )) }}
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Description</span>
                        {{Form::text('name' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Address</span>
                        {{Form::select('address', $addresses, key($addresses), array('class' => 'form-select'));}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Amount</span>
                        {{Form::text('amount' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Day of The Month</span>
                        {{Form::text('day' ,'',array('class' => 'form-control' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Period</span>
                        {{Form::select('period', array('N'=>'No Recurency','M' => 'Monthly', 'S' => 'Semestral', 'A' => 'Annualy'), 'N', array('class' => 'form-select'));}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Category</span>
                        {{Form::select('category_id', $categories, key($categories), array('class' => 'form-select'));}}                    
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
