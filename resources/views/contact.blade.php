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
            {{ Form::open(array('route' => array('send_mail'))) }}
            <div class="card mt-3">
                <div class="card-header d-flex justify-content-between align-items-center">{{ __('Contact') }}
                    {{ Form::button('<i class="fa-regular fa-plus"></i> Send', array('class' => 'btn btn-outline-secondary', 'name' => 'add','value' =>'','type' => 'submit' )) }}
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">From</span>
                        {{Form::email('from' ,'',array('class' => 'form-control', 'required' =>'true' ))}}                    
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text add-bill-label-width">Message</span>
                        {{Form::textArea('body' ,'',array('class' => 'form-control', 'required' =>'true' ))}}                    
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
