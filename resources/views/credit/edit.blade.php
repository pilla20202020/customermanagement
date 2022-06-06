@extends('layouts.admin.admin')

@section('page-specific-styles')
    <link href="{{ asset('css/dropify.min.css') }}" rel="stylesheet">
    <link href="{{ asset('resources/css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection


@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('credit.update',$credit->id)}}"
                  method="POST" enctype="multipart/form-data" novalidate>
            @method('PUT')
            @include('credit.form', ['header' => 'Edit Credit'])
            </form>
        </div>
    </section>

@endsection
