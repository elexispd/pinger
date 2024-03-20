@extends('layouts.master')


<style>
    .badge {
    display: inline-block;
    padding: 0.25em 0.4em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 10rem;
    background-color: white;
    color: white;
}
</style>

@section('content')

<div class="col-6">

    {{-- alert goes here --}}


    <h4>Profile </h4>

    @include('includes.alert')

    <hr>
    <div class="mt-3">
        <div class="profile-details d-flex justify-content-between">
            <div>
                <div class="img img-responsive">
                   <img src="https://xsgames.co/randomusers/avatar.php?g=male" alt="" srcset="">
                </div>
                <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                <p><strong>Username:</strong> {{ $user->username }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <strong class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">
                            Following
                            <span class="badge bg-primary rounded-circle bg-white text-dark">{{ $following->count() }}</span>
                        </strong>
                    </li>
                    <li class="nav-item" role="presentation">
                    <strong class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">
                        Following
                        <span class="badge bg-primary rounded-circle bg-white text-dark"> {{ $followers->count()  }}</span>
                    </strong>

                    </li>

                </ul>
                <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    @foreach ($following as $follow)
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                src="https://xsgames.co/randomusers/avatar.php?g=male" alt="Mario Avatar">
                            <div>
                                <h5 class="card-title mb-0">
                                    <a href="{{ route('timeline', [$follow->username]) }}" class="text-capitalize"> {{ $follow->first_name }} {{ $follow->last_name }}
                                    </a>
                                </h5>
                                <p>{{ $follow->username }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    @foreach ($followers as $follow)
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                                src="https://xsgames.co/randomusers/avatar.php?g=male" alt="Mario Avatar">
                            <div>
                                <h5 class="card-title mb-0">
                                    <a href="{{ route('timeline', [$follow->username]) }}" class="text-capitalize"> {{ $follow->first_name }} {{ $follow->last_name }}
                                    </a>
                                </h5>
                                <p>{{ $follow->username }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>

            @can('follow', App\Models\Follow::class)
                <div>
                    <form action="{{ route('follow.redirect') }}" method="post">
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary">Follow <i class="fa fa-plus"></i></button>
                    </form>
                </div>
            @else
            <div>
                @if ($user->username != Auth::user()->username)
                    <form action="{{ route('unfollow') }}" method="post">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="followed_id" value="{{ $user->id }}">
                        <button class="btn btn-primary" name="unfollow" > Unfollow <i class="fa fa-check"></i></button>
                    </form>
                @endif

            </div>

            @endcan



        </div>



    </div>


</div>




<script src="js/main.js"></script>






@endsection
