<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Buku Tamu Digital STITEK Bontang</title>
  <style>
    body { font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f4; }
    h2 { text-align: center; color: #333; }
    form, .data { max-width: 600px; margin: auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px #ccc; }
    label { display: block; margin-bottom: 5px; }
    input[type="text"], input[type="email"], textarea {
      width: 100%; padding: 8px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 4px;
    }
    button { padding: 10px 20px; background-color:rgb(247, 108, 194); border: none; color: white; border-radius: 5px; cursor: pointer; }
    .error { color: red; margin-bottom: 10px; }
    .success { color: green; font-weight: bold; }
    .hasil { background:rgb(243, 200, 200); padding: 10px; margin-top: 20px; border-left: 5px solid rgb(247, 108, 194); }
  </style>
</head>
<body>

<h2>Buku Tamu Digital STITEK Bontang</h2>

<?php
// Inisialisasi variabel
$nama = $email = $pesan = "";
$error = "";
$sukses = false;

// Proses jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = htmlspecialchars(trim($_POST["nama"]));
  $email = htmlspecialchars(trim($_POST["email"]));
  $pesan = htmlspecialchars(trim($_POST["pesan"]));

  // Validasi input
  if (empty($nama) || empty($email) || empty($pesan)) {
    $error = "Semua kolom wajib diisi!";
  } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error = "Format email tidak valid!";
  } else {
    $sukses = true;
  }
}
?>

<form method="post" action="">
  <?php if ($error): ?>
    <div class="error"><?= $error ?></div>
  <?php endif; ?>

  <label for="nama">Nama Lengkap:</label>
  <input type="text" name="nama" id="nama" value="<?= htmlspecialchars($nama) ?>" required>

  <label for="email">Alamat Email:</label>
  <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>

  <label for="pesan">Pesan / Komentar:</label>
  <textarea name="pesan" id="pesan" rows="4" required><?= htmlspecialchars($pesan) ?></textarea>

  <button type="submit">Kirim Pesan</button>
</form>

<?php if ($sukses): ?>
  <div class="data">
    <p class="success">Pesan berhasil dikirim! Berikut data Anda:</p>
    <div class="hasil">
      <strong>Nama:</strong> <?= $nama ?><br>
      <strong>Email:</strong> <?= $email ?><br>
      <strong>Pesan:</strong><br>
      <?= nl2br($pesan) ?>
    </div>
  </div>
<?php endif; ?>

</body>
</html>