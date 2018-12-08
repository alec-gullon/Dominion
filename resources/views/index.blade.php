<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dominion</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
<div id="root">
    Connecting to Dominion...
</div>
<script>
    window.dominion = {};
    window.dominion.route = '{{ Route::currentRouteName() }}';
</script>
<script src="/js/app.js"></script>
</body>