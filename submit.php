<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $klasse = htmlspecialchars($_POST['klasse']);
    $kilometer = (int)$_POST['kilometer'];

    if ($kilometer > 0 && $kilometer <= 100) {
        $db = new PDO('sqlite:db.sqlite');
        $stmt = $db->prepare("INSERT INTO eintraege (klasse, kilometer) VALUES (?, ?)");
        $stmt->execute([$klasse, $kilometer]);
    }
}
header('Location: index.html');
?>