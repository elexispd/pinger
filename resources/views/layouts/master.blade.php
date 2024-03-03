
@include('layouts.header')
    {{-- Navbar goes here --}}
    @include('includes.nav')

    <div class="container py-4">
        <div class="row">

            {{-- Sidebar Menu Goes here --}}
            @include('includes.sidebar-menu')


            {{-- content goes here --}}
            {{-- @yield('content') --}}
            @yield('content')

            {{-- Side bar Goes here --}}
            @include('includes.sidebar')


        </div>
    </div>

@include('layouts.footer')
