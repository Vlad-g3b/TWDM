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
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('History') }}
                </div>
                <div class="card-body"> 
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
                                    {{$item->due_date}}    
                                </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
