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
                <div class="card-header">{{ __('Add a category') }}</div>
                <div class="card-body">
                    {{ Form::open(array('url' => 'categories')) }}
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Category's Name" name="category_name" aria-label="Category's Name" aria-describedby="basic-addon2">
                        <div class="input-group-append mx-1">
                            {{ Form::button('<i class="fa-solid fa-plus"></i> Add', array('class' => 'btn btn-outline-secondary', 'name' => 'add_category','type' => 'submit' )) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
            <div class="card mt-3">
                {{ Form::open(array('url' => 'categories')) }}
                    <div class="card-header d-flex justify-content-between align-items-center">{{ __('Categories') }} 
                        {{ Form::button('<i class="fa-regular fa-floppy-disk"></i> Save', array('class' => 'btn btn-outline-success', 'name' => 'update_category','value' =>'','type' => 'submit' )) }}
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                                @foreach ($categories as $item)    
                                    <div class="list-group-item">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="category_{{$item->id}}"  name="categories[{{$item->id}}]" value="{{$item->name}}" disabled aria-label="Category's Name" aria-describedby="basic-addon2">
                                            <div class="input-group-append mx-1">
                                                <button class="btn btn-outline-info" type="button" onclick="enableIt('category_{{$item->id}}',this)" ><i class="fa-regular fa-pen-to-square"></i> Edit</button>
                                            </div>
                                            <div class="input-group-append mx-1">
                                                {{ Form::button('<i class="fa-regular fa-square-minus"></i> Delete', array('class' => 'btn btn-outline-danger', 'name' => 'delete_category','value' =>$item->id,'type' => 'submit' )) }}
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
<script>
function enableIt(id,btn){
    var inp = document.getElementById(id);
    if(inp.hasAttribute('disabled')){
        inp.removeAttribute( "disabled");
        inp.placeholder = inp.value;
        btn.className = "btn btn-outline-success";
    }else{
        disableIt(id);
        btn.className = "btn btn-outline-info";
    }
};
function disableIt(id){
    document.getElementById(id).value = document.getElementById(id).placeholder;
    document.getElementById(id).setAttribute( "disabled",'');
};
function submit(){
    document.getElementById('formId').submit();
};
</script>
@endsection

