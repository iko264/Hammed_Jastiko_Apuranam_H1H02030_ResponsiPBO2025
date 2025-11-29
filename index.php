<?php
session_start();
require_once __DIR__ . '/classes/Pidgey.php';

if (!isset($_SESSION['pokemon'])) {
    $_SESSION['pokemon'] = serialize(new Pidgey());
}

$pokemon = @unserialize($_SESSION['pokemon']);
if (!$pokemon || !($pokemon instanceof Pidgey)) {
    $_SESSION['pokemon'] = serialize(new Pidgey());
    $pokemon = unserialize($_SESSION['pokemon']);
}

$data = $pokemon->getData();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>PokéCare — Beranda</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <img src="assets/img/pidgey.png" class="pokemon-img" alt="Pidgey">
      <div>
        <h1>PokéCare — <?php echo htmlspecialchars($data['name']); ?></h1>
        <div>Type: <?php echo htmlspecialchars($data['type']); ?> &nbsp; | &nbsp; Level: <?php echo htmlspecialchars($data['level']); ?></div>
      </div>
    </div>

    <div class="card">
      <div class="row">
        <div style="flex:1">
          <table class="table">
            <tr><th>HP</th><td><?php echo htmlspecialchars($data['hp']); ?></td></tr>
            <tr><th>Attack</th><td><?php echo htmlspecialchars($data['attack']); ?></td></tr>
            <tr><th>Defense</th><td><?php echo htmlspecialchars($data['defense']); ?></td></tr>
            <tr><th>Speed</th><td><?php echo htmlspecialchars($data['speed']); ?></td></tr>
            <tr><th>Special Move</th><td><?php echo htmlspecialchars($data['specialMove']); ?></td></tr>
          </table>
        </div>
        <div style="min-width:220px">
          <a class="btn" href="train.php">Mulai Latihan</a>
          <a class="btn" href="history.php">Riwayat Latihan</a>
        </div>
      </div>
    </div>

  </div>
</body>
</html>
