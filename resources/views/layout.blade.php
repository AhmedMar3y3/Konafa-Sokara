<!DOCTYPE html>
<html lang="en">
    @include('partials.head')
    <body>
        <div class="container-scroller">
            @include('partials.sidebar')
            <div class="container-fluid page-body-wrapper">
                @include('partials.navbar')
                <div class="main-panel">
                    <div class="content-wrapper">
                        <main id="main" class="main">
                            @yield('main')
                        </main>
                    </div>
                    @include('partials.footer')
                </div>
            </div>
        </div>
        @include('partials.scripts')
    </body>
</html>