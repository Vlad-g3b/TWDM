@extends('layouts.app')

@section('content')
<div class="container mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
            </div>
            <div class="card mt-3">
                <div class="card-header">{{ __('Pay') }}</div>
                <div class="card-body">
                    <div class="list-group">
                        <div class="card mb-3">
                            <div class="card-header">{{ __($category_name) }}</div>
                            <div class="card-body">
                                    <div class="list-group">
                                        
                                        <div class="list-group-item">
                                            <div class="row list-group list-group-horizontal mb-3">
                                            <div class="col list-group-item text-center">
                                                Bill id:{{$bill->id}}    
                                            </div>
                                            <div class="col list-group-item text-center">
                                                Amount:{{number_format((float)$bill->amount,2,',', '.')}} lei
                                            </div>
                                            <div class="col list-group-item text-center">
                                                Remaining:{{number_format((float) ($bill->amount - $bill->amount_paid),2,',', '.')}} lei
                                            </div>
                                            <div class="col list-group-item text-center">
                                                Date:{{$bill->due_date}}
                                            </div>
                                        </div>
                                        </div>
                                        <div class="list-group-item">
                                            You have {{$balance->balance}} lei in your wallet.
                                            @if(isset($have_to_pay))
                                            <div > You paid just {{  $have_to_pay }} lei.</div>     
                                            @endif
                                            <hr>

                                            {{ Form::open(array('route' => array('submit_pay',['bill'=>$bill]))) }}
                                                    <div class="input-group mb-3">
                                                        @if ($bill->is_paid == 1) 
                                                        {{Form::number('amount','', array('class' => 'form-control','step'=>'0.01' ,'aria-describedby' => 'button-addon2', 'aria-label'=>"amount",'placeholder'=> 'How much do you want to Pay?',"disabled"))}}                    
                                                        {{Form::button('Pay', array('class' => 'btn btn-outline-success','type' => 'submit','id'=>'button-addon2',"disabled" )) }}
                                                    @else
                                                        {{Form::number('amount','', array('class' => 'form-control','step'=>'0.01' ,'aria-describedby' => 'button-addon2', 'aria-label'=>"amount",'placeholder'=> 'How much do you want to Pay?'))}}                    
                                                        {{Form::button('Pay', array('class' => 'btn btn-outline-success','type' => 'submit','id'=>'button-addon2' )) }}
                                                    @endif
                                                </div>

                                                <!--<input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2"> 
                                                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">Button</button>-->
                                              
                                                {{ Form::close() }}
                                        </div>
                                    </div>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
    
        </div>
    </div>
</div>
@endsection
