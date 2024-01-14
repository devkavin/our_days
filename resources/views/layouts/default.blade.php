<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.head')
</head>

<body>
    @include('includes.loader')
    @include('includes.navbar')
    {{-- @include('includes.navigation') --}}
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                {{-- <div class="col-md-12 col-lg-3 col-xl-2 p-0">
                @include('includes.sidebar')
            </div> --}}
                <div class="col-md-12">
                    <main class="main-content">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $(".nav-menu").click(function() {
                $(".sidebar").toggleClass("active");
            });
            $(".sidebar-close").click(function() {
                $(".sidebar").toggleClass("active");
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    @yield('scripts')

</body>

</html>
