<div class="col-3" style="position: fixed; left:20px;">
    <div class="card overflow-hidden">
        <div class="card-body pt-3">
            <ul class="nav nav-link-secondary flex-column fw-bold gap-2">
                <li class="nav-item" >
                    <a class="nav-link  @if (Route::current()->uri() === '/' || Route::current()->uri() === 'feed')
                        bg-primary text-light
                        @endif >" href="{{ route('feed') }}">
                        <span>Feed</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if (Route::current()->uri() === 'explore')
                        bg-primary text-light
                        @endif" href="{{ route('explore') }}">
                        <span>Explore</span></a>
                </li>



            </ul>
        </div>
        <div class="card-footer text-center py-2 @if (Str::contains(Route::current()->uri, 'profile') ) bg-primary text-light @endif">
            <a class="btn btn-link btn-sm @if (Str::contains(Route::current()->uri, 'profile') ) text-light @endif" href="{{ route('profile.edit', auth()->user()->username) }}"> Settings </a>
        </div>
    </div>
</div>
