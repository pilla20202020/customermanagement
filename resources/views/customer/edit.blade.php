@extends('layouts.admin.admin')

@section('title', 'Edit Staff')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('customer.update', $customer->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('customer.form',['header' => 'Edit staff <span class="text-danger h5">('.($customer->first_name). "&nbsp;" .($customer->last_name).')</span>'])
            </form>
        </div>
    </section>

@endsection

@section('scripts')
 <script>
    $(document).ready(function(){
        $('#perm_province_id_dropdown').on('change', function(e){
            e.preventDefault();
            var province_id = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "POST",
                url: "{{route('customer.get_perm_district')}}",
                data:{
                    perm_province_id:province_id
                },
                dataType: "json",
                success: function(response){
                    // console.log(response.message);
                    $('#perm_district_id_dropdown').html('<option value="" selected disabled>Select District</option>');
                    $.each(response.message, function(key, value){
                        $('#perm_district_id_dropdown').append('<option value="'+value.id+'">'+value.district_name+'</option>')
                    });
                }
            })
        });

        $('#perm_district_id_dropdown').on('change', function(e){
            e.preventDefault();
            var district_id = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "POST",
                url: "{{route('customer.get_perm_municipality')}}",
                data:{
                    perm_district_id:district_id
                },
                dataType: "json",
                success: function(response){
                    // console.log(response.message);
                    $('#perm_municipality_id_dropdown').html('<option value="" selected disabled>Select District</option>');
                    $.each(response.message, function(key, value){
                        $('#perm_municipality_id_dropdown').append('<option value="'+value.id+'">'+value.name+'</option>')
                    });
                }
            })
        });

        $('#marital_status').on('change', function(){
            var status = $(this).val();
            if(status == 'Married')
            {
                $('.spouse-name').show();
            } else {
                $('.spouse-name').hide();
            }
        });



    });


 </script>

 <script src="{{ asset('js/employee/perm_address.js') }}"></script>
 <script src="{{ asset('js/employee/temp_address.js') }}"></script>
@endsection

