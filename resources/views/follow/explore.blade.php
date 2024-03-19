@extends('layouts.master')

@section('content')

<div class="col-6">



    @include('includes.alert')

    <hr>
    <div class="mt-3">
       @foreach ($usersNotFollowed as $user)
       <div class="card my-2">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle"
                        src="https://xsgames.co/randomusers/avatar.php?g=male" alt="Mario Avatar">
                    <div>
                        <h5 class="card-title mb-0">
                             {{ $user->first_name }} {{ $user->last_name }}
                        </h5>
                       <a href="#" <span> @ {{ $user->username }}</span></a>
                    </div>
                </div>
                <div>
                    <form action="{{ route('follow.redirect') }}" method="post">
                        @csrf
                        <input type="hidden" name="follow" value="{{ $user->id }}">
                        <button type="submit" class="btn btn-primary-soft rounded-circle icon-md ms-auto">
                           Follow <i class="fas fa-share-square"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>



    </div>

       @endforeach

    </div>


</div>




<script src="js/main.js"></script>






@endsection
