@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection


@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('room.update',$roomtype->id)}}"
                  method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('roomtype.form', ['header' => 'Edit user <span class="text-primary">('.($roomtype->title).')</span>'])
            </form>
        </div>
    </section>

@endsection
