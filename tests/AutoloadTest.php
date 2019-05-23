<?php
/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2019, Vipin Yadav <vipin.yadav@webtiara.com>
 * @license     MIT, https://www.webtiara.com/license
 */

require_once 'vendor/autoload.php';
require_once __DIR__.'/../flight/autoload.php';

class AutoloadTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \flight\Engine
     */
    private $app;

    function setUp() {
        $this->app = new \flight\Engine();
        $this->app->path(__DIR__.'/classes');
    }

    // Autoload a class
    function testAutoload(){
        $this->app->register('user', 'User');

        $loaders = spl_autoload_functions();

        $user = $this->app->user();

        $this->assertTrue(sizeof($loaders) > 0);
        $this->assertTrue(is_object($user));
        $this->assertEquals('User', get_class($user));
    }

    // Check autoload failure
    function testMissingClass(){
        $test = null;
        $this->app->register('test', 'NonExistentClass');

        if (class_exists('NonExistentClass')) {
            $test = $this->app->test();
        }

        $this->assertEquals(null, $test);
    }
}
