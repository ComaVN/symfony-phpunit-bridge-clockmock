# Test project for an issue I have with mocking time in symfony 2.8

I did a clean install of new project, using composer:

    composer create-project symfony/framework-standard-edition symfony-phpunit-bridge-clockmock "2.8.*"

Then I added 2 unittests in the `DefaultControllerTest`: one which explicitly enables the ClockMock, and one with the `@group time-sensitive` annotation:

    $ phpunit -c app/ --filter explicit
    PHPUnit 5.1.3 by Sebastian Bergmann and contributors.
    .                                                                   1 / 1 (100%)
    Time: 24 ms, Memory: 4.00Mb
    OK (1 test, 1 assertion)

So, the explicit test works: it does a `sleep(5)`, but finishes in 24ms.

However:

    $ phpunit -c app/ --filter annotation
    PHPUnit 5.1.3 by Sebastian Bergmann and contributors.
    .                                                                   1 / 1 (100%)
    Time: 5.02 seconds, Memory: 4.00Mb
    OK (1 test, 1 assertion)

So, the test using the `@group` annotation actually takes 5 seconds, meaning the ClockMock didn't work.

There's nothing wrong with the `@group` annotation itself:

    $ phpunit -c app/ --group time-sensitive
    PHPUnit 5.1.3 by Sebastian Bergmann and contributors.
    .                                                                   1 / 1 (100%)
    Time: 5.02 seconds, Memory: 4.00Mb
    OK (1 test, 1 assertion)
