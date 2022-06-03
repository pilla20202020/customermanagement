@extends('layouts.admin.admin')

@section('title', 'Edit Staff')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('checkin.update', $checkin->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @include('checkin.form', ['header' => 'Edit checkin <span class="text-primary">('.($checkin->checked_in).')</span>'])

            </form>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    $(document).ready(function(){

        $('#room_type').on('change', function(e){
            e.preventDefault();
            var room_id = $(this).val();
            $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            $.ajax({
                type: "POST",
                url: "{{route('checkin.get_room_price')}}",
                data:{
                    room_id:room_id
                },
                dataType: "json",
                success: function(response){
                    $('.roomprice').val(response.message.price)
                }
            })
        });
    });


</script>
@endsection

