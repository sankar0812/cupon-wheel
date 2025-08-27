@extends('layouts.adminapp')
@section('title', 'Category')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Category Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Category </div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> Category</h2>

                <div class="row">
                    <div class="col-4">
                        <div class="card card-warning">

                            <form class="needs-validation" novalidate="" action="{{ route('admin.categoryadd') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Category Name</label>
                                        <input type="text" class="form-control" required="" name="catname">
                                        <div class="invalid-feedback">
                                            category name?
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" class="form-control" required="" name="catfile">
                                        <div class="invalid-feedback">
                                            Upload File?
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-warning">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class="card card-warning">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor
                                            @foreach ($categories as $categoriess)
                                                <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                    <td>{{ $categoriess->cat_name }}</td>

                                                    <td>
                                                        <img alt="image"
                                                            src="{{ url('uploads/categories', $categoriess->cat_file) }}"
                                                            class="rounded-circle zoom" width="35" height="35"
                                                            data-toggle="tooltip" title="{{ $categoriess->cat_name }}">
                                                    </td>

                                                    <td>
                                                        @if ($categoriess->cat_status == 1)
                                                            <a
                                                                href="{{ route('admin.categorystatus', $categoriess->id) }}">
                                                                <div class="badge badge-success">Active</div>
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{ route('admin.categorystatus', $categoriess->id) }}">
                                                                <div class="badge badge-danger">Deactive</div>
                                                            </a>
                                                        @endif

                                                    </td>
                                                    <td><a href="#" class="btn " data-toggle="modal"
                                                            data-target="#categoryModal{{ $categoriess->id }}"><i
                                                                class="ion-edit" data-pack="default"
                                                                data-tags="change, update, write, type, pencil"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    @foreach ($categories as $categoriess)
        <div class="modal fade" tabindex="-1" role="dialog" id="categoryModal{{ $categoriess->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate=""
                        action="{{ route('admin.categoryupdate', $categoriess->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Category Name</label>
                                <input type="text" class="form-control" required="" name="catname"
                                    value="{{ $categoriess->cat_name }}">
                                <div class="invalid-feedback">
                                    category name?
                                </div>
                            </div>
                            <div class="form-group">
                                <label>File</label>
                                <input type="file" class="form-control" name="catfile">
                                <div class="invalid-feedback">
                                    Upload File?
                                </div>

                                <img alt="image" src="{{ url('uploads/categories', $categoriess->cat_file) }}"
                                    class="rounded-circle" width="35" height="35" data-toggle="tooltip"
                                    title="{{ $categoriess->cat_name }}">
                            </div>

                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                            <button type="submit" class="btn btn-warning">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection
