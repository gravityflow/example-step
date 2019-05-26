Example Workflow Step
=====================

[![CircleCI](https://circleci.com/gh/gravityflow/example-step/tree/master.svg?style=svg&circle-token=4c044ef774d2e4dcc10ea847700defbb66479df7)](https://circleci.com/gh/gravityflow/example-step/tree/master)

The repository demonstrates how to write a simple custom workflow step plus automated browser testing using Codeception & WP-Browser.

`step.php` contains the custom workflow step as a plugin.

The `tests/acceptance` folder contains an example of an acceptance test.

### Acceptance Tests

#### Requirements

- Docker Desktop. Note: It may be necessary to increase the RAM to 4GB.
- A Gravity Forms license key

#### Instructions

Copy `.env.sample` to `.env` and enter your Gravity Forms license key.

Run bash `start.sh` from the tests folder to start the tests. 

Docker compose will create containers for the following services:

- Codeception + WP-Browser
- WordPress
- MariaDB
- Selenium + Chromedriver

When the tests start the latest versions of Gravity Forms and Gravity Flow will be installed and activated.

You can watch Chrome perform the tests via VNC on localhost:5900. On a Mac open vnc://localhost:5900 in Safari. Password: secret.

An HTML report will be generated in the tests/_output folder.
