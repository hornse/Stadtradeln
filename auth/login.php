<?php
$config = require 'webuntis_config.php';
$auth_url = $config['url'] . 'oauth/authorize?' . http_build_query([
  'client_id' => $config['client_id'],
  'redirect_uri' => $config['redirect_uri'],
  'response_type' => 'code',
  'scope' => 'user'
]);
header("Location: $auth_url");
exit;
?>