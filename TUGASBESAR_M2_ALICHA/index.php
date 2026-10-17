<?php
require_once 'koneksi.php';

$pesan = '';
$is_edit = false;
$id_edit = '';
$nama_lapangan = '';
$jenis_rumput_lantai = '';
$ukuran_lapangan = '';
$harga_sewa_per_jam = '';

// create
if (isset($_POST['simpan'])) {
    $nama_lapangan       = trim($_POST['nama_lapangan']);
    $jenis_rumput_lantai = trim($_POST['jenis_rumput_lantai']);
    $ukuran_lapangan     = trim($_POST['ukuran_lapangan']);
    $harga_sewa_per_jam  = intval($_POST['harga_sewa_per_jam']);

    if (!empty($nama_lapangan) && !empty($jenis_rumput_lantai) && !empty($ukuran_lapangan) && $harga_sewa_per_jam > 0) {
        $query = "INSERT INTO tbl_lapangan (nama_lapangan, jenis_rumput_lantai, ukuran_lapangan, harga_sewa_per_jam) 
                  VALUES ('$nama_lapangan', '$jenis_rumput_lantai', '$ukuran_lapangan', '$harga_sewa_per_jam')";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?pesan=tambah_sukses");
            exit;
        } else {
            $pesan = 'Gagal menambahkan data: ' . mysqli_error($koneksi);
        }
    } else {
        $pesan = 'Mohon lengkapi semua data dengan benar.';
    }
}

// update
if (isset($_POST['perbarui'])) {
    $id_edit             = intval($_POST['id_lapangan']);
    $nama_lapangan       = trim($_POST['nama_lapangan']);
    $jenis_rumput_lantai = trim($_POST['jenis_rumput_lantai']);
    $ukuran_lapangan     = trim($_POST['ukuran_lapangan']);
    $harga_sewa_per_jam  = intval($_POST['harga_sewa_per_jam']);

    if ($id_edit > 0 && !empty($nama_lapangan) && !empty($jenis_rumput_lantai) && !empty($ukuran_lapangan)) {
        $query = "UPDATE tbl_lapangan SET
                  nama_lapangan = '$nama_lapangan',
                  jenis_rumput_lantai = '$jenis_rumput_lantai',
                  ukuran_lapangan = '$ukuran_lapangan',
                  harga_sewa_per_jam = '$harga_sewa_per_jam'
                  WHERE id_lapangan = '$id_edit'";
        if (mysqli_query($koneksi, $query)) {
            header("Location: index.php?pesan=edit_sukses");
            exit;
        } else {
            $pesan = 'Gagal mengubah data: ' . mysqli_error($koneksi);
        }
    }
}

// delete
if (isset($_GET['hapus'])) {
    $id_hapus = intval($_GET['hapus']);
    $query = "DELETE FROM tbl_lapangan WHERE id_lapangan = '$id_hapus'";
    if (mysqli_query($koneksi, $query)) {
        header("Location: index.php?pesan=hapus_sukses");
        exit;
    }
}

// get
if (isset($_GET['edit'])) {
    $id_edit = intval($_GET['edit']);
    $query_edit = mysqli_query($koneksi, "SELECT * FROM tbl_lapangan WHERE id_lapangan = '$id_edit'");
    if ($row_edit = mysqli_fetch_assoc($query_edit)) {
        $is_edit = true;
        $nama_lapangan       = $row_edit['nama_lapangan'];
        $jenis_rumput_lantai = $row_edit['jenis_rumput_lantai'];
        $ukuran_lapangan     = $row_edit['ukuran_lapangan'];
        $harga_sewa_per_jam  = $row_edit['harga_sewa_per_jam'];
    }
}


if (isset($_GET['pesan'])) {
    if ($_GET['pesan'] == 'tambah_sukses') $pesan = 'Data lapangan berhasil ditambahkan.';
    if ($_GET['pesan'] == 'edit_sukses') $pesan = 'Data lapangan berhasil diperbarui.';
    if ($_GET['pesan'] == 'hapus_sukses') $pesan = 'Data lapangan berhasil dihapus.';
}


