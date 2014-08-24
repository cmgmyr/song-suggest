## Laravel song suggestions for bands

* Laravel
* Bootstrap
* jQuery
* Bower
* Grunt

### 1. Configuration
Create a .env.local.php file that looks similar to:

    <?php

    return array(
        // app.php
        'ENABLE_DEBUG' => true,

        // database.php
        'DB_NAME' => 'songsuggest',
        'DB_USERNAME' => 'root',
        'DB_PASSWORD' => 'root',
    );

Update any other configurations in `app/config/app.php` that you need to.

### 2. Update namespace
Search for `Ss` and replace with desired namespace for your app. Remember to also include the `composer.json` file.

### 3. Installation
1. Run: `composer install`
2. Run: `php artisan key:generate`
3. Run: `php artisan migrate --seed`

### 4. Optional Installation
1. Install node - http://nodejs.org
2. Install Grunt globally: `npm install -g grunt-cli`
3. Install Bower globally: `npm install -g bower`
4. Install other npm packages: `npm install`
5. Install Bower packages: `bower install`
6. Make any configuration changes to Gruntfile.js
7. Set up the initial css/js files, run: `grunt init`
8. To watch for file changes and perform actions (less, min, phpunit, etc), run: `grunt watch`

...more coming soon!