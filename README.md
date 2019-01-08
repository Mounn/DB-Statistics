# DB-Statistics
Statistic Gaming live version DB

### Contents

- [Technology stack](#technology-stack)
- [Installation](#installation)
- [Release](#release)
- [Documentation](#documentation)
- [License](#mit-license)

## Technology stack

- PHP
- MySQL  5.7
- React + jQuery
- Node.js 7.8 (for compiling JavaScript assets)
- "what you see is what you get" Editor [Mercury](http://jejacks0n.github.io/mercury/)
- Deploy: Custom Script (not using Mina or Cap3)
- Server: Heroku
- Image hosting: Amazon S3
- Background job: [delayed_job](https://github.com/collectiveidea/delayed_job)
## Installation

### Requirements

Before you get started, the following needs to be installed:
  * PHP
  * [**Git**](http://help.github.com/git-installation-redirect)
  * **A database**. Only MySQL 5.7 has been tested, so we give no guarantees that other databases (e.g. PostgreSQL) work. You can install MySQL Community Server two ways:
    1. If you are on a Mac, use homebrew: `brew install mysql` (*highly* recommended). Also consider installing the [MySQL Preference Pane](https://dev.mysql.com/doc/refman/5.1/en/osx-installation-prefpane.html) to control MySQL startup and shutdown. It is packaged with the MySQL downloadable installer, but can be easily installed as a stand-alone.
    2. Download a [MySQL installer from here](http://dev.mysql.com/downloads/mysql/)
  * [**Sphinx**](http://pat.github.com/ts/en/installing_sphinx.html). Version 2.1.4 has been used successfully, but newer versions should work as well. Make sure to enable MySQL support. If you're using OS X and have Homebrew installed, install it with `brew install sphinx --with-mysql`
  * [**Imagemagick**](http://www.imagemagick.org). If you're using OS X and have Homebrew installed, install it with `brew install imagemagick`

### Setting up the development environment

1.  Get the code. Clone this git repository and check out the latest release:

    ```bash
    git clone git://github.com/sharetribe/sharetribe.git
    cd sharetribe
    git checkout latest
    ```

1.  Install the required gems by running the following command in the project root directory:

    ```bash
    bundle install
    ```

    **Note:** [`libv8` might fail to build with Clang 7.3](https://github.com/cowboyd/libv8/pull/207), in that case you can try installing V8 manually:

    ```bash
    brew tap homebrew/versions
    brew install v8-315

    gem install libv8 -v '3.16.14.13' -- --with-system-v8
    gem install therubyracer -- --with-v8-dir=/usr/local/opt/v8-315

    bundle install
    ```

1.  Install node modules:

    ```bash
    npm install
    ```

1.  Create a `database.yml` file by copying the example database configuration:

    ```bash
    cp config/database.example.yml config/database.yml
    ```

1.  Add your database configuration details to `config/database.yml`. You will probably only need to fill in the password for the database(s).

1.  Create a `config.yml` file by copying the example configuration file:

    ```bash
    cp config/config.example.yml config/config.yml
    ```

1.  Create and initialize the database:

    ```bash
    bundle exec rake db:create db:structure:load
    ```

1.  Run Sphinx index:

    ```bash
    bundle exec rake ts:index
    ```

    **Note:** If your MySQL server is configured for SSL, update the `config/thinking_sphinx.yml` file and uncomment the `mysql_ssl_ca` lines. Configure correct SSL certificate chain for connection to your database over SSL.

1.  Start the Sphinx daemon:

    ```bash
    bundle exec rake ts:start
    ```

1.  Start the development server:

    ```bash
    foreman start -f Procfile.static
    ```

1.  Invoke the delayed job worker in a new console (open the project root folder):

    ```bash
    bundle exec rake jobs:work
    ```


Congratulations! Sharetribe should now be up and running for development purposes. Open a browser and go to the server URL (e.g. http://lvh.me:3000). Fill in the form to create a new marketplace and admin user. You should be now able to access your marketplace and modify it from the admin area.



### Running tests

Tests are handled by [RSpec](http://rspec.info/) for unit tests and [Cucumber](https://cucumber.io/) for acceptance tests.

Remember to follow *all* the steps listed in the [Setting up the development environment](#setting-up-the-development-environment) paragraph before running tests because some tests depend on webpack assets.

1.  Navigate to the root directory of the sharetribe project

1.  Initialize your test database:

    ```bash
    bundle exec rake test:prepare
    ```

    This needs to be rerun whenever you make changes to your database schema.

1.  If Zeus isn't running, start it:

    ```bash
    zeus start
    ```

1.  To run unit tests, open another terminal and run:

    ```bash
    zeus rspec spec
    ```

1.  To run acceptance tests, open another terminal and run:

    ```bash
    zeus cucumber
    ```

    Note that running acceptance tests is slow and may take a long time to complete.

To automatically run unit tests when code is changed, start [Guard](https://github.com/guard/guard):

  ```bash
  bundle exec guard
  ```


### Advanced settings

Default configuration settings are stored in `config/config.default.yml`. If you need to change these, use the `config/config.yml` file to override the defaults. You can also set configuration values to environment variables.

React components can be created using hot module replacement HMR technique in Styleguide (http://localhost:9001/) path in local development environment. Webpack is used to bundle React components for deployments and hot loading. Related webpack configs can be found from folder sharetribe/client/

### Unofficial installation instructions

Use these instructions to set up and deploy Sharetribe for production in different environments. They have been put together by the developer community, and are not officially maintained by the Sharetribe core team. The instructions might be somewhat out of date.

If you have installation instructions that you would like to share, don't hesitate to share them at the [Sharetribe community forum](https://www.sharetribe.com/community).

- [Deploying Sharetribe to Heroku](https://gist.github.com/svallory/d08e9baa88e18d691605) by [svallory](https://github.com/svallory)



## Changes

See [CHANGELOG.md](CHANGELOG.md) for detailed list of changes between releases.


## Release

See [RELEASE.md](RELEASE.md) for information about how to make a new release.


## Documentation

More detailed technical documentation is located in [docs/](docs/)


## MIT License

Sharetribe is open source under the MIT license. See [LICENSE](LICENSE) for details.
