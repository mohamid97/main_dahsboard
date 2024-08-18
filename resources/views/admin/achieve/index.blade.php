@extends('admin.layout.master')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        Achievenments </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Achievenments</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div>

                <a href="{{route('admin.ach.add')}}" style="color: #FFF">
                    <button class="btn btn-info" >
                        <i class="nav-icon fas fa-plus"></i> Add New Achievenment
                    </button>
                </a>

            </div>
            <br>
            <div class="card card-info">

                <div class="card-header">
                    <h3 class="card-title">All Achievenments</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon | image</th>
                            <th>Name</th>
                            <th>value</th>
                            <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        @forelse($achieves as $index => $ach)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <img src="{{asset('uploads/images/achs/'. $ach->image)}}" width="70px" height="70px">
                                </td>
                                <td>{{$ach->name}}</td>
                                <td>{{$ach->value}}</td>
                                <td>
                                    <a href="{{route('admin.ach.edit' ,  ['id' => $ach->id])}}">
                                        <button class="btn btn-sm btn-info"> <i class="nav-icon fas fa-edit"></i> Edit</button>
                                    </a>

                                    @if($ach->deleted_at == null)

                                        <a href="{{route('admin.ach.soft_delete' ,  ['id' => $ach->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash"></i> Soft Delete</button>
                                        </a>
                                    @else
                                        <a href="{{route('admin.ach.restore' ,  ['id' => $ach->id])}}">
                                            <button class="btn btn-sm btn-info"><i class="nav-icon fas fa-trash-restore"></i> Restore</button>
                                        </a>
                                    @endif





                                    <a href="{{route('admin.ach.destroy' ,  ['id' => $ach->id])}}">
                                        <button class="btn btn-sm btn-danger"><i class="nav-icon fas fa-trash"></i> Remove</button>
                                    </a>

                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="3"> No Data</td>
                            </tr>
                        @endforelse


                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </section>

@endsection
