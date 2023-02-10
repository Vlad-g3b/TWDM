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
            {{ Form::open(array('url' => 'bills')) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Bills') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Add Bill', array('class' => 'btn btn-outline-secondary', 'name' => 'add_bill','value' =>'','type' => 'submit' )) }}
                </div>
                <div class="card-body">
                    @foreach ($bills as $cat => $bills_by_cat)
                    <div class="card mb-3">
                        <div class="card-header">{{ $cat }}</div>
                        <div class="card-body">
                                <div class="">
                                @foreach ($bills_by_cat as $item)    
                                <div class="row list-group-horizontal">
                                    <div class="col list-group-item text-center" style="margin: auto">
                                        {{$item->address->address}}    
                                    </div>
                                    <div class="col list-group-item text-center" style="margin: auto"> 
                                        {{number_format((float)$item->amount,2,',', '.')}} lei    
                                    </div>
                                    <div class="col list-group-item text-center" style="margin: auto">
                                        {{$item->due_date}}    
                                    </div>
                                    <div class="col text-center">
                                        {{ Form::button('Details', array('class' => 'btn btn-outline-info', 'name' => 'bill_details','onClick'=> "window.location='".route('bill_details',[$item])."'" ,'value' =>$item->id,'type' => 'button' )) }}
                                        {{ Form::button('Delete', array('class' => 'btn btn-outline-danger', 'name' => 'bill_details','onClick'=> "window.location='".route('bill_delete',[$item])."'" ,'value' =>$item->id,'type' => 'button' )) }}
                                    </div>
                                </div>
                                <hr>
                                @endforeach
                                </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
