<?php
require_once('../config/helper.php');
require_once('../config/koneksi.php');

if (isset($_POST['tambahkamar'])) {
    $no = $_POST['room'];
    $type = $_POST['type_room'];
    $price = $_POST['price_room'];

    $stmt = $conn->prepare("INSERT INTO rooms (room, type_room, price_room) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $no, $type, $price);

    if ($stmt->execute()) {
        header("Location: " . BASE_URL . "pages/hotel.php?page=admin");
        exit();
    } else {
        echo "Gagal menambahkan kamar: " . $stmt->error;
    }

    $stmt->close();
}
?>

<?php
require_once('../config/helper.php');
require_once('../config/koneksi.php');

// Ambil kamar yang tersedia (jika diperlukan untuk ditampilkan)
$rooms = $conn->query("SELECT * FROM rooms WHERE status='available'");

// Proses ketika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['booking'])) {
    $name        = $_POST['customer_name'];
    $ktp         = $_POST['ktp'];
    $room_id     = $_POST['id']; // Pastikan hidden input `id` dikirim dari form
    $check_in    = $_POST['check_in_date'] . ' ' . $_POST['check_in_time'] . ':00';
    $check_out   = $_POST['check_out_date'] . ' ' . $_POST['check_out_time'] . ':00';

    // Validasi sederhana
    if (empty($name) || empty($ktp) || empty($room_id) || empty($check_in) || empty($check_out)) {
        echo "❌ Semua field wajib diisi!";
        exit();
    }

    // Simpan ke tabel bookings
    $stmt = $conn->prepare("INSERT INTO bookings (customer_name, ktp, room_id, check_in, check_out) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $name, $ktp, $room_id, $check_in, $check_out);

    if ($stmt->execute()) {
        // Update status kamar jadi 'booked'
        $stmt2 = $conn->prepare("UPDATE rooms SET status='booked' WHERE id=?");
        $stmt2->bind_param("i", $room_id);
        $stmt2->execute();
        $stmt2->close();

        // Redirect ke halaman hotel.php dengan parameter sukses
        header("Location: " . BASE_URL . "pages/hotel.php?page=admin&success=true");
        exit();
    } else {
        echo "❌ Gagal menambahkan pemesanan: " . $stmt->error;
    }

    $stmt->close();
}
?>








