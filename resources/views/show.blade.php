@extends('layouts.master')

@section('content')

<div class="col-6">

    {{-- alert goes here --}}


    <div class="mt-3">
       <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                        src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Mario" alt="Mario Avatar">
                    <div>
                        <h5 class="card-title mb-0"><a href="#" class="text-capitalize"> {{ $idea->user->username }}
                            </a></h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="fs-6 fw-light text-muted">
                <a href=""style="text-decoration:none;" >{{ $idea->content }}</a>
            </p>
            <div class="row">
                <div class=" col-md-6 d-flex">
                    <div class="mr-3">
                        <a style="text-decoration: none;" class="fw-light nav-link fs-6">
                            <span class="fas fa-heart like @if ($idea->likes->contains('user_id', Auth::id())) text-danger @endif"
                                  onclick="like(event)" data-url="{{ route('like') }}" data-value='{{ $idea->id }}'>
                            </span> <span class="like-counter">{{ $idea->likes_count }}</span>
                        </a>
                    </div>

                    <div class="px-2"> <!-- Added div container -->
                        <a href="{{ route('show_comment', $idea->id) }}" style="text-decoration: none;" class="fw-light nav-link fs-6">
                            <span class="fas fa-comment text-dark"></span>
                            <span class="comment-counter">{{ $idea->comments_count }}</span>
                        </a>
                    </div>

                </div>
                <div class="col-md-6 text-end">
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                    {{ $idea->created_at->diffForHumans() }} </span>
                </div>
            </div>

        </div>
    </div>
    <hr>
    <div>
        <form id="commentForm">
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

    @foreach ($idea->comments as $comment)
        @include('includes.comment')
    @endforeach



    </div>


</div>




<script src="js/main.js"></script>






@endsection
