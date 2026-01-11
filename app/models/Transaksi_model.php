<?php

class Transaksi_model
{
    private $table = 'transaksi';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function tambahTransaksi($data)
    {
        $id_jamaah = $_SESSION['id_user'];
        $id_paket  = $data['id_paket'];

        $queryCek = "SELECT * FROM transaksi 
                     WHERE id_jamaah = :id_j 
                     AND id_paket = :id_p 
                     AND (status_bayar != 'Batal' AND status_bayar != 'Gagal')";

        $this->db->query($queryCek);
        $this->db->bind('id_j', $id_jamaah);
        $this->db->bind('id_p', $id_paket);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {
            return -1;
        }

        $queryKuota = "SELECT kuota FROM paket_travel WHERE id_paket = :id_p";
        $this->db->query($queryKuota);
        $this->db->bind('id_p', $id_paket);
        $dataPaket = $this->db->single();

        if ($dataPaket['kuota'] <= 0) {
            return -2;
        }

        $invoice = "INV-" . mt_rand(1000, 9999) . date('dmY');

        $queryInsert = "INSERT INTO transaksi 
                        (no_invoice, id_jamaah, id_paket, status_bayar, tgl_transaksi)
                        VALUES
                        (:invoice, :id_jamaah, :id_paket, 'Menunggu Pembayaran', NOW())";

        $this->db->query($queryInsert);
        $this->db->bind('invoice', $invoice);
        $this->db->bind('id_jamaah', $id_jamaah);
        $this->db->bind('id_paket', $id_paket);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {

            $queryKurang = "UPDATE paket_travel SET kuota = kuota - 1 WHERE id_paket = :id_p";
            $this->db->query($queryKurang);
            $this->db->bind('id_p', $id_paket);
            $this->db->execute();

            return $invoice;
        } else {
            return false;
        }
    }

    public function getTransaksiByInvoice($no_invoice)
    {
        $query = "SELECT * FROM transaksi 
                  JOIN paket_travel ON transaksi.id_paket = paket_travel.id_paket
                  JOIN jamaah ON transaksi.id_jamaah = jamaah.id_jamaah
                  WHERE transaksi.no_invoice = :invoice";

        $this->db->query($query);
        $this->db->bind('invoice', $no_invoice);
        return $this->db->single();
    }

    public function getRiwayatJamaah($id_jamaah)
    {
        $query = "SELECT * FROM transaksi 
                  JOIN paket_travel ON transaksi.id_paket = paket_travel.id_paket
                  WHERE transaksi.id_jamaah = :id
                  ORDER BY transaksi.tgl_transaksi DESC";

        $this->db->query($query);
        $this->db->bind('id', $id_jamaah);
        return $this->db->resultSet();
    }

    public function getAllTransaksi()
    {
        $query = "SELECT t.*, p.nama_paket, j.nama_lengkap, b.bukti_bayar, b.jumlah_bayar
                  FROM transaksi t
                  JOIN paket_travel p ON t.id_paket = p.id_paket
                  JOIN jamaah j ON t.id_jamaah = j.id_jamaah
                  LEFT JOIN pembayaran b ON t.id_transaksi = b.id_transaksi
                  ORDER BY t.tgl_transaksi DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function getTransaksiById($id)
    {
        $query = "SELECT * FROM transaksi 
                  JOIN paket_travel ON transaksi.id_paket = paket_travel.id_paket
                  WHERE id_transaksi = :id";

        $this->db->query($query);
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function simpanPembayaran($data)
    {

        // Data dari Form
        $id_trx = $data['id_transaksi'];
        $tipe = $data['tipe_pembayaran'];
        $jumlah = $data['jumlah_bayar'];

        $keteranganBukti = "Metode: " . $tipe;

        $queryBayar = "INSERT INTO pembayaran 
                        (id_transaksi, jumlah_bayar, bukti_bayar, status_verifikasi, tgl_bayar)
                       VALUES 
                        (:id_trx, :jumlah, :bukti, 'Pending', NOW())";

        $this->db->query($queryBayar);
        $this->db->bind('id_trx', $id_trx);
        $this->db->bind('jumlah', $jumlah);
        $this->db->bind('bukti', $keteranganBukti);
        $this->db->execute();

        $queryTrx = "UPDATE transaksi SET status_bayar = 'Verifikasi' WHERE id_transaksi = :id_trx";
        $this->db->query($queryTrx);
        $this->db->bind('id_trx', $id_trx);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function verifikasiPembayaran($id)
    {
        $query = "UPDATE transaksi SET status_bayar = 'Lunas' WHERE id_transaksi = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $query2 = "UPDATE pembayaran SET status_verifikasi = 'Valid' WHERE id_transaksi = :id";
        $this->db->query($query2);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function tolakPembayaran($id)
    {
        $query = "UPDATE transaksi SET status_bayar = 'Batal' WHERE id_transaksi = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        $query2 = "UPDATE pembayaran SET status_verifikasi = 'Invalid' WHERE id_transaksi = :id";
        $this->db->query($query2);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}