


@include('layouts.header')
    {{-- Navbar goes here --}}
    @include('includes.nav')

    <div class="container py-4">
        <div class=" position-relative" style="display: flex; justify-content: center;">

            {{-- Sidebar Menu Goes here --}}
            @include('includes.sidebar-menu')

            <div class="mt-3">
                <h4>User Not Found</h4>
            </div>

            @php
                $limit = 5;
            @endphp
            @include('includes.sidebar', ['limit' => $limit])


        </div>
    </div>

@include('layouts.footer')


