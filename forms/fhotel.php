<!-- MODAL TAMBAH KAMAR -->
<div class="modal fade" id="tambahkamar">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Tambah Kamar</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <form method="POST" action="../proses/photel.php">
        <div class="modal-body">
            <input type="text" name="room" class="form-control" placeholder="No Kamar">
            <input type="text" name="type_room" class="form-control mt-2" placeholder="Type Kamar">
            <input type="number" name="price_room" class="form-control mt-2" placeholder="Harga">
        </div>

        <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="tambahkamar">Submit</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- FORM BOOKING -->
<div class="modal fade" id="booking">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Booking <?= $room ?></h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <form method="POST" action="../proses/photel.php">
        <div class="modal-body">
            <input type="text" name="customer_name" class="form-control mb-2" placeholder="Nama">
            
            <!-- Pilih Kamar -->
                    <select name="room_id" class="form-select mb-2">

                    <?php
                    $rooms = $conn->query("SELECT * FROM rooms WHERE status='available'");
                    while($r = $rooms->fetch_assoc()):
                    ?>

                    <option value="<?= $r['id'] ?>"><?= $r['room'] ?> (<?= $r['type_room'] ?>)</option>

                    <?php
                    endwhile;
                    ?>
                    </select>

                <!-- Check In -->
            <div class="row mb-2">
                <div class="col-md-6">Tanggal Check-in:
                    <input type="date" name="check_in_date" class="form-control" placeholder="Tanggal Cek In">
                </div>
                <div class="col-md-6">Jam:
                    <input type="time" name="check_in_time" class="form-control" placeholder="Jam Cek In">
                </div>
            </div>

            <!-- Check Out -->
            <div class="row mb-2">
                <div class="col-md-6">Tanggal Check Out:
                    <input type="date" name="check_out_date" class="form-control" placeholder="Tanggal Cek Out">
                </div>
                <div class="col-md-6">Jam:
                    <input type="time" name="check_out_time" class="form-control" placeholder="Jam Cek Out">
                </div>
            </div>
    
        </div>

        <!-- Modal footer -->
      <div class="modal-footer">
          <button type="submit" class="btn btn-success" name="bookingkamar">Submit</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- Animasi Centang Berhasil -->
<div id="successCheck" style="display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); z-index:1050;">
  <div style="background:white; padding:30px; border-radius:20px; text-align:center; box-shadow:0 0 20px rgba(0,0,0,0.2);">
    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" class="bi bi-check-circle-fill mb-2" viewBox="0 0 16 16">
      <path d="M16 8a8 8 0 1 1-16 0A8 8 0 0 1 16 8zM6.97 10.03a.75.75 0 0 0 1.07 0l3.992-3.992a.75.75 0 1 0-1.06-1.06L7.5 8.439 5.53 6.47a.75.75 0 0 0-1.06 1.061L6.97 10.03z"/>
    </svg>
    <div><strong>Booking Berhasil!</strong></div>
  </div>
</div>


<!-- MODAL VIEW TABLE-->
<div class="modal fade" id="view">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">View</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal Body -->
      <form method="POST" action="../proses/photel.php">
        <div class="modal-body">
          <input type="text" name="nama" class="form-control" placeholder="Nama">
          <input type="text" name="room_number" class="form-control mt-2" placeholder="No Kamar">
          <input type="text" name="type" class="form-control mt-2" placeholder="Type Kamar">
          <input type="number" name="price" class="form-control mt-2" placeholder="Harga">
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" name="bookingkamar">Submit</button>
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



