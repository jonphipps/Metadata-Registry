The way the tests are setup to run (as of June 7, 2016):

### Acceptance ###
Uses webdriver.
You need to start a WebDriver interface.
Both of the test methods need to run from the host mac, not Homestead.
PhantomJS is only about 20% faster than Firefox.
The tests are currently setup for Firefox

#### PhantomJs ####
phantomjs --webdriver=4444

#### Firefox ####
java -jar ~/Code/selenium-server-standalone-2.53.0.jar

### Functional ###
The tests are currently setup to use the 'dev environment' database in Symfony and the 'swregistry' database in the module DSN. Since the database isn't reset for tests, I'm not sure this makes any difference at the moment.
A method of generating the database to match both the dev and production databases and seeding with data will have to be initiated.

The following need to be updated and verified:
=============

Import
ImportUpdate
Model
Unit