$query_tampil = mysqli_query($koneksi, "SELECT * FROM tbl_lapangan ORDER BY id_lapangan DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistem pengelolaan data lapangan</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <header class="header">
    <div class="header-container">
      <h1>Sistem pengelolaan data lapangan</h1>
    </div>
  </header>

  <main class="container">
    
    <?php if (!empty($pesan)): ?>
      <div class="alert">
        <span><?php echo htmlspecialchars($pesan); ?></span>
        <button type="button" class="close-alert" onclick="this.parentElement.style.display='none';">&times;</button>
      </div>
    <?php endif; ?>

    <div class="layout-grid">
      
      <!-- Form Input/Edit Data Lapangan -->
      <section class="card">
        <div class="card-title">
          <h2><?php echo $is_edit ? 'Edit Data Lapangan' : 'Tambah Data Lapangan'; ?></h2>
        </div>
        <div class="card-body">
          <form action="index.php" method="POST">
            <?php if ($is_edit): ?>
              <input type="hidden" name="id_lapangan" value="<?php echo $id_edit; ?>">
            <?php endif; ?>

            <div class="form-group">
              <label for="nama_lapangan">Nama Lapangan</label>
              <input type="text" id="nama_lapangan" name="nama_lapangan" value="<?php echo htmlspecialchars($nama_lapangan); ?>" placeholder="Masukkan nama lapangan" required>
            </div>

            <div class="form-group">
              <label for="jenis_rumput_lantai">Jenis Rumput/Lantai</label>
              <input type="text" id="jenis_rumput_lantai" name="jenis_rumput_lantai" value="<?php echo htmlspecialchars($jenis_rumput_lantai); ?>" placeholder="Contoh: Rumput Sintetis / Vinyl" required>
            </div>

            <div class="form-group">
              <label for="ukuran_lapangan">Ukuran Lapangan</label>
              <input type="text" id="ukuran_lapangan" name="ukuran_lapangan" value="<?php echo htmlspecialchars($ukuran_lapangan); ?>" placeholder="Contoh: 25m x 15m" required>
            </div>

            <div class="form-group">
              <label for="harga_sewa_per_jam">Harga Sewa per Jam (Rp)</label>
              <input type="number" id="harga_sewa_per_jam" name="harga_sewa_per_jam" value="<?php echo htmlspecialchars($harga_sewa_per_jam); ?>" placeholder="Contoh: 150000" min="0" required>
            </div>

            <div class="form-actions">
              <?php if ($is_edit): ?>
                <button type="submit" name="perbarui" class="btn btn-primary">Perbarui Data</button>
                <a href="index.php" class="btn btn-secondary">Batal</a>
              <?php else: ?>
                <button type="submit" name="simpan" class="btn btn-primary">Simpan Data</button>
              <?php endif; ?>
            </div>
          </form>
        </div>
      </section>

      <!-- Tabel Data Lapangan -->
      <section class="card">
        <div class="card-title">
          <h2>Daftar Lapangan</h2>
        </div>
        <div class="card-body p-0">
          <div class="table-container">
            <table>
              <thead>
                <tr>
                  <th style="width: 50px; text-align: center;">No</th>
                  <th>Nama Lapangan</th>
                  <th>Jenis Rumput / Lantai</th>
                  <th>Ukuran Lapangan</th>
                  <th>Harga Sewa per Jam</th>
                  <th style="text-align: center; width: 140px;">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($query_tampil) > 0): ?>
                  <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($query_tampil)): 
                  ?>
                    <tr>
                      <td style="text-align: center;"><?php echo $no++; ?></td>
                      <td><strong><?php echo htmlspecialchars($row['nama_lapangan']); ?></strong></td>
                      <td><?php echo htmlspecialchars($row['jenis_rumput_lantai']); ?></td>
                      <td><?php echo htmlspecialchars($row['ukuran_lapangan']); ?></td>
                      <td>Rp <?php echo number_format($row['harga_sewa_per_jam'], 0, ',', '.'); ?></td>
                      <td style="text-align: center;">
                        <div class="actions">
                          <a href="index.php?edit=<?php echo $row['id_lapangan']; ?>" class="btn-sm btn-edit">Edit</a>
                          <a href="index.php?hapus=<?php echo $row['id_lapangan']; ?>" class="btn-sm btn-hapus" onclick="return confirm('Yakin ingin menghapus data lapangan ini?');">Hapus</a>
                        </div>
                      </td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr>
                    <td colspan="6" style="text-align: center; padding: 30px; color: #64748b;">
                      Belum ada data lapangan. Silakan input pada formulir.
                    </td>
                  </tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </section>

    </div>
  </main>

</body>
</html>