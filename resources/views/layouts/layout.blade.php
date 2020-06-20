@include("layouts.partials.head")

<body>
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
