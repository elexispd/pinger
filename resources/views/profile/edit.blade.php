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
    @error('password')
       <span class="text-danger">{{ $message }}</span>
    @enderror

    <hr>
    <div class="mt-3">
        <div class="profile-details ">

            <form action="{{ route('profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">First Name</label>
                    <input type="text" class="form-control" id="name" name="first_name" value="{{ $user->first_name }}">
                </div>

                @error('first_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="name">Last Name</label>
                    <input type="text" class="form-control" id="name" name="last_name" value="{{ $user->last_name }}">
                </div>
                @error('last_name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="username">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" >
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                </div>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

                <div class="form-group mt-2">
                    <button type="submit" class="btn btn-primary form-control">Update</button>
                </div>


            </form>

            <div>

            </div>

        </div>
        <a class="text-capitalize text-info edit"  data-bs-toggle="modal" data-bs-target="#editModal" > Change Password <i class="fa fa-edit"></i> </a>
        <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="followModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="followModalLabel">Change Password</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('profile.changePassword') }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">

              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>

              <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm-password" name="password_confirmation">
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Change</button>
          </form>
        </div>
      </div>
    </div>
  </div>




    </div>


</div>







@endsection
