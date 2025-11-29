<?php
session_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Riwayat Latihan — PokéCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Riwayat Latihan</h1>

    <div class="card">
    <?php if (!empty($_SESSION['history'])): ?>
      <table class="table">
        <tr><th>Waktu</th><th>Jenis</th><th>Intensitas</th><th>Level (sebelum → sesudah)</th><th>HP (sebelum → sesudah)</th></tr>
        <?php foreach (array_reverse($_SESSION['history']) as $h): ?>
        <tr>
          <td><?php echo htmlspecialchars($h['time']); ?></td>
          <td><?php echo htmlspecialchars($h['type']); ?></td>
          <td><?php echo htmlspecialchars($h['intensity']); ?></td>
          <td><?php echo htmlspecialchars($h['before']['level']) . ' → ' . htmlspecialchars($h['after']['level']); ?></td>
          <td><?php echo htmlspecialchars($h['before']['hp']) . ' → ' . htmlspecialchars($h['after']['hp']); ?></td>
        </tr>
        <?php endforeach; ?>
      </table>
    <?php else: ?>
      <p>Belum ada riwayat latihan.</p>
    <?php endif; ?>

    <div style="margin-top:12px">
      <a class="btn" href="index.php">Kembali</a>
    </div>
    </div>
  </div>
</body>
</html>
