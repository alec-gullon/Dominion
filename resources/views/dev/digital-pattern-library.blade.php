@extends('layouts.app')

@section('content')
<div class="page digital-pattern-library">
    <h1 class="heading large">Digital Pattern Library</h1>
    <p class="p">The following page consists of a variety of components needed for the Dominion project that have
    been extracted for potential reuse in different parts of the application.</p>
    <p class="p">Where appropriate these elements should be used to create a sense
    of UI cohesion throughout the application. Anything that might potentially be reused in other parts of the
    project should be extracted and added here.</p>
    <p class="p">Components have no knowledge of the outside world and should rely on their
    parent blocks to orchestrate how they are positioned and placed. In particular, this means that no component is
        allowed to specify any of the following:
    </p>
    <ul class="list">
        <li>
            <strong>Margin</strong>: all components should have a margin of 0
        </li>
        <li>
            <strong>Width</strong>: all components should default to fill the width of their containing element according to their
            block definition
        </li>
        <li>
            <strong>Padding</strong>: unless this spacing is contextualised through a nontrivial border
        </li>
        <li>
            <strong>Position</strong>: all components should default to a relative position.
        </li>
    </ul>
    <p class="p">These rules apply to all elements, even the lowest level elements, e.g., single tag
    elements such as paragraphs and headings.</p>

    <h2 class="section heading medium">Headings</h2>

    <div class="example-group vertical">
        <h1 class="heading large">Large Heading</h1>
        <h2 class="heading medium">Medium Heading</h2>
        <h3 class="heading">Standard Heading</h3>
    </div>

    <h2 class="section heading medium">Buttons</h2>

    <div class="example-group">
        <button class="button">
            Button
        </button>
        <button class="button" disabled>
            Button
        </button>
        <button class="button loading">
            Button
        </button>
    </div>

    <h2 class="section heading medium">Inputs</h2>

    <div class="example-group">
        <input class="input" type="text" placeholder="Text Input">
    </div>

    <h2 class="section heading medium">Loading</h2>

    <div class="example-group">
        <div class="loader">
            <div class="ripple"></div>
            <div class="ripple"></div>
        </div>

        <div class="loader large">
            <div class="ripple"></div>
            <div class="ripple"></div>
        </div>

        <div class="loading-message">
            <div class="loader large">
                <div class="ripple"></div>
                <div class="ripple"></div>
            </div>
            <div class="text">
                Connecting to Dominion...
            </div>
        </div>
    </div>

    <h2 class="section heading medium">Game Board</h2>

    <h3 class="sub-section heading">Game Buttons</h3>

    <div class="example-group">
        <div class="game-button">
            Game Button
        </div>
        <div class="game-button treasure">
            Game Button
        </div>
        <div class="game-button victory">
            Game Button
        </div>
        <div class="game-button curse">
            Game Button
        </div>
        <div class="game-button loading">
            Game Button
        </div>
        <div class="game-button highlighted">
            Game Button
        </div>
    </div>

    <h3 class="sub-section heading">Checkbox</h3>

    <div class="example-group">

        <div class="button-checkbox">
            <label  class="label">
                <input  class="bc-input"
                        type="checkbox"
                />
                <div class="bc-button game-button">Checkbox</div>
            </label>
        </div>

    </div>

    <h3 class="sub-section heading">Coin</h3>

    <div class="example-group">
        <div class="coin">6</div>
    </div>

    <h3 class="sub-section heading">Description Box</h3>

    <div class="example-group">

        <div class="description-box">
            <ul class="standard-effects">
                <li>+1 Action</li>
            </ul>
            <p>Discard as many cards from your hand as you want. Then draw a card for each card you discarded</p>
        </div>

        <div class="description-box">
            <ul class="standard-effects">
                <li>+1 Action</li>
                <li>+1 Coin</li>
                <li>+1 Buy</li>
                <li>+1 Card</li>
            </ul>
        </div>

    </div>

    <h3 class="sub-section heading">Score Card</h3>

    <div class="example-group">

        <div class="score-card">
            <div class="heading medium">
                Congratulations, you have won!
            </div>
            <table>
                <tr>
                    <td class="name">Alec</td>
                    <td>26</td>
                </tr>
                <tr>
                    <td class="name">Marvin</td>
                    <td>19</td>
                </tr>
            </table>
        </div>

    </div>

</div>
@endsection