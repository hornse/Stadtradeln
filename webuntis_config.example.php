<?php
// Beispielhafte Konfiguration für WebUntis-OAuth-Login
// Diese Datei sollte NICHT produktiv verwendet werden – nur als Vorlage!

return [
  'school' => 'meine-schule', // Schulname wie in WebUntis
  'url' => 'https://webuntis.com/WebUntis/',
  'client_id' => 'stadtradeln-app',
  'client_secret' => 'BITTE_HIER_ECHTEN_CLIENT_SECRET_EINTRAGEN',
  'redirect_uri' => 'https://example.com/stadtradeln/auth/callback.php'
];
?>