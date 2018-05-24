<?php

use PHPUnit\Framework\TestCase;


/**
 * Class CacheTest
 */

class CacheTest extends TestCase
{

    private $cache = null;

    /**
     * CacheTest constructor.
     */
    public function __construct()
    {
        parent::__construct();

        $this->cache = new \Cache();
    }


    /**
     * Try to test STRING variable with put/get methods
     */
    public function testSimilar()
    {
        $ident = 'Similar';
        $value = 'Test value';

        try {
            $this->cache->setDir(__DIR__ . '/cache');
            $this->cache->put($ident, $value);
            $result = $this->cache->get($ident);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertEquals($value, $result);
    }

    /**
     * Try to test OBJECT variable with put/get methods
     */
    public function testObject()
    {
        $ident = 'Object';
        try {
            $value = mysqli_connect('localhost', 'root', '');

            $this->cache->setDir(__DIR__ . '/cache');
            $this->cache->put($ident, $value);
            $result = $this->cache->get($ident);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }

        $this->assertTrue(is_object($result));
    }

    /**
     * Try to test ARRAY variable with put/get methods
     */
    public function testArray()
    {
        $ident = 'Array';
        $value = ['First', 'Second'];

        try {
            $this->cache->setDir(__DIR__ . '/cache');
            $this->cache->put($ident, $value);

            $result = $this->cache->get($ident);
        } catch (Exception $e) {
            $this->fail($e->getMessage());
        }
        $this->assertTrue(is_array($result));
    }
}
