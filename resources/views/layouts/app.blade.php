@include('partials.head')
@include('partials.nav')
<main class="py-4">
    @yield('content')
</main>
@yield('aditionalJS')
@include('partials.footer')