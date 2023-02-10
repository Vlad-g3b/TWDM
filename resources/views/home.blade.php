@extends('layouts.app')

@section('content')
<div class="container-fluid mt-8">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="mb-3">
                @if(Session::has('message'))
                <div class="card-header"> {{ Session::get('message') }}</div>     
            </div>
            @endif
            <div class="card mt-3">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                        <div class="home_amount">{{number_format((float)$info['paidMonth'],2,',', '.')}} lei</div>
                        <div style="text-align: center"> Amount paid this mounth </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home_amount" >{{number_format((float)$info['toBePaid'],2,',', '.')}} lei</div>
                        <div style="text-align: center"> Amount to be paid </div>
                    </div>
                    <div class="col-md-4">
                        <div class="home_amount" >{{number_format((float)$info['paidYear'],2,',', '.')}} lei</div>
                        <div style="text-align: center"> Amount paid this year </div>
                    </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Unpaid bills this month') }}
                </div>
                <div class="card-body">
                    @if(count($bills) == 0)
                    Nothing to pay this month !
                    @else   
                    @foreach ($bills as $cat => $bills_by_cat)
                    <div class="card mb-3">
                        <div class="card-header">{{ $cat }}</div>
                        <div class="card-body">
                            @foreach ($bills_by_cat as $item)    
                            <div class="row list-group list-group-horizontal mb-3">
                                <div class="col list-group-item text-center">
                                    {{$item->address->address}} {{$item->name}}   
                                </div>
                                <div class="col list-group-item text-center">
                                    Total:{{number_format((float)$item->amount,2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    Paid:{{number_format((float)$item->amount_paid,2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    Remaining:{{number_format((float)($item->amount - $item->amount_paid),2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    {{$item->due_date}}    
                                </div>
                                <div class="col list-group-item text-center">
                                        {{ Form::button('Details', array('class' => 'btn btn-outline-info', 'name' => 'bill_details','onClick'=> "window.location='".route('bill_details',[$item])."'" ,'value' =>$item->id,'type' => 'button' )) }}
                                    </div>
                                    <div class="col list-group-item text-center">
                                    {{ Form::open(array('route' => array('pay',['bill'=>$item]))) }}
                                        <div class="text-center">
                                            {{ Form::button('Pay', array('class' => 'btn btn-outline-success', 'name' => '','value' =>'','type' => 'submit' )) }}
                                        </div>                            
                                    {{ Form::close() }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-header">{{ __('Uppcoming Bills') }}</div>
                <div class="card-body">
                @if(count($upcoming_bills) == 0)
                   No uppcoming bills!
                @else
                @foreach ($upcoming_bills as $cat => $bills_by_cat)
                    <div class="card mb-3">
                        <div class="card-header">{{ $cat }}</div>
                        <div class="card-body">
                            @foreach ($bills_by_cat as $item)    
                            <div class="row list-group list-group-horizontal mb-3">
                                <div class="col list-group-item text-center">
                                    {{$item->address->address}} {{$item->name}}   
                                </div>
                                <div class="col list-group-item text-center">
                                    Total:{{number_format((float)$item->amount,2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    Paid:{{number_format((float)$item->amount_paid,2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    Remaining:{{number_format((float)($item->amount - $item->amount_paid),2,',', '.')}} lei    
                                </div>
                                <div class="col list-group-item text-center">
                                    {{$item->due_date}}    
                                </div>
                                <div class="col list-group-item text-center">
                                        {{ Form::button('Details', array('class' => 'btn btn-outline-info', 'name' => 'bill_details','onClick'=> "window.location='".route('bill_details',[$item])."'" ,'value' =>$item->id,'type' => 'button' )) }}
                                    </div>
                                    <div class="col list-group-item text-center">
                                    {{ Form::open(array('route' => array('pay',['bill'=>$item]))) }}
                                        <div class="text-center">
                                            {{ Form::button('Pay', array('class' => 'btn btn-outline-success', 'name' => '','value' =>'','type' => 'submit' )) }}
                                        </div>                            
                                    {{ Form::close() }}
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
