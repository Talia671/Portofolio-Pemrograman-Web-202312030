<?php
// Koneksi database
$conn = new mysqli("localhost", "root", "202312030", "db_toko");

// Tambah Data
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $conn->query("INSERT INTO db_toko (nama_produk, harga, stok) VALUES ('$nama', $harga, $stok)");
    header("Location: produk.php");
}

// Update Data
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $conn->query("UPDATE db_toko SET nama_produk='$nama', harga=$harga, stok=$stok WHERE id_produk=$id");
    header("Location: produk.php");
}

// Hapus Data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM db_toko WHERE id_produk=$id");
    header("Location: produk.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Liaethrá</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { padding-top: 50px; background-color:rgb(251, 182, 204); }
        .container { max-width: 800px; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center mb-4">Liaethrá shop</h2>

<?php
// FORM TAMBAH
if (isset($_GET['aksi']) && $_GET['aksi'] == 'tambah'): ?>
    <div class="card">
        <div class="card-header bg-success text-white">Tambah Produk Baru</div>
        <div class="card-body">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" required>
                </div>
                <button type="submit" name="tambah" class="btn btn-success">Simpan</button>
                <a href="produk.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

<?php
// FORM EDIT
elseif (isset($_GET['aksi']) && $_GET['aksi'] == 'edit'):
    $id = $_GET['id'];
    $data = $conn->query("SELECT * FROM db_toko WHERE id_produk=$id")->fetch_assoc();
?>
    <div class="card">
        <div class="card-header bg-warning text-dark">Edit Produk</div>
        <div class="card-body">
            <form method="post">
                <input type="hidden" name="id" value="<?= $data['id_produk'] ?>">
                <div class="mb-3">
                    <label class="form-label">Nama Produk</label>
                    <input type="text" name="nama" class="form-control" value="<?= $data['nama_produk'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Harga</label>
                    <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" value="<?= $data['stok'] ?>" required>
                </div>
                <button type="submit" name="edit" class="btn btn-warning">Update</button>
                <a href="produk.php" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>

<?php
// TAMPILAN UTAMA
else:
    $produk = $conn->query("SELECT * FROM db_toko");
?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar Produk</h4>
        <a href="produk.php?aksi=tambah" class="btn btn-primary">+ Tambah Produk</a>
    </div>
    <table class="table table-bordered table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php while ($row = $produk->fetch_assoc()): ?>
        <tr>
            <td><?= $row['id_produk'] ?></td>
            <td><?= $row['nama_produk'] ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
            <td><?= $row['stok'] ?></td>
            <td>
                <a href="produk.php?aksi=edit&id=<?= $row['id_produk'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="produk.php?hapus=<?= $row['id_produk'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>
</div>

</body>
</html>