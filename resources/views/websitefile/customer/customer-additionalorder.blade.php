@extends('layouts.customerapp')
@section('title', 'Additional-Form')
@section('websitecontent')
@include('websitefile.assetslink.popmessage')
    <main>
        <form action="{{ route('customer.additionalfrominsert') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="customerid" value="{{ session('customerid') }}">
            <input type="hidden" name="branch_id" id="" value="{{ $branch_id }}">
            <section class="section-4 ">

                <div class="container ">
                    <p class="mt-5 py-4"><span class="bgcreate">Additional Order</span></p>
                    <div class="row py-2">
                        @foreach ($data as $datas)
                            <div class="col-md-4 col">
                                <div class="card mb-3 bg-primary h-75">
                                    <ul class="floatright">
                                        <li> <img src="{{ url('/uploads/categories/', $datas->cat_file) }}"
                                                class="img-fluid img-fluids rounded-start" alt="...">
                                        </li>
                                        <li>
                                            <h5 class="card-title ">{{ $datas->cat_name }}</h5>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        @endforeach

                    </div>
                    <div class="boderline "></div>

                    <div class="row mt-3">
                        <div class="table-responsive">
                            <table class="_table">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Quantity Count</th>
                                        <th>Total Amount</th>
                                        <th width="50px">
                                            <div class="action_container">
                                                <a class="success" id="addRow">
                                                    <i class="fa fa-plus"></i>
                                                </a>
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    <tr>
                                        <td>
                                            <select class="form_control" name="categoryid[]" id="cat_id[]" required>
                                                <option selected hidden disabled>Please Select Category</option>
                                                @foreach ($data as $datas)
                                                    <option value="{{ $datas->menu_catid }}">
                                                        {{ $datas->cat_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <select class="form_control" name="menuid[]" id="quantity[]" required>
                                                <option selected hidden disabled>Please Select Quantity</option>

                                            </select>
                                        </td>
                                        <td>
                                            <input type="number" class="form_control" placeholder="Count" name="count[]"
                                                required autocomplete="off">
                                        </td>
                                        <td>
                                            <select class="form_control" name="sugartype[]" required>
                                                <option selected hidden disabled>Please Select Type</option>
                                                <option value="with-sugar">With Sugar</option>
                                                <option value="without-sugar">Without Sugar</option>
                                                <option value="none">None</option>
                                            </select>
                                        </td>
                                        <td>
                                            <div class="action_container">
                                                <a class="danger removeRow">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="boderline mt-3"></div>
                    <p class="mt-3 py-4"><span class="bgcreate">Select Delivery date and session</span></p>

                    <div class="row">
                        <div class="col-md-6 ">
                            <h6>Preffered Session</h6>
                            <div class="group py-3">
                                <input type="checkbox" name="morn" id="cb1" class="inputs" value="MOR" />
                                <label for="cb1">Morning</label><br>
                                <input type="checkbox" name="even" id="cb2" class="inputs" value="EVN" />
                                <label for="cb2">Evening</label><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Date</h6>
                            <div class="py-3">
                                <input type="date" class="form_control" name="date" id="datepicker"
                                    min="{{ date('Y-m-d') }}" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-2">
                        <input type="submit" class="btn btn-primary" value="submit">
                        <a href="{{ url('customer-shop') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </section>
        </form>



        {{-- <div class="boderline mt-3"></div>
        <section class="section-4 ">
            <div class="section-4-1">
                <div class="section-main">
                    <h1>Your Additional Orders</h1>
                </div>
            </div>
        </section> --}}

        @if (!empty($customerorder_morn))
            <div class="boderline mt-3"></div>
            <section class="section-4 ">
                <div class="section-4-1">
                    <div class="section-main">
                        <h1>Your Additional Orders</h1>
                    </div>
                </div>
            </section>

            @foreach ($customerorder_morn as $customerorder_morns)
                <div class="container">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Category</th>
                                        <th>Quantity</th>
                                        <th>Cups</th>
                                        {{-- <th>Amount</th> --}}
                                        <th>Quantity Count</th>
                                        <th>Sugar type</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    @foreach ($customerorder_morns->result as $results)
                                    <tr>
                                        <td>
                                            {{ $results->cat_name }}
                                        </td>
                                        <td>
                                            {{ $results->capa_lit }}
                                        </td>
                                        <td>
                                            {{ $results->capa_per_cup }}
                                        </td>
                                        {{-- <td>
                                        {{ $results->menu_price }}
                                    </td> --}}
                                        <td>
                                            {{ $results->quantitycount }}
                                        </td>
                                        <td>
                                            {{ $results->sugartype }}
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <p class=""><span class="bgcreate">Select Delivery days and Session</span></p> --}}

                    <div class="row py-5">
                        <div class="col-md-5">
                            <h6>Preffered Session</h6>

                            <tr class="mt-3">

                            @if ($customerorder_morns->session_morn == 'MOR')
                                <button class="btn btn-warning">
                                    <th>Morning</th>
                                </button>
                            @endif

                            @if ($customerorder_morns->session_even == 'EVN')
                                <button class="btn btn-warning">
                                    <th>Evening</th>
                                </button>
                            @endif

                            </tr>
                        </div>
                        <div class="col-md-7">
                            <h6>Repeat Days</h6>

                            <tr class="mt-3">

                            <button class="btn btn-warning">
                                <th>{{ $customerorder_morns->session_date }}</th>
                            </button>

                            </tr>

                        </div>
                    </div>
                </div>

                <div class="container"><div class="boderline mb-3"></div></div>
            @endforeach
        @endif
    </main>

@endsection
@push('other-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Row
            $("#addRow").click(function() {
                var newRow = $("#table_body").find("tr:first").clone();
                newRow.find('input, select').val('');
                $("#table_body").append(newRow);
            });

            // Remove Row
            $(document).on('click', '.removeRow', function() {
                if ($('#table_body tr').length === 1) {
                    alert("You can't delete the only row.");
                } else {
                    $(this).closest('tr').remove();
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('change', 'select[id^="cat_id"]', function() {
                var cat_id = $(this).val();
                var quantitySelect = $(this).closest('tr').find('select[id^="quantity"]');
                quantitySelect.html('<option value="">Loading...</option>');

                $.ajax({
                    url: "{{ url('get-item-by-quantity') }}",
                    type: "POST",
                    data: {
                        cat_id: cat_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        quantitySelect.empty();
                        quantitySelect.append('<option value="">Select Quantity</option>');
                        $.each(result.quantity, function(key, value) {
                            quantitySelect.append('<option value="' + value.id + '">' +
                                value.capa_lit + ' (' + value.capa_per_cup +
                                ') - ' + value.menu_price + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error("Ajax Error: ", error);
                    }
                });
            });
        });
    </script>
@endpush
