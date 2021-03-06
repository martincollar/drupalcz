# Drupal.cz community website

Chat: [![Gitter](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/Drupalcz/drupalcz?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

## Build status

Branch | Build status
------------ | -------------
[Master](https://github.com/Drupalcz/drupalcz/tree/master) | [![Build Status](https://travis-ci.org/Drupalcz/drupalcz.svg?branch=master)](https://travis-ci.org/Drupalcz/drupalcz)
[Develop](https://github.com/Drupalcz/drupalcz/tree/develop) | [![Build Status](https://travis-ci.org/Drupalcz/drupalcz.svg?branch=develop)](https://travis-ci.org/Drupalcz/drupalcz)

## Contents
* acquia-utils/ - Acquia cloud specific tools.
* docroot/ - Website directory.
* library/ - Acquia cloud libraries.
* tests/ - Collection of tests for Travis CI and local development.
* .gitignore - Gitignore.
* .travis.yml - Travis CI test suite configuration.
* scrub.sql - script to strip sensitive data from D6 production database.
* slim.sql - script to make scrubbed database smaller so we can run tests quicker. 

## Requirements
* Install composer: https://getcomposer.org/doc/00-intro.md
* Install Drush version 8: http://docs.drush.org/en/master/install/

## Getting the site up and running.
* Get your copy of the code:
  * Fork this repository. ( https://help.github.com/articles/fork-a-repo/ )
  * Clone your repository.
  * `git clone git@github.com:[YOUR-NAME]/drupalcz.git drupalcz`
  * `cd drupalcz`
* Prepare your database and fill the credentials into your new local config.
  * `cp docroot/settings/default.settings.local.php docroot/settings/settings.local.php`
  * edit this config: `docroot/settings/settings.local.php`
* Install the site (it will use the Drupal.cz distribution).
  * `cd docroot`
  * `drush si`
* Migrate data from D6 Drupal.cz
  * Get the database snapshot: https://github.com/Drupalcz/drupalcz_db
  * Import it into new database separarate from D8 version.
  * Run the migration: `console migrate:execute --db-host="127.0.0.1" --db-name="DBNAME" --db-user="USERNAME" --db-port=PORT --db-type="mysql" --db-pass="PASSWORD" all -n`

## Contributing
* We are using GitFlow(https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow/) branching strategy
  * you need to create ```feature/NAME``` branch for each issue
  * after you finish work on issue, create pull request against ```develop``` branch 
* Commit your changes. ( http://chris.beams.io/posts/git-commit/ )
* Create pull request. https://help.github.com/articles/creating-a-pull-request/
