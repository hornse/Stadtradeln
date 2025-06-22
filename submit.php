<?php
// submit.php (geschützt mit Session + Nutzername speichern)

session_start();
if (!isset($_SESSION['user'])) {
    header('Location: auth/webuntis_login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $km = $_POST['km'] ?? null;
    $user = $_SESSION['user'];

    if (!$km || !is_numeric($km)) {
        http_response_code(400);
        echo 'Ungültige Kilometerangabe';
        exit;
    }

    $db = new PDO('sqlite:db.sqlite');
    $stmt = $db->prepare("INSERT INTO eintraege (nutzer, kilometer, zeitpunkt) VALUES (:nutzer, :km, datetime('now'))");
    $stmt->bindParam(':nutzer', $user);
    $stmt->bindParam(':km', $km);

    if ($stmt->execute()) {
        echo 'Eintrag erfolgreich gespeichert!';
    } else {
        echo 'Fehler beim Speichern.';
    }
} else {
    http_response_code(405);
    echo 'Nur POST erlaubt';
}