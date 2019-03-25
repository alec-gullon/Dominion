@extends('layouts.app')

@section('content')

    <div id="root" class="home-root">
        <div class="root-loader">
            <div class="loading-message">
                <div class="__loader loader --large">
                    <div class="__ripple"></div>
                    <div class="__ripple"></div>
                </div>
                <div class="__text">
                    Connecting to Dominion...
                </div>
            </div>
        </div>
    </div>

    <script>
        window.dominion = {};
        window.dominion.route = '{{ Route::currentRouteName() }}';
        window.dominion.gameHash = '<?= $guid ?>';
        window.baseUrl = '<?= env('APP_URL') ?>';
    </script>
    <script src="/js/app.js"></script>

@endsection