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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['training_type'] ?? 'Attack';
    $intensity = isset($_POST['intensity']) ? (int)$_POST['intensity'] : 10;
    list($before, $after) = $pokemon->train($type, $intensity);

    $_SESSION['pokemon'] = serialize($pokemon);


    if (!isset($_SESSION['history'])) $_SESSION['history'] = [];
    $_SESSION['history'][] = [
        'time' => date('Y-m-d H:i:s'),
        'type' => $type,
        'intensity' => $intensity,
        'before' => $before,
        'after' => $after
    ];

    header('Location: index.php');
    exit();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Latihan — PokéCare</title>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container">
    <h1>Latihan — Pidgey</h1>

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

  </div>
</body>
</html>
