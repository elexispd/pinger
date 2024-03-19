@extends('layouts.master')

@section('content')

<div class="col-6 position-relative">

    {{-- alert goes here --}}

    @include('includes.alert')

    <div class="mt-3">
       @include('includes.idea-card')
    </div>

    <hr>
    <div>
        <form id="" method="POST" action="{{ route('comment') }}">
            @csrf
            <div class="mb-3">
                <textarea class="fs-6 form-control" name="comment" rows="1"></textarea>
                <input type="hidden" name="idea_id" value="{{ $idea->id }}">

            </div>
            <div class="point">
                <button type="submit" id="submitComment"  class="btn btn-primary btn-sm"> Post Comment </button>
            </div>

        </form>
    </div>
    <hr>
    @if ($idea->comments->count() == 0)
        <div class="text-secondary text-center">
            Be The First To Comment
        </div>
    @else
        @foreach ($idea->comments as $comment)
        @include('includes.comment')
    @endforeach
    @endif




</div>











<script src="{{ asset('js/main.js') }}"></script>
@endsection
