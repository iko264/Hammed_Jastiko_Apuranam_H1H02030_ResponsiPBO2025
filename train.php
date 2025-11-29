<?php
session_start();
require_once __DIR__ . '/classes/Pidgey.php';

// Pastikan object pokemon ada di session dan valid
if (!isset($_SESSION['pokemon'])) {
    $_SESSION['pokemon'] = serialize(new Pidgey());
}

$pokemon = @unserialize($_SESSION['pokemon']);
if (!$pokemon || !($pokemon instanceof Pidgey)) {
    $_SESSION['pokemon'] = serialize(new Pidgey());
    $pokemon = unserialize($_SESSION['pokemon']);
}

$result = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['training_type'] ?? 'Attack';
    $intensity = isset($_POST['intensity']) ? (int)$_POST['intensity'] : 20;
    $intensity = max(1, min(100, $intensity));

    $beforeFull = $pokemon->getData();

    list($beforeSimple, $afterSimple) = $pokemon->train($type, $intensity);

    $afterFull = $pokemon->getData();

    $_SESSION['pokemon'] = serialize($pokemon);

    if (!isset($_SESSION['history'])) $_SESSION['history'] = [];
    $_SESSION['history'][] = [
        'time' => date('Y-m-d H:i:s'),
        'type' => $type,
        'intensity' => $intensity,
        'before' => $beforeFull,
        'after' => $afterFull
    ];

    $specialDesc = $pokemon->specialMove();

    $result = [
        'type' => $type,
        'intensity' => $intensity,
        'beforeSimple' => $beforeSimple,
        'afterSimple' => $afterSimple,
        'beforeFull' => $beforeFull,
        'afterFull' => $afterFull,
        'special' => $specialDesc
    ];
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Hasil Latihan — PokéCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <?php if ($result): ?>
    <meta http-equiv="refresh" content="6;url=index.php">
  <?php endif; ?>
  <style>
    .result-card { margin-top:18px; padding:16px; border-radius:8px; background:#fff; border:1px solid #e6eef6; }
    .muted { color:#666; font-size:0.95em; }
    .stat-diff { color: #1b7a3a; font-weight:700; }
    .stat-table { width:100%; border-collapse:collapse; margin-top:10px; }
    .stat-table th, .stat-table td { padding:8px; border-bottom:1px solid #f1f5f9; text-align:left; }
  </style>
</head>
<body>
  <div class="container">
    <h1>Latihan — Pidgey</h1>

    <?php if (!$result): ?>
      <div class="card">
        <form method="post">
          <div class="form-row">
            <label>Jenis Latihan</label><br>
            <select name="training_type" class="input">
              <option value="Attack">Attack</option>
              <option value="Defense">Defense</option>
              <option value="Speed">Speed</option>
            </select>
          </div>

          <div class="form-row">
            <label>Intensitas (1-100)</label><br>
            <input class="input" type="number" name="intensity" min="1" max="100" value="20" required>
          </div>

          <div style="margin-top:12px">
            <button class="btn" type="submit">Latih</button>
            <a class="btn" href="index.php">Batal</a>
          </div>
        </form>
      </div>

    <?php else: ?>
      <div class="result-card">
        <h2>Hasil Sesi Latihan</h2>
        <p class="muted">Jenis: <strong><?php echo htmlspecialchars($result['type']); ?></strong> —
           Intensitas: <strong><?php echo htmlspecialchars($result['intensity']); ?></strong></p>

        <hr>

        <p><strong>Level:</strong>
          <?php echo htmlspecialchars($result['beforeSimple']['level']); ?> → 
          <span class="stat-diff"><?php echo htmlspecialchars($result['afterSimple']['level']); ?></span>
        </p>

        <p><strong>HP:</strong>
          <?php echo htmlspecialchars($result['beforeSimple']['hp']); ?> → 
          <span class="stat-diff"><?php echo htmlspecialchars($result['afterSimple']['hp']); ?></span>
        </p>

        <hr>

        <h3>Detail Stat</h3>
        <table class="stat-table">
          <thead>
            <tr>
              <th>Stat</th>
              <th>Sebelum</th>
              <th>Sesudah</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $keys = ['level','hp','attack','defense','speed'];
              foreach ($keys as $k):
            ?>
            <tr>
              <td><?php echo strtoupper($k); ?></td>
              <td><?php echo htmlspecialchars($result['beforeFull'][$k]); ?></td>
              <td><?php echo htmlspecialchars($result['afterFull'][$k]); ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

        <hr>

        <h3>Jurus Spesial</h3>
        <p><?php echo htmlspecialchars($result['special']); ?></p>

        <p class="muted">Anda akan diarahkan kembali ke Beranda dalam 6 detik...</p>
        <div style="margin-top:12px;">
          <a class="btn" href="index.php">Kembali Sekarang</a>
          <a class="btn" href="history.php">Lihat Riwayat</a>
        </div>
      </div>
    <?php endif; ?>

  </div>
</body>
</html>
