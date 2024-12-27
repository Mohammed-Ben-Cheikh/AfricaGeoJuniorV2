<?php
function checkAuth() {
    session_start();
    if (!isset($_SESSION['user_id'])) {
        header('Location: /authentification/login.php');
        exit();
    }
}

function checkAdmin() {
    session_start();
    if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
        header('Location: /authentification/login.php');
        exit();
    }
}
