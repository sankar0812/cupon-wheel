@extends('layouts.customerapp')
@section('title', 'Create-Form')
@section('websitecontent')

@include('websitefile.assetslink.popmessage')
    <main>
        <form action="{{ url('customer-subscribeinsert') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <input type="hidden" name="customerid" value="{{ session('customerid') }}">
            <input type="hidden" name="subsc_id" value="{{ $subscribeid }}">
            <input type="hidden" name="branch_id" id="" value="{{ $branch_id }}">
            <section class="section-4 ">

                <div class="container ">
                    <p class="mt-5 py-4"><span class="bgcreate">Create Subscription</span></p>
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
                                        <th>Sugar type</th>
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
                    <p class="mt-3 py-4"><span class="bgcreate">Select Delivery days and Session</span></p>

                    <div class="row ">
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
                            <h6>Repeat Days</h6>
                            {{-- <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <button class="btn btn-outline-dark" id="toggleAllWeekdays">MON-SUN</button>
                            <button class="btn btn-outline-dark" id="deselectWeekdays">CUSTOM</button>
                        </div>
                        <div class="weekDays-selector py-3">
                            <input type="checkbox" id="weekday-all" class="weekday[]" value="Mon"/>
                            <label for="weekday-mon">MON</label>
                            <input type="checkbox" id="weekday-tue" class="weekday" value="Tue"/>
                            <label for="weekday-tue">TUE</label>
                            <input type="checkbox" id="weekday-wed" class="weekday" value="wed"/>
                            <label for="weekday-wed">WED</label>
                            <input type="checkbox" id="weekday-thu" class="weekday" value="Thu" />
                            <label for="weekday-thu">THU</label>
                            <input type="checkbox" id="weekday-fri" class="weekday" value="Fri" />
                            <label for="weekday-fri">FRI</label>
                            <input type="checkbox" id="weekday-sat" class="weekday" value="Sat" />
                            <label for="weekday-sat">SAT</label>
                            <input type="checkbox" id="weekday-sun" class="weekday" value="Sun" />
                            <label for="weekday-sun">SUN</label>
                        </div> --}}

                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                <a class="btn btn-outline-dark" id="toggleAllWeekdays">MON-SUN</a>
                                <a class="btn btn-outline-dark" id="deselectWeekdays">CUSTOM</a>
                            </div>
                            <div class="weekDays-selector py-3">
                                @foreach ($days as $dayss)
                                    <input type="checkbox" id="weekday-{{ strtolower($dayss->day_name) }}" name="days[]"
                                        class="weekday" value="{{ $dayss->day_name }}" />
                                    <label
                                        for="weekday-{{ strtolower($dayss->day_name) }}">{{ strtoupper(substr($dayss->day_name, 0, 3)) }}</label>
                                @endforeach
                            </div>

                        </div>
                    </div>



                    <div class="text-center mt-2">
                        <input type="submit" class="btn btn-primary" value="submit">
                        <a href="{{ url('customer-pricing') }}" class="btn btn-danger">Cancel</a>
                    </div>
                </div>
            </section>
        </form>

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
                    quantitySelect.append('<option value="' + value.id + '">' + value.capa_lit + ' (' + value.capa_per_cup + ') - ' + value.menu_price + '</option>');
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
