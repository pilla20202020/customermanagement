@extends('layouts.admin.admin')

@section('title', 'Add a New CheckIn')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('checkin.store')}}" method="POST" enctype="multipart/form-data">
            @include('checkin.form',['header' => 'Add new CheckIn'])
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
