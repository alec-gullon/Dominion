@extends('layouts.app')

@section('content')
<div class="digital-pattern-library">
    <h1 class="__heading heading --large">Digital Pattern Library</h1>
    <p class="__paragraph paragraph">The following page consists of a variety of components needed for the Dominion project that have
    been extracted for potential reuse in different parts of the application.</p>
    <p class="__paragraph paragraph">Where appropriate these elements should be used when appropriate to create a sense
    of UI cohesion throughout the application. Anything that might potentially be reused in other parts of the
    project should be extracted and added here.</p>
    <p class="__paragraph paragraph">Components have no knowledge of the outside world and should rely on their
    parent blocks to orchestrate how they are positioned and placed. In particular, this means that no component is
        allowed to specify any of the following:
    </p>
    <ul class="__list list">
        <li class="__item">
            <strong>Margin</strong>: all components should have a margin of 0
        </li>
        <li class="__item">
            <strong>Width</strong>: all components should default to fill the width of their containing element according to their
            block definition
        </li>
        <li class="__item">
            <strong>Padding</strong>: unless this spacing is contextualised through a nontrivial border;
        </li>
        <li class="__item">
            <strong>Position</strong>: all components should default to a relative position.
        </li>
    </ul>
    <p class="__paragraph paragraph">These rules apply to all elements, even the lowest level elements, e.g., single tag
    elements such as paragraphs and headings.</p>

    <h2 class="__section heading --medium">Headings</h2>

    <h1 class="__heading-example heading --large">Large Heading</h1>

    <h2 class="__heading-example heading --medium">Medium Heading</h2>

    <h3 class="__heading-example heading">Standard Heading</h3>

    <h2 class="__section heading --medium">Buttons</h2>

    <div class="__button-example-group">
        <button class="__button-example button">
            Button
        </button>

        <button class="__button-example button" disabled>
            Button
        </button>

        <button class="__button-example button --loading">
            Button
        </button>
    </div>

    <h2 class="__section heading --medium">Game Board</h2>

    <h3 class="__sub-section heading">Game Buttons</h3>

    <div class="__example-group">
        <div class="__button-example game-button">
            Game Button
        </div>
        <div class="__button-example game-button --treasure">
            Game Button
        </div>
        <div class="__button-example game-button --victory">
            Game Button
        </div>
        <div class="__button-example game-button --curse">
            Game Button
        </div>
        <div class="__button-example game-button --loading">
            Game Button
        </div>
        <div class="__button-example game-button --highlighted">
            Game Button
        </div>
    </div>

    <h3 class="__sub-section heading">Common Card UI Element</h3>

    <div class="common-cards-wrapper">

        <div class="common-card --victory">
            <div class="__letter">
                P
            </div>
            <div class="__amount">
                8
            </div>
        </div>

        <div class="common-card --treasure">
            <div class="__letter">
                G
            </div>
            <div class="__amount">
                10
            </div>
        </div>

        <div class="common-card --curse">
            <div class="__letter">
                C
            </div>
            <div class="__amount">
                10
            </div>
        </div>

        <div class="common-card --victory --highlighted">
            <div class="__letter">
                P
            </div>
            <div class="__amount">
                8
            </div>
        </div>

        <div class="common-card --victory --loading">
            <div class="__letter">
                P
            </div>
            <div class="__amount">
                8
            </div>
        </div>

    </div>

</div>
@endsection