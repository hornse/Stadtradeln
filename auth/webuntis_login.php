<?php
// auth/webuntis_login.php

session_start();

$config = require __DIR__ . '/webuntis_config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? null;
    $pass = $_POST['pass'] ?? null;

    if (!$user || !$pass) {
        http_response_code(400);
        echo 'Benutzername und Passwort erforderlich';
        exit;
    }

    $params = [
        'user' => $user,
        'password' => $pass,
        'client' => $config['client'],
    ];

    $data = [
        'id' => 'ID',
        'method' => 'authenticate',
        'params' => $params,
        'jsonrpc' => '2.0'
    ];

    $url = rtrim($config['url'], '/') . "/WebUntis/jsonrpc.do?school=" . urlencode($config['school']);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT'] ?? 'PHP');
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_ENCODING, '');

    $result = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($result === false || $http_code !== 200) {
        echo "Authentifizierung fehlgeschlagen";
        curl_close($ch);
        exit;
    }

    $response = json_decode($result, true);
    if (isset($response['result']['sessionId'])) {
        $_SESSION['user'] = $user;
        header('Location: ../index.php');
        exit;
    } else {
        echo "Login fehlgeschlagen.";
    }

    curl_close($ch);
} else {
    // Wenn der Nutzer schon eingeloggt ist, weiterleiten
    if (isset($_SESSION['user'])) {
        header('Location: ../index.php');
        exit;
    }
    echo '<form method="POST">';
    echo '<label>Benutzername: <input type="text" name="user" required></label><br>';
    echo '<label>Passwort: <input type="password" name="pass" required></label><br>';
    echo '<button type="submit">Login</button>';
    echo '</form>';
}
