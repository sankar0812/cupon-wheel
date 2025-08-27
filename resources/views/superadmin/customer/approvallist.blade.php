@extends('layouts.adminapp')
@section('title', 'All-list')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Customer All list</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">All list</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a>All List</h2>

                <div class="row">

                    <div class="col-12">
                        <div class="card card-warning">

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Business Name</th>
                                                <th>person Name</th>
                                                <th>contact Number</th>
                                                <th>Reg Date</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 0; $i < 0; $i++)
                                            @endfor

                                                {{-- <tr>
                                                    <td>{{ ++$i }}
                                                    </td>
                                                </tr> --}}


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


@endsection
