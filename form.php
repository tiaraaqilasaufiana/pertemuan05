<?php
$nama = trim($_POST['nama'] ?? '');
$nim = trim($_POST['nim'] ?? '');
$email = trim($_POST['email'] ?? '');
$prodi = $_POST['prodi'] ?? '';
$kegiatan = $_POST['kegiatan'] ?? '';
$jumlah = filter_input(INPUT_POST, 'jumlah', FILTER_VALIDATE_INT);
$persetujuan = $_POST['persetujuan'] ?? '';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if ($nama === '') $errors['nama'] = 'Nama wajib diisi.';
    elseif (mb_strlen($nama) < 3) $errors['nama'] = 'Nama minimal 3 karakter.';

    if ($nim === '') {
        $errors['nim'] = 'NIM wajib diisi.';
    } elseif (!preg_match('/^\d{8,15}$/', $nim)) {
        $errors['nim'] = 'NIM harus 8-15 digit.';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        $errors['email'] = 'Format email tidak valid.';

    $prodiValid = ['Manajemen Informatika', 'Sistem Informasi'];

    if (!in_array($prodi, $prodiValid, true))
        $errors['prodi'] = 'Program studi tidak valid.';

    $kegiatanValid = ['Seminar', 'Workshop', 'Lomba'];

    if (!in_array($kegiatan, $kegiatanValid, true))
        $errors['kegiatan'] = 'Kegiatan tidak valid.';

    if ($jumlah === false || $jumlah === null || $jumlah < 1 || $jumlah > 3)
        $errors['jumlah'] = 'Jumlah peserta harus 1 sampai 3.';

    if ($persetujuan !== 'setuju')
        $errors['persetujuan'] = 'Persetujuan wajib dicentang.';

    if ($errors === []) {
        header('Location: sukses.php?nama=' . urlencode($nama));
        exit;
    }
}

function e(string $value): string {
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
?>

<h1>Pendaftaran Kegiatan Mahasiswa</h1>

<form method="post" novalidate>

  <label>Nama
    <input name="nama" value="<?= e($nama) ?>">
  </label>
  <small><?= e($errors['nama'] ?? '') ?></small>
  <br>

  <label>NIM
    <input name="nim" value="<?= e($nim) ?>">
  </label>
  <small><?= e($errors['nim'] ?? '') ?></small>
  <br>

  <label>Email
    <input type="email" name="email" value="<?= e($email) ?>">
  </label>
  <small><?= e($errors['email'] ?? '') ?></small>
  <br>

  <label>Program Studi
    <select name="prodi">
      <option value="">-- Pilih Program Studi --</option>
      <option value="Manajemen Informatika" <?= $prodi === 'Manajemen Informatika' ? 'selected' : '' ?>>
        Manajemen Informatika
      </option>
      <option value="Sistem Informasi" <?= $prodi === 'Sistem Informasi' ? 'selected' : '' ?>>
        Sistem Informasi
      </option>
    </select>
  </label>
  <small><?= e($errors['prodi'] ?? '') ?></small>
  <br>

  <label>Kegiatan
    <select name="kegiatan">
      <option value="">-- Pilih Kegiatan --</option>
      <option value="Seminar" <?= $kegiatan === 'Seminar' ? 'selected' : '' ?>>
        Seminar
      </option>
      <option value="Workshop" <?= $kegiatan === 'Workshop' ? 'selected' : '' ?>>
        Workshop
      </option>
      <option value="Lomba" <?= $kegiatan === 'Lomba' ? 'selected' : '' ?>>
        Lomba
      </option>
    </select>
  </label>
  <small><?= e($errors['kegiatan'] ?? '') ?></small>
  <br>

  <label>Jumlah peserta
    <input type="number" name="jumlah" min="1" max="3"
           value="<?= e($_POST['jumlah'] ?? '1') ?>">
  </label>
  <small><?= e($errors['jumlah'] ?? '') ?></small>
  <br>

  <label>
    <input type="checkbox" name="persetujuan" value="setuju"
      <?= $persetujuan === 'setuju' ? 'checked' : '' ?>>
    Saya menyetujui pendaftaran
  </label>
  <small><?= e($errors['persetujuan'] ?? '') ?></small>
  <br>

  <button type="submit">Daftar</button>

</form>