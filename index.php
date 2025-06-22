<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: auth/login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="UTF-8">
  <title>Stadtradeln – Kilometer eintragen</title>
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <header>
    <h1>Willkommen beim Stadtradeln</h1>
    <p>Eingeloggt als: <?php echo htmlspecialchars($_SESSION['user']); ?></p>
  </header>
  <main>
    <form action="submit.php" method="POST">
      <label>Klasse:
        <input type="text" name="klasse" required>
      </label>
      <label>Gefahrene Kilometer:
        <input type="number" name="kilometer" min="1" max="100" required>
      </label>
      <button type="submit">Kilometer eintragen</button>
    </form>

    <h2>Live-Ranking</h2>
    <canvas id="chart" width="400" height="200"></canvas>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    fetch('data.php')
      .then(res => res.json())
      .then(data => {
        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: data.map(e => e.klasse),
            datasets: [{
              label: 'Gesamtkilometer',
              data: data.map(e => e.kilometer),
            }]
          },
          options: {
            scales: { y: { beginAtZero: true } }
          }
        });
      });
  </script>
</body>
</html>
