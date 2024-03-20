<div class="card my-3">
    <div class="px-3 pt-4 pb-2">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
                <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                    src="https://xsgames.co/randomusers/avatar.php?g=male" alt="Mario Avatar">
                <div>
                    <h5 class="card-title mb-0">
                        <a href="{{ route('timeline', [$idea->user->username]) }}" class="text-capitalize"> {{ $idea->user->username }}
                        </a>
                    </h5>
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
                        </span> <span class="like-counter">{{ $idea->likes->count() }}</span>
                    </a>
                </div>

                <div class="px-2"> <!-- Added div container -->
                    <a href="{{ route('show_comment', $idea->id) }}" style="text-decoration: none;" class="fw-light nav-link fs-6">
                        <span class="fas fa-comment text-dark"></span>
                        <span class="comment-counter">{{ $idea->comments->count() }}</span>
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


