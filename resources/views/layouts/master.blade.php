


@include('layouts.header')
    {{-- Navbar goes here --}}
    @include('includes.nav')

    <div class="container py-4">
        <div class=" position-relative" style="display: flex; justify-content: center;">

            {{-- Sidebar Menu Goes here --}}
            @include('includes.sidebar-menu')


            {{-- content goes here --}}
            {{-- @yield('content') --}}
            @yield('content')

            {{-- Side bar Goes here --}}
            @php
                $limit = 5;
            @endphp
            @include('includes.sidebar', ['limit' => $limit])


        </div>
    </div>

@include('layouts.footer')


