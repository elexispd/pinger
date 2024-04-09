@include('layouts.header')

@include('includes.nav')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6">

                <form class="form mt-5" action="{{ route('password.email') }}" method="post">
                    @csrf
                    @if (session()->has('status'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('status') }}
                        </div>
                    @endif
                    <h3 class="text-center text-dark">Forgot Password</h3>
                    <div class="form-group">
                        <label for="email" class="text-dark">Email:</label><br>
                        <input type="text" name="email" id="email" value="{{ old('email') }}" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="remember-me" class="text-dark"></label><br>
                        <input type="submit" name="submit" class="btn btn-dark btn-md" value="Email password reset link">
                    </div>

                </form>
            </div>
        </div>
    </div>


