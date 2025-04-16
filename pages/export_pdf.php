<?php
require_once '../dompdf/autoload.inc.php';
use Dompdf\Dompdf;

// Koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'meliwis');
if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}

// Ambil filter dari POST
$filter = isset($_POST['filter']) ? $_POST['filter'] : 'daily';

// Tentukan kondisi WHERE berdasarkan filter
switch ($filter) {
  case 'daily':
    $where = "DATE(b.check_in) = CURDATE()";
    $judul = "Laporan Harian";
    break;
  case 'weekly':
    $where = "YEARWEEK(b.check_in, 1) = YEARWEEK(CURDATE(), 1)";
    $judul = "Laporan Mingguan";
    break;
  case 'monthly':
    $where = "MONTH(b.check_in) = MONTH(CURDATE()) AND YEAR(b.check_in) = YEAR(CURDATE())";
    $judul = "Laporan Bulanan";
    break;
  case 'yearly':
    $where = "YEAR(b.check_in) = YEAR(CURDATE())";
    $judul = "Laporan Tahunan";
    break;
  default:
    $where = "1";
    $judul = "Laporan Semua Data";
    break;
}

// Ambil data
$sql = "SELECT b.*, r.room, r.price_room
        FROM bookings b 
        JOIN rooms r ON b.room_id = r.id 
        WHERE $where 
        ORDER BY b.check_in DESC";

$result = $conn->query($sql);
$total = 0;

// Buat HTML
$html = '
  <h2 style="text-align:center; margin-bottom: 20px;">' . $judul . '</h2>
  <table border="1" cellpadding="8" cellspacing="0" width="100%">
    <thead style="background-color:#f0f0f0;">
      <tr>
        <th>Nama</th>
        <th>Kamar</th>
        <th>Check-in</th>
        <th>Check-out</th>
        <th>Harga</th>
      </tr>
    </thead>
    <tbody>';

if ($result && $result->num_rows > 0) {
  while ($r = $result->fetch_assoc()) {
    $html .= '<tr>
                <td>' . htmlspecialchars($r['customer_name']) . '</td>
                <td>' . htmlspecialchars($r['room']) . '</td>
                <td>' . htmlspecialchars($r['check_in']) . '</td>
                <td>' . htmlspecialchars($r['check_out']) . '</td>
                <td>Rp ' . number_format($r['price_room'], 0, ',', '.') . '</td>
              </tr>';
    $total += $r['price_room'];
  }
} else {
  $html .= '<tr><td colspan="5" align="center">Tidak ada data</td></tr>';
}

$html .= '
    </tbody>
  </table>
  <h3 style="text-align:right; margin-top: 20px;">Total Pemasukan: <span style="color:green;">Rp ' . number_format($total, 0, ',', '.') . '</span></h3>
';

// Export PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream("laporan_hotel_$filter.pdf", ['Attachment' => 0]);
