@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Achivments</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Achivments </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Achivments</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.ach.update' , ['id' => $ach->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">
                        <div class="border  p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="name">Name ({{ $lang->name }}) </label>
                                    <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="Enter Name" value=" {{isset($ach->translate($lang->code)->name) ? $ach->translate($lang->code)->name : ''}} ">
                                    @error('name.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                            </div>
                            <br>

                            <div class="border  p-3">
                                @foreach($langs as $index => $lang)
    
    
                                    <div class="form-group">
                                        <label for="small_des">Small Description ({{$lang->name}})</label>
                                        <input name="small_des[{{$lang->code}}]" class="form-control" value="{{isset($ach->translate($lang->code)->small_des) ? $ach->translate($lang->code)->small_des :''}}"/>
    
    
                                        @error('small_des.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('small_des.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach
                                </div>
                                <br>



                        <div class="form-group">
                            <label for="image">Image |Icon </label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="image" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Icon</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/achs/'. $ach->icon)}}" width="70px" height="70px">


                            @error('image')
                            <div class="text-danger">{{ $errors->first('image') }}</div>
                            @enderror
                        </div>

                    </div>



                    <div class="border p-3">
                        <div class="form-group">
                            <label for="value"> Value  </label>
                            <input type="number" name="value" class="form-control" id="value" placeholder="Enter Value" value="{{ $ach->value }}">
                            @error('value')
                            <div class="text-danger">{{ $errors->first('value') }}</div>
                            @enderror
                        </div>
                    </div>


                    <div class="border p-3">
                        <div class="form-group">
                            <label for="max_value"> max Value  </label>
                            <input type="number" name="max_value" class="form-control" id="max_value" placeholder="Enter  Max Value" value="{{ $ach->max_value }}">
                            @error('max_value')
                            <div class="text-danger">{{ $errors->first('max_value') }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> update</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection
