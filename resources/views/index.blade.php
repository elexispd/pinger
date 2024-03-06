@extends('layouts.master')

@section('content')

<div class="col-6">

    {{-- alert goes here --}}

    <h4> Share yours ideas </h4>
    @include('includes.alert')
    @include('includes.idea-input')
    <hr>
    <div class="mt-3">
       @include('includes.idea')
    </div>
</div>

@endsection
