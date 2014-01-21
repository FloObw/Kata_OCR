#!/usr/bin/php
<?php

require_once dirname(dirname(__FILE__)) . '/library/Bootstrap.php';
$bootstrap = Bootstrap::getInstance();
$bootstrap->registerNamespace('Kata_');
//Put your additional namespace registrations here
//$bootstrap->registerNamespace('Nineteen_');
//$bootstrap->registerNamespace('Eighty_');
//$bootstrap->registerNamespace('Four_');
Kata_Runner::main($argv);

