@extends('admin.layout.master')

@section('content')

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Achivement</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Achivement </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title"> Achivement</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.ach.store') }}"  enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">

                        <div class="border  p-3">
                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="title">Name ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="title" placeholder="Enter Name" value="{{ old('name.' . $lang->code) }}">
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
                                    <input name="small_des[{{$lang->code}}]" class="form-control" />
                                    @error('small_des.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('small_des.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <br>


                        <div class="border p-3">
                            <div class="form-group">
                                <label for="value">Value  </label>
                                <input type="number" name="value" class="form-control" id="price" placeholder="Enter Value" value="{{ old('value') }}">
                                @error('value')
                                <div class="text-danger">{{ $errors->first('value') }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>



                        <div class="border p-3">
                            <div class="form-group">
                                <label for="max_value">Max Value  </label>
                                <input type="number" name="max_value" class="form-control" id="max_value" placeholder="Enter Max Value" value="{{ old('max_value') }}">
                                @error('max_value')
                                <div class="text-danger">{{ $errors->first('max_value') }}</div>
                                @enderror
                            </div>
                        </div>
                        <br>

                        <div class="border p-3">
                            <div class="form-group">
                                <label for="image">Image Or Icon </label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input name="image" type="file" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose Image</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="">Upload</span>
                                    </div>
                                </div>
    
                                @error('image')
                                <div class="text-danger">{{ $errors->first('image') }}</div>
                                @enderror
                            </div>
                        </div>
























{{--                        <div class="form-group">--}}
{{--                            <label>Category</label>--}}
{{--                            <select type="text" name="category" class="form-control">--}}
{{--                                <option value="0">Select Category</option>--}}
{{--                                @forelse($categories as $category)--}}
{{--                                    <option value="{{$category->id}}">{{$category->translate($langs[0]->code)->name}}</option>--}}
{{--                                @empty--}}
{{--                                @endforelse--}}

{{--                            </select>--}}
{{--                            @error('category')--}}
{{--                            <div class="text-danger">{{ $errors->first('category') }}</div>--}}
{{--                            @enderror--}}
{{--                        </div>--}}







                    </div>



                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> Submit</button>
                    </div>


                </form>
            </div>

        </div>
    </section>
@endsection

