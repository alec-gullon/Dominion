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
    window.dominion.gameHash = '{{ $gameId }}';
</script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
<script src="/js/join.js"></script>
</body>