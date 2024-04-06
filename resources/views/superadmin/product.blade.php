@extends('layouts.adminapp')
@section('title', 'Product')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Product Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>

                    <div class="breadcrumb-item">Product</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> Product</h2>


                <div class="row">
                    <div class="col-4">
                        <div class="card card-warning">
                            <form class="needs-validation" novalidate="" action="{{ route('admin.productadd') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2" required="" name="catid">
                                            <option selected hidden disabled>Please Select Category</option>
                                            @foreach ($category as $categorys)
                                                <option value="{{ $categorys->id }}">{{ $categorys->cat_name }}</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Category?
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" required="" name="proname">
                                        <div class="invalid-feedback">
                                            Product name?
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description </label>

                                        {{-- <input type="text" class="form-control" required=""> --}}
                                        <textarea class="form-control" required="" name="prodescription"></textarea>
                                        <div class="invalid-feedback">
                                            Description?

                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" required="" name="proprice">
                                        <div class="invalid-feedback">
                                            Price?
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" class="form-control" required="" name="profile">
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
                                                </th>Category<th>
                                                <th>Product</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor
                                            @foreach ($product as $products)
                                                <tr>
                                                    <td>
                                                        {{ ++$i }}
                                                    </td>
                                                    <td>{{ $products->cat_name }}</td>
                                                    <td>{{ $products->pro_name }}</td>
                                                    <td>

                                                        <img alt="image"
                                                            src="{{ url('uploads/product', $products->pro_file) }}"
                                                            class="rounded-circle zoom" width="35" height="35"
                                                            data-toggle="tooltip" title="{{ $products->pro_name }}">
                                                    </td>

                                                    <td>
                                                        @if ($products->pro_status == 1)
                                                            <a
                                                                href="{{ route('admin.productstatus', $products->id) }}">
                                                                <div class="badge badge-success">Active</div>
                                                            </a>
                                                        @else
                                                            <a
                                                                href="{{ route('admin.productstatus', $products->id) }}">
                                                                <div class="badge badge-danger">Deactive</div>
                                                            </a>
                                                        @endif

                                                    </td>
                                                    <td><a href="#" class="btn " data-toggle="modal"
                                                            data-target="#productModal{{ $products->id }}"><i
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

    @foreach ($product as $products)
        <div class="modal fade" tabindex="-1" role="dialog" id="productModal{{ $products->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate=""
                        action="{{ route('admin.productupdate', $products->id) }}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group ">
                                        <label>Category Name</label><br>
                                        <select class="form-control" required="" name="catid">

                                            @foreach ($category as $categorys)
                                                <option value="{{ $categorys->id }}"
                                                    {{ $categorys->id == $products->pro_catid ? 'selected' : '' }}>
                                                    {{ $categorys->cat_name }}</option>
                                            @endforeach

                                        </select>
                                        <div class="invalid-feedback">
                                            Category?
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input type="text" class="form-control" required="" name="proname"
                                            value="{{ $products->pro_name }}">
                                        <div class="invalid-feedback">
                                            Product name?
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Description </label>
                                        {{-- class="summernote" --}}
                                        {{-- <input type="text" class="form-control" required=""> --}}
                                        <textarea class="form-control" required="" name="prodescription"> {{ $products->pro_description }} </textarea>
                                        <div class="invalid-feedback">
                                            Description?

                                        </div>
                                    </div>
                                    {{-- <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" required="" name="proprice"
                                            value="{{ $products->pro_price }}">
                                        <div class="invalid-feedback">
                                            Price?
                                        </div>
                                    </div> --}}

                                    <div class="form-group">
                                        <label>File</label>
                                        <input type="file" class="form-control" name="profile">

                                        <div class="invalid-feedback">
                                            Upload File?
                                        </div>

                                        <img alt="image" src="{{ url('uploads/product', $products->pro_file) }}"
                                            class="rounded-circle" width="35" height="35" data-toggle="tooltip"
                                            title="{{ $products->pro_name }}">
                                    </div>
                                </div>
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
