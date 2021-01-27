<?php
require 'functions.php';
include 'header.php';
include 'sidebar.php';



$utang = query("SELECT * FROM utang");

if (isset($_POST["tambah"])) {

    //cek apakah date berhasil ditambahkan
    if (tambahutang($_POST) > 0) {
        echo "
    <script>
        alert('data berhasil ditambahkan');
        document.location.href='utang.php';  
    </script> 
    ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan');
        document.location.href='utang.php';  
    </script>
        ";
    }
}
if (isset($_POST["edit"])) {

    //cek apakah date berhasil ditambahkan
    if (ubahutang($_POST) > 0) {
        echo "
        <script>
          alert('data berhasil Diubah');
          document.location.href='utang.php';  
        </script> 
        ";
    } else {
        echo "
        <script>
          alert('data gagal Diubah');
          document.location.href='utang.php';  
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
                    <h1 class="m-0 text-dark">Utang</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Utang</li>
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
                                        <th>Kode</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($utang as $ut) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $ut["kode"]; ?></td>
                                            <td><?= $ut["tanggal"]; ?></td>
                                            <td><?= $ut["keterangan"]; ?></td>
                                            <td><?= $ut["nominal"]; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit<?= $ut["id"]; ?>">Edit</a></button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">Hapus</button>
                                            </td>
                                        </tr>
                                        <!-- Modal add Data -->
                                        <div class="modal fade" id="myModalEdit<?php echo $ut["id"]; ?>">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Utang</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="" method="POST">
                                                        <div class="modal-body">
                                                            <?php
                                                            $id = $ut['id'];
                                                            $query_edit = mysqli_query($conn, "SELECT * FROM utang WHERE id='$id'");
                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                            ?>
                                                                <input type="hidden" name="id" value="<?php echo $ut['id']; ?>">

                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="kode" name="kode" value="<?php echo $ut['kode']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?php echo $ut['tanggal']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $ut['keterangan']; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <input type="text" class="form-control" id="nominal" name="nominal" value="<?php echo $ut['nominal']; ?>">
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
                        <h4 class="modal-title">Tambah Data Utang</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="text" class="form-control" id="kode" name="kode">
                            </div>
                            <div class="form-group">
                                <input type="date" class="form-control" id="tanggal" name="tanggal">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan Keterangan">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" id="nominal" name="nominal" placeholder="Masukan Nominal">
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
                        <h4 class="modal-title">Hapus Kategori</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <form action="" method="POST">
                        <div class="modal-footer ml-auto">
                            <a href="hapus.php?id=<?= $kt['id']; ?>" type="button" class="btn btn-danger">Hapus Data</i></a>
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