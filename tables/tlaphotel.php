<!--begin::App Content-->
<div class="app-content">
  <!--begin::Container-->
  <div class="container-fluid">
    <!--begin::Row-->
    <div class="row">
  <div class="col">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Daftar Kamar</h3>

        <!-- Tombol Ekspor PDF -->
        <form action="export_pdf.php" method="POST" target="_blank" class="position-absolute top-0 end-0 mt-2 me-2">
          <input type="hidden" name="filter" value="<?= isset($_POST['filter']) ? htmlspecialchars($_POST['filter']) : 'daily' ?>">
          <button type="submit" class="btn btn-danger btn-sm"><i class="bi bi-file-earmark-pdf"></i> Ekspor ke PDF</button>
        </form>


      </div>
          <!-- Filter Form -->
          <div class="card-body">
            <form method="POST" class="mb-3">
              <div class="row g-3 align-items-center">
                <div class="col-auto">
                  <label for="filter" class="col-form-label">Filter:</label>
                </div>
                <div class="col-auto">
                  <select name="filter" id="filter" class="form-select" onchange="this.form.submit()">
                    <option value="daily" <?= isset($_POST['filter']) && $_POST['filter'] == 'daily' ? 'selected' : '' ?>>Harian</option>
                    <option value="weekly" <?= isset($_POST['filter']) && $_POST['filter'] == 'weekly' ? 'selected' : '' ?>>Mingguan</option>
                    <option value="monthly" <?= isset($_POST['filter']) && $_POST['filter'] == 'monthly' ? 'selected' : '' ?>>Bulanan</option>
                    <option value="yearly" <?= isset($_POST['filter']) && $_POST['filter'] == 'yearly' ? 'selected' : '' ?>>Tahunan</option>
                  </select>
                </div>
              </div>
            </form>

            <!-- Tabel -->
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Kamar</th>
                  <th>Check-in</th>
                  <th>Check-out</th>
                  <th>Harga</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $conn = mysqli_connect('localhost', 'root', '', 'meliwis');
                  if (!$conn) {
                    die("Koneksi gagal: " . mysqli_connect_error());
                  }

                  $filter = isset($_POST['filter']) ? $_POST['filter'] : 'daily';

                  switch ($filter) {
                    case 'daily':
                      $where = "DATE(b.check_in) = CURDATE()";
                      break;
                    case 'weekly':
                      $where = "YEARWEEK(b.check_in, 1) = YEARWEEK(CURDATE(), 1)";
                      break;
                    case 'monthly':
                      $where = "MONTH(b.check_in) = MONTH(CURDATE()) AND YEAR(b.check_in) = YEAR(CURDATE())";
                      break;
                    case 'yearly':
                      $where = "YEAR(b.check_in) = YEAR(CURDATE())";
                      break;
                    default:
                      $where = "1";
                      break;
                  }

                  $sql = "SELECT b.*, r.room, r.price_room
                          FROM bookings b 
                          JOIN rooms r ON b.room_id = r.id 
                          WHERE $where 
                          ORDER BY b.check_in DESC";

                  $report = $conn->query($sql);
                  $total = 0;

                  if ($report && $report->num_rows > 0) {
                    while ($r = $report->fetch_assoc()):
                ?>
                      <tr>
                        <td><?= htmlspecialchars($r['customer_name']) ?></td>
                        <td><?= htmlspecialchars($r['room']) ?></td>
                        <td><?= htmlspecialchars($r['check_in']) ?></td>
                        <td><?= htmlspecialchars($r['check_out']) ?></td>
                        <td>Rp <?= number_format($r['price_room'], 0, ',', '.') ?></td>
                      </tr>
                      <?php $total += $r['price_room']; ?>
                <?php
                    endwhile;
                  } else {
                    echo "<tr><td colspan='5' class='text-center'>Tidak ada data</td></tr>";
                  }
                ?>
              </tbody>
            </table>

             <!-- Total Pemasukan -->
              <div class="alert alert-success d-flex align-items-center justify-content-between mt-4" role="alert" style="font-size: 1.2rem;">
                <div class="d-flex align-items-center">
                  <i class="bi bi-cash-coin me-2" style="font-size: 1.5rem;"></i>
                  <strong>Total Pemasukan:</strong>
                </div>
                <span>Rp <?= number_format($total, 0, ',', '.') ?></span>
              </div>
            
          </div>

          <!-- Footer Pagination (jika kamu pakai pagination manual) -->
          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-end">
              <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
            </ul>
          </div>
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->
