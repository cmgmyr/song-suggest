# Song Suggestion Manager for Bands
For cover bands, managing new songs to potentially learn can be a burden. Too many lists, emails, text messages...who can remember what we talked about 2 months ago? What did we say we were going to learn next??? This is where Song Suggest comes in.

## Features

* Simple, responsive design using the Bootstrap framework
* Add unlimited band members
* User functions - log in, log out, reset password, update account, turn on/off email notification options, upload profile image or default to Gravatar
* Suggest unlimited songs
* Optional linking to a YouTube video and/or upload MP3 file
* Detailed layout of songs broken down by category (Pending, Approved, Denied, Learning, Learned, Archived), then ordered by positive votes and number of comments so it's easier to pick the next song to learn
* Song details page which includes: artist, title, youtube embedded video, voting capabilities, vote totals, notification options, download MP3 option, comment form, activity feed, and for admin users there is also: update category, reset votes, and delete song
* Users who opt in to email notifications get them for: new song suggestions, new/changed votes, when songs are moved into a different category, when a song is edited, or a new comment is made

## Technologies Used

* Laravel
* Bootstrap
* jQuery
* Bower
* Grunt
* Codeception
* Mandrill (emails)
* IronIO (queue processing)

## 1. Configuration
Create a .env.local.php file that looks similar to:

    <?php

    return array(
        // database.php
        'DB_HOST' => 'localhost',
        'DB_NAME' => 'songsuggest',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',

		// mail.php
        'MAIL_FROM_EMAIL' => 'noreply@example.com',
        'MAIL_FROM_NAME' => 'Song Suggest',
        'MANDRILL_SECRET' => 'mandrill-secret-key',

		// queue.php
        'IRON_TOKEN' => 'iron-token',
        'IRON_PROJECT' => 'iron-project',
        'IRON_QUEUE_NAME' => 'song-suggest'
    );

Update any other configurations in `app/config/app.php` that you need to.

## 2. Update namespace
Search for `Ss` and replace with desired namespace for your app. Remember to also include the `composer.json` file.

## 3. Installation
1. Run: `composer install`
2. Run: `php artisan key:generate`
3. Run: `php artisan migrate --seed`

## 4. Optional Installation
1. Install node - http://nodejs.org
2. Install Grunt globally: `npm install -g grunt-cli`
3. Install Bower globally: `npm install -g bower`
4. Install other npm packages: `npm install`
5. Install Bower packages: `bower install`
6. Make any configuration changes to Gruntfile.js
7. Set up the initial css/js files, run: `grunt init`
8. To watch for file changes and perform actions (less, min, phpunit, etc), run: `grunt watch`

## 5. Testing
1. Create `tests/codeception/_data/db.sqlite`
2. Create `tests/codeception/_data/dump.sql`
3. Run command: `art migrate --seed --env=testing`
4. Run command: `sqlite3 tests/codeception/_data/db.sqlite .dump > tests/codeception/_data/dump.sql`

__Note:__ You'll need to run #3 and #4 each time you make migration or seed changes

Codeception is used for testing this application, so in the root of the project run the command: `vendor/bin/codecept run`

For functional test suite, run: `vendor/bin/codecept run functional`

For integration test suite, run: `vendor/bin/codecept run integration`

...more coming soon!