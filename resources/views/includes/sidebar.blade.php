<div class="col-3" style="position: fixed; right: 20px; ">
    <div class="card">
        <div class="card-header pb-0 border-0">
            <h5 class="">Search</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('feed') }}" method="get">
                <input placeholder="...
                " class="form-control w-100" type="text"
                    id="search" name="search" >
                <button class="btn btn-dark mt-2"> Search</button>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-header pb-0 border-0">
            <h5 class="">Who to follow</h5>
        </div>
        <div class="card-body">
            @if($usersNotFollowed->isEmpty())
                <p>No users to display.</p>
            @else
            @foreach ($usersNotFollowed as $user)
                <div class="hstack gap-2 mb-3">
                    <div class="avatar">
                        <a href="#!"><img class="avatar-img rounded-circle"
                                src="https://xsgames.co/randomusers/avatar.php?g=male" width="50" alt=""></a>
                    </div>
                    <div class="overflow-hidden">
                        <span class="h6 mb-0">{{ $user->first_name }} {{ $user->last_name }}</span>
                        <p class="mb-0 small text-truncate"><a href="{{ route('timeline', [$user->username]) }}">@ {{ $user->username }}</a></p>
                    </div>
                    <span class="btn btn-primary-soft rounded-circle icon-md ms-auto" data-url="{{ route('follow') }}" data-value="{{ $user->id }}" onclick="follow(this)">
                        <i
                            class="fa-solid fa-plus" > </i></span>
                </div>
            @endforeach
            @endif

            @if ($usersNotFollowed->count() > 4)
                <div class="d-grid mt-3">
                    <a class="btn btn-sm btn-primary-soft" href="#!">Show More</a>

                </div>
            @endif

        </div>
    </div>
</div>


<script></script>
