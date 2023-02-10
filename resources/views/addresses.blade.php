@extends('layouts.app')

@section('content')
<div class="container-fluid mt-8">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="mb-3">
                @if(isset($message))
                <div class="card-header"> {{ $message }}</div>     
            </div>
            @endif
            {{ Form::open(array('url' => '')) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Addresses') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Add Address', array('class' => 'btn btn-outline-secondary', 'name' => 'create_address','onClick'=> "window.location='".route('create_address')."'",'type' => 'button' )) }}
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach ($addresses as $item)    
                        <div class="list-group-item">
                            <div class="row">
                                    <div class="col text-center " style="margin: auto">
                                        {{$item->address}}    
                                    </div>
                                    <hr class="vert">
                                    <div class="col text-center" style="margin: auto">
                                        {{$item->address_details}}    
                                    </div>
                                    <hr class="vert">
                                    <div class="col text-center">
                                        {{ Form::button('Details', array('class' => 'btn btn-outline-info', 'name' => 'address_details','onClick'=> "window.location='".route('address_details',[$item])."'",'type' => 'button' )) }}
                                        {{ Form::button('Delete', array('class' => 'btn btn-outline-danger', 'name' => 'address_delete','onClick'=> "window.location='".route('address_delete',[$item])."'" ,'type' => 'button' )) }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            {{ Form::close() }}
            </div>
        </div>
    </div>
</div>

@endsection
