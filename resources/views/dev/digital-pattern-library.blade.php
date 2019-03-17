@extends('layouts.app')

@section('content')
<div class="digital-pattern-library">
    <heading--large>
        My Heading
    </heading--large>

    becomes

    <h1 class="__heading heading --large">Digital Pattern Library</h1>
    <p class="__paragraph paragraph">The following page consists of a variety of components needed for the Dominion project that have
    been extracted for potential reuse in different parts of the application.</p>
    <p class="__paragraph paragraph">Where appropriate these elements should be used to create a sense
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
            <strong>Padding</strong>: unless this spacing is contextualised through a nontrivial border
        </li>
        <li class="__item">
            <strong>Position</strong>: all components should default to a relative position.
        </li>
    </ul>
    <p class="__paragraph paragraph">These rules apply to all elements, even the lowest level elements, e.g., single tag
    elements such as paragraphs and headings.</p>

    <h2 class="__section heading --medium">Headings</h2>

    <h1 class="__example-full-width heading --large">Large Heading</h1>

    <h2 class="__example-full-width heading --medium">Medium Heading</h2>

    <h3 class="__example-full-width heading">Standard Heading</h3>

    <h2 class="__section heading --medium">Buttons</h2>

    <div class="__example-group">
        <button class="__example-small button">
            Button
        </button>

        <button class="__example-small button" disabled>
            Button
        </button>

        <button class="__example-small button --loading">
            Button
        </button>
    </div>

    <h2 class="__section heading --medium">Inputs</h2>

    <div class="__example-group">
        <input class="__input-example input" type="text" placeholder="Text Input">
    </div>

    <h2 class="__section heading --medium">Loading</h2>

    <div class="__example-group">
        <div class="__example-loader loader">
            <div class="__ripple"></div>
            <div class="__ripple"></div>
        </div>

        <div class="__example-loader loader --large">
            <div class="__ripple"></div>
            <div class="__ripple"></div>
        </div>

        <div class="__example-loader loading-message">
            <div class="__loader loader --large">
                <div class="__ripple"></div>
                <div class="__ripple"></div>
            </div>
            <div class="__text">
                Connecting to Dominion...
            </div>
        </div>
    </div>

    <h2 class="__section heading --medium">Game Board</h2>

    <h3 class="__sub-section heading">Game Buttons</h3>

    <div class="__example-group">
        <div class="__example-small game-button">
            Game Button
        </div>
        <div class="__example-small game-button --treasure">
            Game Button
        </div>
        <div class="__example-small game-button --victory">
            Game Button
        </div>
        <div class="__example-small game-button --curse">
            Game Button
        </div>
        <div class="__example-small game-button --loading">
            Game Button
        </div>
        <div class="__example-small game-button --highlighted">
            Game Button
        </div>
    </div>

    <h3 class="__sub-section heading">Checkbox</h3>

    <div class="__example-group">

        <div class="__example-small button-checkbox">
            <label  class="__label">
                <input  class="__input"
                        type="checkbox"
                />
                <div class="__button game-button">Checkbox</div>
            </label>
        </div>

    </div>

    <h3 class="__sub-section heading">Coin</h3>

    <div class="__example-group">
        <div class="coin">6</div>
    </div>

    <h3 class="__sub-section heading">Description Box</h3>

    <div class="__example-group">

        <div class="__example-description-box description-box">
            <ul class="__standard-effects">
                <li>+1 Action</li>
            </ul>
            <p>Discard as many cards from your hand as you want. Then draw a card for each card you discarded</p>
        </div>

        <div class="__example-description-box description-box">
            <ul class="__standard-effects">
                <li>+1 Action</li>
                <li>+1 Coin</li>
                <li>+1 Buy</li>
                <li>+1 Card</li>
            </ul>
        </div>

    </div>

</div>
@endsection