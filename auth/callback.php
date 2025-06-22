<?php
session_start();
$config = require 'webuntis_config.php';

if (!isset($_GET['code'])) {
    die('Keine Berechtigung');
}

$token_response = file_get_contents($config['url'] . 'oauth/token?' . http_build_query([
  'client_id' => $config['client_id'],
  'client_secret' => $config['client_secret'],
  'grant_type' => 'authorization_code',
  'code' => $_GET['code'],
  'redirect_uri' => $config['redirect_uri']
]));

$token_data = json_decode($token_response, true);
$access_token = $token_data['access_token'] ?? null;

if (!$access_token) {
    die('Tokenfehler');
}

$opts = ['http' => ['header' => "Authorization: Bearer $access_token"]];
$ctx = stream_context_create($opts);
$user_info = file_get_contents($config['url'] . 'api/userinfo', false, $ctx);
$user = json_decode($user_info, true);

if ($user && isset($user['name'])) {
    $_SESSION['user'] = $user['name'];
    header('Location: ../index.html');
} else {
    die('Benutzer konnte nicht ermittelt werden');
}
?>