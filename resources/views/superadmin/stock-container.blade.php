@extends('layouts.adminapp')
@section('title', 'Stock')
@section('contentdashboard')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Stock</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                <div class="breadcrumb-item">stock</div>
            </div>
        </div>

        <div class="section-body">
            
            
            <div style="display: flex;
    align-items: center;
    justify-content: space-between;">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>&nbsp; Stock Maintains </h2>
                <a href="#" class="btn btn-primary"  data-toggle="modal" data-target="#stockaddModal">Add</a>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-warning">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>capacity</th>
                                            <th>Total </th>
                                            <th>Out</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @for ($i = 0; $i < 0; $i++) @endfor @foreach ($stock as $stocks) <tr>
                                            <td>{{++$i}}</td>
                                            <td>{{ $stocks->capa_lit }}</td>
                                            <td> <a href="#" class="text-dark" data-toggle="modal" data-target="#stockupdateModal{{ $stocks->id }}">{{ $stocks->sto_total }}</a>
                                            </td>
                                            <td>{{ $stocks->sto_out }}</td>
                                            <td>{{ $stocks->sto_balance }}</td>
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

{{-- capacity add --}}
<div class="modal fade" tabindex="-1" role="dialog" id="stockaddModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" novalidate="" action="{{ route('admin.stockadd') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control " required="" name="capacity">
                                    <option selected hidden disabled>Please Select Capacity</option>
                                    @foreach ($capacity as $capacitys)
                                    <option value="{{ $capacitys->id }}">{{ $capacitys->capa_lit }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Capacity?
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Count</label>
                                <input type="text" class="form-control" required="" name="count" value="">
                                <div class="invalid-feedback">
                                    Total count?
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-warning">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


{{-- capacity update --}}
@foreach ($stock as $stocks)
<div class="modal fade" tabindex="-1" role="dialog" id="stockupdateModal{{ $stocks->id }}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stock update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="needs-validation" novalidate="" action="{{ route('admin.stockupdate', $stocks->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">


                            <div class="form-group">
                                <label>Count</label>
                                <input type="text" class="form-control" required="" name="count" value="{{ $stocks->sto_total }}">
                                <div class="invalid-feedback">
                                    Total count?
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="modal-footer bg-whitesmoke br">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
                    <button type="submit" class="btn btn-warning">Save change</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach
@endsection