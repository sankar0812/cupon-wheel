@extends('layouts.adminapp')
@section('title', 'Subscription')
@section('contentdashboard')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Subscription Plan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ route('admin.home') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">subscription</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title"><a href="{{ url()->previous() }}"><i class="fa fa-arrow-left"
                            aria-hidden="true"></i></a>&nbsp; subscription </h2>

                <div class="row">
                    @foreach ($subscribe as $subscribes)
                        <div class="col-4">
                            <div class="card  card-warning">
                                <div class="card-header">
                                    <h6 class="card-title">{{ $subscribes->Sub_title }}</h6>
                                </div>
                                <div class="card-body">
                                    <ul>
                                        @foreach ($subscribes->result as $view)
                                            <h6 class="card-text">
                                                <li>{{ $view->addsub_content }}</li>
                                            </h6>
                                        @endforeach
                                    </ul>

                                </div>

                            </div>
                        </div>
                    @endforeach


                </div>

            </div>
        </section>
    </div>


@endsection
