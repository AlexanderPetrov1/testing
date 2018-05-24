<?php

session_start();
function __autoload($class) {
    require $class . '.php';
}

use Classes\EmailLogin;
use Classes\PhoneLogin;


// Try to create new class with demo data
$user = new EmailLogin('test@test.com', '123456');

// And try to find user with this demo data
$userId = $user->findUser();

// If we find a user
if ($userId) {
    // Make him logged in
    $user->userLogin($userId);

    // Let's report this
    echo 'Email login returns ID: ' . $user->getUserId();

    // And make him logged out
    $user->userLogout();
} else {
    // Otherwise let's say that such user does not exist
    echo 'Access denied via Email Login';
}
echo '<br />';



// Try to create new class with demo data
$user = new PhoneLogin('+380956800223');

// Send him SMS via provider ( SmsOne or SmsTwo providers are support )
$sendedSms = $user->sendSms('SmsOne');
if (!$sendedSms) {
    $sendedSms = $user->sendSms('SmsTwo');
}

if ($sendedSms) {
    // Check the code "entered" by the user
    $user->setUserSmsCode('1111');

    // And try to find user with this demo data
    $userId = $user->findUser();

    // If we find a user
    if ($userId) {
        // Make him logged in
        $user->userLogin($userId);

        // Let's report this
        echo 'Phone login returns ID: ' . $user->getUserId();

        // And make him logged out
        $user->userLogout();
    } else {
        // Otherwise let's say that such user does not exist
        echo 'Access denied via Phone Login';
    }
    echo '<br />';
} else {
    echo 'Error with SMS services. Please, try again later';
}
