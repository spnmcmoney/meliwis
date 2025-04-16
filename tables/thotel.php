<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col">
                <div class="card mb-4">
                    <div class="card-header"><h3 class="card-title">Daftar Kamar</h3></div>
                        <!-- /.card-header -->
                        
                        <button type="submit" data-bs-toggle="modal" data-bs-target="#tambahkamar" class="btn btn-danger btn-sm position-absolute top-0 end-0 mt-2 me-2">
                            Tambah Kamar
                        </button>
                        
                        <!-- MENAMPILKAN TABEL -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No Kamar</th>
                                        <th>Nama Paket</th>
                                        <th>Harga Paket</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php
                                    $conn = mysqli_connect('localhost', 'root', '', 'meliwis');
                                    $get = mysqli_query($conn,"select * from rooms");

                                    while ($r=mysqli_fetch_array($get)){
                                        $idroom = $r['id'];
                                        $room = $r['room'];
                                        $type_room = $r['type_room'];
                                        $price_room = $r['price_room'];
                                        $status = $r['status'];
                                    ?>

                                    <tr>
                                        <td><?= $room ?></td>
                                        <td><?= $type_room ?></td>
                                        <td>Rp <?= number_format($price_room) ?></td>
                                        <td><?= $status ?></td>
                                        <td>
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#booking<?=$idroom;?>">
                                                Booking
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>

                                    <!-- MODAL BOOKING -->
                                    <div class="modal fade" id="booking<?=$idroom;?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Booking <?=$room;?></h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <form method="POST" action="../proses/photel.php">
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <input type="text" name="customer_name" class="form-control mb-2" placeholder="Nama">
                                                <input type="text" name="ktp" class="form-control mb-2" placeholder="No KTP Identitas">
                                                
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

                                                <input type="hidden" name="id" value=<?=$idroom;?>>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success" name="booking">Submit</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                            </div>
                                        </div>
                                        </div>

                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    
            </div>
                <!-- /.card -->
        </div>
              <!-- /.col -->
    </div>
            <!--end::Row-->
</div>      
<!--end::Container-->

