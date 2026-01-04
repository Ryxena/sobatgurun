

-- 1. Tabel Admin (Login Petugas)
CREATE TABLE admin (
    id_admin INT(11) NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nama_petugas VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_admin),
    UNIQUE KEY uk_admin_username (username)
) ENGINE=InnoDB;

-- 2. Tabel Paket Travel (Produk)
CREATE TABLE paket_travel (
    id_paket INT(11) NOT NULL AUTO_INCREMENT,
    nama_paket VARCHAR(100) NOT NULL,
    jenis_paket ENUM('Haji', 'Umroh', 'Wisata Halal') NOT NULL,
    harga DECIMAL(15,2) NOT NULL,
    kuota INT(5) NOT NULL,
    tgl_berangkat DATE NOT NULL,
    deskripsi TEXT,
    PRIMARY KEY (id_paket)
) ENGINE=InnoDB;

-- 3. Tabel Jamaah (User Login & Data Diri)
CREATE TABLE jamaah (
    id_jamaah INT(11) NOT NULL AUTO_INCREMENT,
    email VARCHAR(100) NOT NULL,
    password VARCHAR(255) NOT NULL,
    nik CHAR(16) NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    no_hp VARCHAR(15) NOT NULL,
    no_paspor VARCHAR(20) DEFAULT NULL,
    alamat TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_jamaah),
    UNIQUE KEY uk_jamaah_email (email),
    UNIQUE KEY uk_jamaah_nik (nik)
) ENGINE=InnoDB;

-- 4. Tabel Transaksi (Pemesanan)
CREATE TABLE transaksi (
    id_transaksi INT(11) NOT NULL AUTO_INCREMENT,
    no_invoice VARCHAR(20) NOT NULL,
    id_jamaah INT(11) NOT NULL,
    id_paket INT(11) NOT NULL,
    tgl_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
    status_bayar ENUM('Menunggu Pembayaran', 'Verifikasi', 'DP', 'Lunas', 'Batal') NOT NULL DEFAULT 'Menunggu Pembayaran',
    PRIMARY KEY (id_transaksi),
    UNIQUE KEY uk_invoice (no_invoice),
    CONSTRAINT fk_trx_jamaah FOREIGN KEY (id_jamaah) REFERENCES jamaah (id_jamaah) ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_trx_paket FOREIGN KEY (id_paket) REFERENCES paket_travel (id_paket) ON UPDATE CASCADE ON DELETE RESTRICT
) ENGINE=InnoDB;

-- 5. Tabel Pembayaran (Cicilan & Bukti Bayar)
CREATE TABLE pembayaran (
    id_bayar INT(11) NOT NULL AUTO_INCREMENT,
    id_transaksi INT(11) NOT NULL,
    tgl_bayar DATETIME DEFAULT CURRENT_TIMESTAMP,
    jumlah_bayar DECIMAL(15,2) NOT NULL,
    bukti_bayar VARCHAR(255) NOT NULL,
    status_verifikasi ENUM('Pending', 'Valid', 'Invalid') NOT NULL DEFAULT 'Pending',
    keterangan VARCHAR(100) DEFAULT NULL,
    PRIMARY KEY (id_bayar),
    CONSTRAINT fk_bayar_trx FOREIGN KEY (id_transaksi) REFERENCES transaksi (id_transaksi) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB;