<?php
    session_start();

    define('CACHE', __DIR__ . '/cache/cache.txt');

    // Default login data
    define('TRUE_EMAIL',            'test@example.com'  );
    define('TRUE_PASSWORD',         'testtest'          );

    // Default check data
    define('CHECK_CAPTCHA',         '123'               );
    define('CHECK_EMAIL',           '456'               );
    define('CHECK_SMS',             '789'               );

    // Attemts count for captcha, email or sms
    define('ATTEMPTS_FOR_CAPTCHA',  3                   );
    define('ATTEMPTS_FOR_EMAIL',    6                   );
    define('ATTEMPTS_FOR_SMS',      9                   );

    // Clear cache after 24h
    define('CACHE_EXPIRE',          60*60*24            );


    $_SESSION['validation'] = '';
    $_SESSION['fails'] = [];

    if (isset($_POST['action']) && $_POST['action'] == 'login') {
        $cache = getCacheByKey($_POST['email']);
        $cache['attempt'] += 1;

        if ($cache['attempt'] > ATTEMPTS_FOR_SMS) {
            // Check sms validation
            $validation = isset($_POST['check_sms']) && $_POST['check_sms'] == CHECK_SMS;
            if (!$validation) $_SESSION['fails'][] = 'Code from SMS is incorrect';
            $_SESSION['validation'] = 'sms';

        } elseif ($cache['attempt'] > ATTEMPTS_FOR_EMAIL) {
            // Check email validation
            $validation = isset($_POST['check_email']) && $_POST['check_email'] == CHECK_EMAIL;
            if (!$validation) $_SESSION['fails'][] = 'Code from EMAIL is incorrect';
            $_SESSION['validation'] = 'email';

        } elseif ($cache['attempt'] > ATTEMPTS_FOR_CAPTCHA) {
            // Check sms validation
            $validation = isset($_POST['check_captcha']) && $_POST['check_captcha'] == CHECK_CAPTCHA;
            if (!$validation) $_SESSION['fails'][] = 'Code from CAPTCHA is incorrect';
            $_SESSION['validation'] = 'captcha';

        } else {
            // Nothing to validate
            $validation = true;
        }

        // Check login, password and secure code (connect to "database" here
        $validation = ($_POST['email'] == TRUE_EMAIL && $_POST['password'] == TRUE_PASSWORD && $validation);

        if ($validation) {
            // Clear cache by this email
            clearCache($_POST['email']);
            $_SESSION['is_logged_in'] = true;

        } else {
            // Update cache
            $cache['last_attempt'] = time();
            putCache($_POST['email'], $cache);
            $_SESSION['fails'][] = 'Access denied';
        }
    }

    // If user is logged in - redirect him to cabinet
    if (isset($_SESSION['is_logged_in'])) {
        header('Location: cabinet.php');
    }

    require "template.tpl";

    /**
    * Get data from cache by key
    * @param $key
    * @return array|mixed
    */
    function getCacheByKey($key) {
        $empty = ['attempt' => 0, 'last_attempt' => 0];

        $cache = getAllCache();
        return isset($cache[$key]) ? $cache[$key] : $empty;
    }


    /**
    * Get all cached data
    * @return array|mixed
    */
    function getAllCache() {

        if (file_exists(CACHE)) {
            // Try to get cache data from file

            $cache = json_decode(file_get_contents(CACHE), true);
            return $cache;

        } elseif (@touch(CACHE)) {
            // Try to write empty cache data to file. Return empty data if file is writeable

            return [];

        } elseif (isset($_SESSION['cache'])) {
            // Cache file is not writeable. Try to get cache data from session

            return $_SESSION['cache'];

        } else {
            // Cache is empty in file and in session

            return [];
        }
    }

    /**
    * Save cache data
    * @param $key
    * @param $value
    */
    function putCache($key, $value) {

        $key = strtolower($key);
        if (empty($key)) return;

        if (file_exists(CACHE)) {
            // Try to get cache data from file

            $cache = json_decode(file_get_contents(CACHE), true);
            $cache[$key] = $value;
        } elseif (isset($_SESSION['cache'])) {
            // Get cache data from session

            $cache = $_SESSION['cache'];
            $cache[$key] = $value;
        }

        if (!@file_put_contents(CACHE, json_encode($cache))) {
            // If we can't write cache to file - write it in session. No other choise

            $_SESSION['cache'] = $cache;
        }

    }

    /**
    * Clear expired cache or cache by email
    * @param string $withEmail
    */
    function clearCache($withEmail = '') {
        $withEmail = strtolower($withEmail);

        $cache = getAllCache();
        foreach ($cache as $key => $value) {
            if ($value['last_attempt'] + CACHE_EXPIRE < time() || $key == $withEmail) {
                unset($cache[$key]);
            }
        }

        if (!@file_put_contents(CACHE, json_encode($cache))) {
            // If we can't write cache to file - write it in session. No other choise

            $_SESSION['cache'] = $cache;
        }

    }