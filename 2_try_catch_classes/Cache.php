<?php

/**
 * Class Cache
 */

class Cache {

    /**
     * Dir for the cache files
     *
     * @var string
     */
    private $dir = null;

    /**
     *
     * Set dir for the cache
     * @param $dir
     * @throws Exception
     *
     */
    public function setDir($dir) {
        $this->dir = $dir;

        if (!is_dir($this->dir)) {
            if (!@mkdir($this->dir, true)) {
                throw new Exception ("'Coudn\'t create cache dir");
            }
        }
    }

    /**
     *
     * Put data to cache file or throw exception
     * @param $ident
     * @param $value
     * @throws Exception
     */
    public function put($ident, $value) {
        $cache = [
            'type' => gettype($value),
            'value' => $value,
        ];

        if (!file_put_contents($this->generateFileName($ident), json_encode($cache))) {
            throw new Exception("Cache file is unwriteable");
        };
    }

    /**
     *
     * Get data from cache and return it on it's format
     * Or throw exception
     *
     * @param $ident
     * @return mixed
     * @throws Exception
     */
    public function get($ident) {
        $cacheFile = $this->generateFileName($ident);

        if (!file_exists($cacheFile)) {
            throw new Exception("Cache file for {$ident} value not found");
        }

        if (!$cache = file_get_contents($cacheFile)) {
            throw new Exception("Can't read file for {$ident} value");
        }


        if (!$cacheData = json_decode($cache, true)) {
            throw new Exception("Can't decode data from file for {$ident} value");
        }

        $type = gettype($cacheData['value']);
        if (!$type == $cacheData['type']) {
            throw new Exception("Cache data have incorrect type for {$ident} value. May be file was crashed");
        }

        settype($cacheData['value'], $cacheData['type']);
        return $cacheData['value'];

    }

    /**
     *
     * Generate cache file name using ident
     * @param $ident
     * @return string
     */
    private function generateFileName($ident) {
        return $this->dir . DIRECTORY_SEPARATOR . md5($ident);
    }

}