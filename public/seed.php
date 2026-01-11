<?php
require_once '../app/init.php';

$db = new Database;

try {
    $passAdmin = password_hash('admin123', PASSWORD_DEFAULT); // Password: admin123

    $queryAdmin = "INSERT INTO admin (username, password, nama_petugas) 
                   VALUES (:user, :pass, :nama)";

    $db->query($queryAdmin);
    $db->bind('user', 'admin');
    $db->bind('pass', $passAdmin);
    $db->bind('nama', 'Administrator Utama');
    $db->execute();

    echo "<p style='color:green'><b>Sukses!</b> Admin dibuat.<br>
          Username: <b>admin</b> | Password: <b>admin123</b></p>";

} catch (Exception $e) {
    echo "<p style='color:red'>   <b>Skip Admin:</b> Username 'admin' mungkin sudah ada.</p>";
}

echo "<hr>";

try {
    $passJamaah = password_hash('jamaah123', PASSWORD_DEFAULT); // Password: jamaah123

    $queryJamaah = "INSERT INTO jamaah (email, password, nik, nama_lengkap, no_hp, alamat) 
                    VALUES (:email, :pass, :nik, :nama, :hp, :alamat)";

    $db->query($queryJamaah);
    $db->bind('email',  'user@sobatgurun.com');
    $db->bind('pass',   $passJamaah);
    $db->bind('nik',    '3301999999999999');
    $db->bind('nama',   'Jamaah Test Satu');
    $db->bind('hp',     '08129999999');
    $db->bind('alamat', 'Jl. Testing No. 1, Jakarta');
    $db->execute();

    echo "<p style='color:green'><b>Sukses!</b> Jamaah dibuat.<br>
          Email: <b>user@sobatgurun.com</b> | Password: <b>jamaah123</b></p>";

} catch (Exception $e) {
    echo "<p style='color:red'><b>Skip Jamaah:</b> Email/NIK tersebut mungkin sudah ada.</p>";
}

echo "<hr><b>Selesai.</b> Silakan hapus file ini jika sudah live.";