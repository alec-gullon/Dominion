<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dominion</title>
    <link rel="stylesheet" href="/css/app.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
</head>

<body>
<div id="root" class="home-root">
    Connecting to Dominion...
</div>
<script>
    window.dominion = {};
    window.dominion.route = '{{ Route::currentRouteName() }}';
    window.dominion.messageInProgress = false;
</script>
<script src="/js/app.js"></script>
</body>