@extends('layouts.app')

@section('content')
    <div class="page">
        <h1 class="heading large">About</h1>
        <p class="p">Dominion is a dynamic, hugely successful, deck-building card game developed and
        released in 2009 by Donald X. Vaccarino. Players take it in turns to play cards from their hand and then
        buy new cards to add to their deck until the player with the most victory points at the end is declared
        the victor. Originally a fairly simple game with relatively straightforward mechanics, the original set has
        spawned thirteen sequel expansions and has developed into a really fun and interesting way to spend 40
        minutes or so with a significant other, with family members or with a group of friends.</p>

        <p class="p">This web application is a custom built implementation of the very first base set of
        Dominion cards. Here you can play the game against a reasonably competent AI and experience what it feels
        like to play the original game for yourself.</p>

        <p class="p">The reality is that you're probably reading this page following my direction to do
        so, probably because I want to demonstrate to you my competence and experience as a full-stack web developer.
        To that end, I have a few important comments on the technical aspects of the project.</p>

        <ul class="list">
            <li>The application is built using the PHP framework, Laravel. All non-vendor code was
            written by myself during my spare time - this includes all HTML, CSS/SASS, JavaScript and PHP.</li>
            <li>The application uses AJAX when it is appropriate to do so. As an example, the process
            involving a user landing on the site, setting their name, starting a new game and playing until completion
            requires precisely <strong>one</strong> page load - that when the user initially visits the site.
            <li>The application is backed up by a full test suite that features both unit tests
            and integration tests. Back-end code for the project was written with a loose adherence to the
            principles of TDD, without being overly dogmatic.</li>
            <li>The back-end functionality for seamless two-player games has been written. This,
            when paired with an intermediary node server, would allow for two-player games that feature no page
            refreshes - without a reliance on dated methods such as long polling. Limitations around
            shared hosting currently prevent this from being deployed. (A desire to explore websockets
            and what they could offer served as the original motivation behind the entire project - it is ironic
            therefore that this has not been deployed, whilst the work that followed it has been!)</li>
        </ul>

        <p class="p">
            You can look through the source code directly on my the projects github repo, which can be found
            <a href="https://github.com/alec-gullon/Dominion">here</a>.
        </p>
    </div>
@endsection
