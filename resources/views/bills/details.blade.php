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
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Details') }}
                </div>
                <div class="card-body">
                    <div>
                        <div class="list-group mb-3">
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Description</span>
                                    <span class="list-group-item custom-text">{{$bill->name}}</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Category</span>
                                    <span class="list-group-item custom-text">{{$category_name}}</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Address Details</span>
                                    <span class="list-group-item custom-text">{{$bill->address->address_details}}</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Amount</span>
                                    <span class="list-group-item custom-text">{{number_format((float)$bill->amount,2,',', '.')}} lei</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Period</span>
                                    <span class="list-group-item custom-text">{{$bill->period}}</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Due Date</span>
                                    <span class="list-group-item custom-text">{{$bill->due_date}}</span>
                                </div>
                            </div>
                            <div class="list-group-item">
                                <div class="list-group list-group-horizontal">
                                    <span class="list-group-item custom-lable">Amount Paid</span>
                                    <span class="list-group-item custom-text">{{number_format((float)$bill->amount_paid,2,',', '.')}} lei</span>
                                </div>
                            </div>
                        </div>
                        <div class="list-group-item justify-content-center" >
                            {{ Form::open(array('route' => array('pay',['bill'=>$bill]))) }}
                                <div class="text-center">
                                    {{ Form::button('Pay', array('class' => 'btn btn-outline-success', 'name' => '','value' =>'','type' => 'submit' )) }}
                                </div>                            
                            {{ Form::close() }}
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
