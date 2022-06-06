@extends('layouts.admin.admin')

@section('title', 'Add a New Credit')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('credit.store')}}" method="POST" enctype="multipart/form-data">
            @include('credit.form',['header' => 'Add New Credit'])
            </form>
        </div>
    </section>

@endsection
