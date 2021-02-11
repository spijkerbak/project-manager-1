<?php

abstract class Controller {

    abstract function run();

    function __construct() {
        header('Content-type: text/plain'); // make sql-errors readable
        $next = $this->run();
        if (!SqlProvider::$debug) {
            header('location: ?' . $next);
        }
        exit;
    }

}
