@extends('layouts.master')

@section('content')

<div class="col-6" >

    {{-- alert goes here --}}
    @if ($userByRoute)
    @if ($userByRoute->username !== Auth::user()->username)
        <h4> {{ $userByRoute->first_name }} {{ $userByRoute->last_name }} Timeline </h4>
    @endif

    @endif





    @include('includes.alert')
    @can('create', App\Models\Idea::class)
        <h4> Share yours ideas </h4>
        @include('includes.idea-input')
    @endcan
    <hr>
    <div class="mt-3">

        @foreach ($ideas as $idea)
          @include('includes.idea-card', ['idea' => $idea])
        @endforeach



    </div>


</div>




<script src="js/main.js"></script>






@endsection
