<?php
/**
 * Flight: An extensible micro-framework.
 *
 * @copyright   Copyright (c) 2019, Vipin Yadav <vipin.yadav@webtiara.com>
 * @license     MIT, https://www.webtiara.com/license
 */

require_once 'vendor/autoload.php';
require_once __DIR__.'/../flight/Flight.php';

class RenderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \flight\Engine
     */
    private $app;

    function setUp() {
        $this->app = new \flight\Engine();
        $this->app->set('flight.views.path', __DIR__.'/views');
    }

    // Render a view
    function testRenderView(){
        $this->app->render('hello', array('name' => 'Bob'));

        $this->expectOutputString('Hello, Bob!');
    }

    // Renders a view into a layout
    function testRenderLayout(){
        $this->app->render('hello', array('name' => 'Bob'), 'content');
        $this->app->render('layouts/layout');

        $this->expectOutputString('<html>Hello, Bob!</html>');
    }
}
