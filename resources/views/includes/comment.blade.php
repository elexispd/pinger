


<div class="d-flex align-items-start" style="margin-left:15px;">
    <img style="width:35px" class="me-2 avatar-sm rounded-circle"
        src="https://api.dicebear.com/6.x/fun-emoji/svg?seed=Luigi"
        alt="Luigi Avatar">
    <div class="w-100">
        <div class="d-flex justify-content-between">
            <h6 class="">{{ $comment->user->username }}
            </h6>

            <small class="fs-6 fw-light text-muted"> {{ $comment->created_at->diffForHumans() }} </small>
        </div>
        <p class="fs-6 mt-3 fw-light">
            {{ $comment->comment }}
        </p>
        <div class="d-flex justify-content-end">
            <div>
                <a href="#" class="fw-light text-decoration-none fs-6">
                    <span class="fas fa-heart"></span> 100
                </a>
                <a href="#" class="fw-light text-decoration-none me-1 fs-6">
                    <span class="fas fa-thumbs-down"></span> 20
                </a>
            </div>
        </div>
    </div>
</div>
