<?php

function __autoload($class) {
    require $class . '.php';
}
require "config.php";

// Try to create cache class or exit with error
try {
    $cache = new Cache(__DIR__ . '/cache');
} catch (Exception $e) {
    exit($e->getMessage());
}

// Try to set cache dir or exit with error
try {
    $cache->setDir(__DIR__ . '/cache');
} catch (Exception $e) {
    exit($e->getMessage());
}

// Try to put and get object from cache or exit with error
try {
    $object = mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    $cache->put('object', $object);
    print_r($cache->get('object'));
} catch (Exception $e) {
    exit($e->getMessage());
}

// Try to put and get array from cache or exit with error
try {
    $array = ['First', 'Second'];
    $cache->put('array', $array);
    print_r($cache->get('array'));
} catch (Exception $e) {
    exit($e->getMessage());
}

// Try to put and get string from cache or exit with error
try {
    $similar = 'Some string';
    $cache->put('similar', $similar);
    print_r($cache->get('similar'));
} catch (Exception $e) {
    exit($e->getMessage());
}