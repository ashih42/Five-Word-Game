<?php

session_start();

// Save a story containing 5 words to cookie
if (isset($_GET['save'])) {
    $name = urlencode($_SESSION['word'][2]) . time();
    setcookie(
        $name,
        implode(':', $_SESSION['word']),
        strtotime('+30 days'),
        '/');
// Load a story containing 5 words from cookie    
} else if (isset($_GET['read'])) {
    $_SESSION['word'] = array_combine(
        range(1,5),
        explode(':', $_COOKIE[$_GET['read']]));
    header('location: /story.php');
    exit;
// Delete a story from cookie by setting expiration time in the past
} else if (isset($_GET['delete'])) {
    setcookie(
        $_GET['delete'],
        '',
        time() - 3600,
        '/');
}

header('location: /index.php');
exit;
