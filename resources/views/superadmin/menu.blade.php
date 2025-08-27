@extends('layouts.adminapp')
@section('title', 'Menu')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menu Details</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Menu</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a> Menu</h2>

                <div class="row">
                    <div class="col-4">
                        <div class="card card-warning">

                            <form class="needs-validation" novalidate="" action="{{ route('admin.menuadd') }}"
                                method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control select2" required="" name="categoryid">
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
                                        <label>Quantity</label>
                                        <select class="form-control select2" required="" name="capacityid">
                                            <option selected hidden disabled>Please Select Quantity</option>
                                            @foreach ($capacity as $capacitys)
                                                <option value="{{ $capacitys->id }}">{{ $capacitys->capa_lit }} (
                                                    {{ $capacitys->capa_per_cup }} )</option>
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Quantity?
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Price</label>
                                        <input type="text" class="form-control" required="" name="price">
                                        <div class="invalid-feedback">
                                            Price?
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
                                                <th>category</th>
                                                <th>Quantity</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor
                                            @foreach ($menu as $menus)
                                                <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                    <td>{{ $menus->cat_name }}</td>
                                                    <td>{{ $menus->capa_lit }} ( {{ $menus->capa_per_cup }} )</td>
                                                    <td>{{ $menus->menu_price }}</td>
                                                    {{-- <td>
                                                        <img alt="image"
                                                            src=""
                                                            class="rounded-circle zoom" width="35" height="35"
                                                            data-toggle="tooltip" title="">
                                                    </td> --}}

                                                    <td>
                                                        @if ($menus->menu_status == 1)
                                                            <a href="{{ route('admin.menustatus', $menus->id) }}">
                                                                <div class="badge badge-success">Active</div>
                                                            </a>
                                                        @else
                                                            <a href="{{ route('admin.menustatus', $menus->id) }}">
                                                                <div class="badge badge-danger">Deactive</div>
                                                            </a>
                                                        @endif

                                                    </td>
                                                    <td><a href="#" class="btn " data-toggle="modal"
                                                            data-target="#menuModal{{ $menus->id }}"><i class="ion-edit"
                                                                data-pack="default"
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

    @foreach ($menu as $menus)
        <div class="modal fade" tabindex="-1" role="dialog" id="menuModal{{ $menus->id }}">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="needs-validation" novalidate="" action="{{ route('admin.menuupdate', $menus->id) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" required="" name="categoryid">
                                    <option selected hidden disabled>Please Select Category</option>
                                    @foreach ($category as $categorys)
                                        <option value="{{ $categorys->id }}"
                                            {{ $categorys->id == $menus->menu_catid ? 'selected' : '' }}>
                                            {{ $categorys->cat_name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Category?
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <select class="form-control" required="" name="capacityid">
                                    <option selected hidden disabled>Please Select Quantity</option>
                                    @foreach ($capacity as $capacitys)
                                        <option value="{{ $capacitys->id }}" {{ $capacitys->id == $menus->menu_capaid ? 'selected' : ''}} >{{ $capacitys->capa_lit }} (
                                            {{ $capacitys->capa_per_cup }} )</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Quantity?
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input type="text" class="form-control" required="" name="price" value="{{ $menus->menu_price }}">
                                <div class="invalid-feedback">
                                    Price?
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
