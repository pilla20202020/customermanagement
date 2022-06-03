@extends('layouts.admin.admin')

@section('title', 'Add a New Room Type')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('room.store')}}" method="POST" enctype="multipart/form-data">
            @include('roomtype.form',['header' => 'Add new Room Type'])
            </form>
        </div>
    </section>

@endsection
