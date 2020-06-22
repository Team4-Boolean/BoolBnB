@include("layouts.partials.head")

<body>
    <script src="https://cdn.jsdelivr.net/npm/places.js@1.19.0"></script>
    <header>
        @include("layouts.partials.header")
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include("layouts.partials.footer")
    </footer>
    @yield('script')
</body>

</html>
