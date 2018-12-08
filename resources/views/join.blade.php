<!doctype html>

<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Dominion</title>
    <link rel="stylesheet" href="/css/app.css">
</head>

<body>
<div id="root" class="join-root">
    Connecting to Dominion.......
</div>
<script>
    window.dominion = {};
    window.dominion.gameHash = '{{ $gameId }}';
    window.dominion.route = 'joinGameIfPossible';
</script>
<script src="/js/app.js"></script>
</body>