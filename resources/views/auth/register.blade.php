@include('layouts.header')

@include('includes.nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">
                <form class="form mt-5" action="{{ route('register') }}" method="post">
                    @csrf
                    <h3 class="text-center text-dark">Register</h3>

                    <div class="form-group">
                        <label for="firstname" class="text-dark">First Name:</label><br>
                        <input type="" name="first_name" id="first_name" class="form-control" value="{{ old('first_name') }}" >
                    </div>
                    @error('first_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="lastname" class="text-dark">Last Name:</label><br>
                        <input type="" name="last_name" id="last_name" class="form-control" value="{{ old('last_name') }}" >
                    </div>
                    @error('last_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-group">
                        <label for="username" class="text-dark">Username:</label><br>
                        <input type="" name="username" id="username" class="form-control" value="{{ old('username') }}" >
                    </div>
                    @error('username')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="email" class="text-dark">Email:</label><br>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" >
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group mt-3">
                        <label for="password" class="text-dark">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group mt-3">
                        <label for="confirm-password" class="text-dark">Confirm Password:</label><br>
                        <input type="password" name="password_confirmation" id="confirm-password" class="form-control">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <div class="form-group">
                        <label for="remember-me" class="text-dark"></label><br>
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="submit">
                    </div>
                    <div class="text-right mt-2">
                        <a href="/login" class="text-dark">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @include('layouts.footer')
