@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Works</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Our works </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Our Works</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.our_works.update' , ['id' => $our_works->id])}}" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="card-body">


                        @foreach($langs as $lang)
                            <div class="form-group">
                                <label for="name">Name ({{ $lang->name }}) </label>
                                <input type="text" name="name[{{$lang->code}}]" class="form-control" id="name" placeholder="Enter Name" value="{{ isset($our_works->translate($lang->code)->name) ? $our_works->translate($lang->code)->name : '' }}">
                                @error('name.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('name.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach



                        @foreach($langs as $index => $lang)


                            <div class="form-group">
                                <label for="description">Description ({{$lang->name}})</label>
                                <textarea name="des[{{$lang->code}}]" class="ckeditor">
                                    @if (isset($our_works->translate($lang->code)->des))
                                       {{$our_works->translate($lang->code)->des}}
                                    @endif
                                     
                                </textarea>

                                @error('des.' . $lang->code)
                                <div class="text-danger">{{ $errors->first('des.' . $lang->code) }}</div>
                                @enderror
                            </div>
                        @endforeach



                        <div class="form-group">
                            <label for="image">Photo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="photo" type="file" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose Photo</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>

                            <img src="{{asset('uploads/images/ourworks/'. $our_works->photo)}}" width="150px" height="150px">

                            @error('photo')
                            <div class="text-danger">{{ $errors->first('photo') }}</div>
                            @enderror
                        </div>

                        <br>
                        <div class="border  p-3">

                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="alt_image">Alt Image  ({{ $lang->name }}) </label>
                                    <input type="text" name="alt_image[{{$lang->code}}]" class="form-control" id="alt_image" placeholder="Enter Alt Image" value="{{ isset($our_works->translate($lang->code)->alt_image) ? $our_works->translate($lang->code)->alt_image :'' }}">
                                    @error('alt_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('alt_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                        <br>


                        <div class="border p-3">
                            @foreach($langs as $lang)
                                <div class="form-group">
                                    <label for="title_image">Title Image  ({{ $lang->name }}) </label>
                                    <input type="text" name="title_image[{{$lang->code}}]" class="form-control" id="title_image" placeholder="Enter Title Image" value="{{ isset($our_works->translate($lang->code)->title_image) ? $our_works->translate($lang->code)->title_image : '' }}">
                                    @error('title_image.' . $lang->code)
                                    <div class="text-danger">{{ $errors->first('title_image.' . $lang->code) }}</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>

                        <div class="form-group">
                            <label for="icon">Icon</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input name="icon" type="file" class="custom-file-input" id="icon">
                                    <label class="custom-file-label" for="icon">Choose Icon</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="">Upload</span>
                                </div>
                            </div>
                            <img src="{{asset('uploads/images/ourworks/'. $our_works->icon)}}" width="150px" height="150px">

                            @error('icon')
                            <div class="text-danger">{{ $errors->first('icon') }}</div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="name">Link</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="Enter Link" value="{{ $our_works->link}}">

                            @error('link')
                            <div class="text-danger">{{ $errors->first('link') }}</div>
                            @enderror
                        </div>


                            <div class="border  p-3">

                                @foreach($langs as $index => $lang)

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title ({{$lang->name}})</label>
                                        <textarea name="meta_title[{{$lang->code}}]" class="ckeditor">

                                            @if (isset($our_works->translate($lang->code)->meta_title))

                                              {{$our_works->translate($lang->code)->meta_title}}
                                                
                                            @endif
                                         
                                        </textarea>

                                        @error('meta_title.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('meta_title.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach

                            </div>

                            <br>

                            <div class="border  p-3">


                                @foreach($langs as $index => $lang)
                                    <div class="form-group">
                                        <label for="meta_des">Meta Description ({{$lang->name}})</label>
                                        <textarea name="meta_des[{{$lang->code}}]" class="ckeditor">
                                            @if (isset($our_works->translate($lang->code)->meta_des))
                                              {{$our_works->translate($lang->code)->meta_des}}
                                            @endif
                                            
                                        </textarea>

                                        @error('meta_des.' . $lang->code)
                                        <div class="text-danger">{{ $errors->first('meta_des.' . $lang->code) }}</div>
                                        @enderror
                                    </div>
                                @endforeach

                            </div>


                            <div class="form-group">
                                <label>Media</label>
                                <select type="text" name="media_id" class="form-control">
                                    <option value="null">Select Media</option>
                                    @forelse($medias as $media)
                                        <option value="{{$media->id}}"   {{ $media->id ==  $our_works->media_id ? 'selected' : ''}}> {{ $our_works->media->name }}</option>
                                    @empty
                                    @endforelse
    
                                </select>
                                @error('media')
                                <div class="text-danger">{{ $errors->first('media') }}</div>
                                @enderror
                            </div>




                    </div>


                    <div class="card-footer">
                        <button type="submit" class="btn btn-info"> <i class="nav-icon fas fa-paper-plane"></i> Update</button>
                    </div>

                </form>
            </div>

        </div>
    </section>
@endsection
