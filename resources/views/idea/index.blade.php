@extends('layouts.master')


@section('content')

<div class="col-6">

    {{-- alert goes here --}}

    <h4> Share yours ideas </h4>
    @include('includes.alert')
    @include('includes.idea-input')
    <hr>
    <div class="mt-3">
       @foreach ($ideas as $idea)
          @include('includes.idea-card', ['idea' => $idea])
       @endforeach

    </div>


</div>




<script src="js/main.js"></script>






@endsection
