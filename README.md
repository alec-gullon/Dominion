# Dominion
A PHP and websockets implementation of the first Dominion expansion. Built using Laravel for the back-end and jQuery for the front-end.

This is a Laravel project, so the process to view it in action is pretty simple:

- run `composer install` and `npm install` at the application route to install the project dependencies;
- create an empty file at `database/database.sqlite` and run `php artisan migrate` to run the database migrations;
- you can now spin up a local server and start playing the game.

Alternatively, you can always just play the game at my <a href="http://dominion.alecgullon.co.uk">hosted version</a>.

The original aims of the project were to figure out a way to enable two-player games to be hosted through the application via websockets. After this was completed, I moved onto creating and designing an artificial intelligence that could be played against. Both of these proved to be very satisfying problems to figure out solutions to.

The project is not intended to be interacted with on phones, tablets and other such devices, as this falls out of scope. It has a "back-end" heavy focus, with an emphasis on implementing some particularly non-trivial business logic. It is by no means my prettiest piece of work, but it is by far my favourite side project that I have ever completed.
