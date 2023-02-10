@extends('layouts.app')

@section('content')
<div class="container-fluid mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                @if(Session::has('message'))
                <div class="card-header"> {{ Session::get('message') }}</div>     
            </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">{{ __('Wallet') }}</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md">
                            <h1 class="" style="text-align: center">{{number_format((float)$balance->balance,2,',', '.')}} lei</h1>
                            <div style="text-align: center"> Available </div>
                        </div>
                    </div>
                </div>
            </div>
            {{ Form::open(array('route' => array('add_money',['userBalance'=>$balance]))) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Add Money') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Add', array('class' => 'btn btn-outline-secondary', 'name' => 'add','value' =>'','type' => 'submit' )) }}
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Money</span>
                        {{Form::number('wallet_money' ,'',array('class' => 'form-control','required'=>'','step'=>'0.01' ))}}                    
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        
        </div>
    </div>
</div>
@endsection
