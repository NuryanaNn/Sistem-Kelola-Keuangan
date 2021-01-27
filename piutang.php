<?php
require 'functions.php';
include 'header.php';
include 'sidebar.php';



$transaksi = query("SELECT * FROM transaksi");

if (isset($_POST["tambah"])) {

    //cek apakah date berhasil ditambahkan
    if (tambahtransaksi($_POST) > 0) {
        echo "
    <script>
        alert('data berhasil ditambahkan');
        document.location.href='transaksi.php';  
    </script> 
    ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan');
        document.location.href='transaksi.php';  
    </script>
        ";
    }
}
if (isset($_POST["edit"])) {

    //cek apakah date berhasil ditambahkan
    if (ubahtransaksi($_POST) > 0) {
        echo "
        <script>
          alert('data berhasil Diubah');
          document.location.href='transaksi.php';  
        </script> 
        ";
    } else {
        echo "
        <script>
          alert('data gagal Diubah');
          document.location.href='transaksi.php';  
        </script>
          ";
    }
}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Transaksi</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Transaksi</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modal-default"><i class="fa fa-plus"></i>Tambah</button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Kategori</th>
                                        <th>Keterangan</th>
                                        <th>Jenis</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($transaksi as $tr) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $tr["tanggal"]; ?></td>
                                            <td><?= $tr["kategori"]; ?></td>
                                            <td><?= $tr["keterangan"]; ?></td>
                                            <td><?= $tr["jenis"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit<?= $tr["id"]; ?>">Edit</a></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">Hapus</button>
                                            </td>
                                        </tr>
                                        <!-- Modal add Data -->
                                        <div class="modal fade" id="myModalEdit<?php echo $tr["id"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Transaksi</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <?php
                                                            $id = $tr['id'];
                                                            $query_edit = mysqli_query($conn, "SELECT * FROM transaksi WHERE id='$id'");
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>
                                                                <input type="hidden" name="id" value="<?php echo $tr['id']; ?>">

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $tr['tanggal']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?php echo $tr['kategori']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $tr['keterangan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="jenis" name="jenis" value="<?php echo $tr['jenis']; ?>">
                                                                </div>

                                                                <div class="modal-footer ml-auto">
                                                                    <button type="submit" name="edit" class="btn btn-primary">Ubah</button>
                                                                </div>
                                                        </div>
                                                    </form>
                                                <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php $i++ ?>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Tambah Data Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Masukan Tanggal">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="jenis" name="jenis" placeholder="Masukan Jenis">
                            </div>
                            <div class="modal-footer ml-auto">
                                <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- Modal add Data -->
        <div class="modal fade" id="modal-hapus">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hapus Transaksi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST">
                        <div class="modal-footer ml-auto">
                            <a href="hapus.php?id=<?= $tr['id']; ?>" type="button" class="btn btn-danger">Hapus Data</i></a>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->
</div>
</div>
</div>
</div>



<?php include 'footer.php' ?>