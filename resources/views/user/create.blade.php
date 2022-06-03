@extends('layouts.admin.admin')

@section('title', 'Create a user')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('user.store')}}" method="POST" enctype="multipart/form-data" novalidate>
            @include('user.form',['header' => 'Create a user'])
            </form>
        </div>
    </section>
@endsection

