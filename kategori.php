<?php
require 'functions.php';
include 'header.php';
include 'sidebar.php';



$kategori = query("SELECT * FROM kategori");

if (isset($_POST["tambah"])) {

    //cek apakah date berhasil ditambahkan
    if (tambah($_POST) > 0) {
        echo "
    <script>
        alert('data berhasil ditambahkan');
        document.location.href='kategori.php';  
    </script> 
    ";
    } else {
        echo "
    <script>
        alert('data gagal ditambahkan');
        document.location.href='kategori.php';  
    </script>
        ";
    }
}
if (isset($_POST["edit"])) {

    //cek apakah date berhasil ditambahkan
    if (ubah($_POST) > 0) {
        echo "
        <script>
          alert('data berhasil Diubah');
          document.location.href='kategori.php';  
        </script> 
        ";
    } else {
        echo "
        <script>
          alert('data gagal Diubah');
          document.location.href='kategori.php';  
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
                    <h1 class="m-0 text-dark">Kategori</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Kategori</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <!-- /.content-header -->

        <!-- Main content -->
        <!-- ./row -->
        <div class="row">
            <div class="col-md-12 col-sm-6">
                <div class="card card-primary card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Jenis</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
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
                                                                <th>Kategori</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 1; ?>
                                                            <?php foreach ($kategori as $kt) : ?>
                                                                <tr>
                                                                    <td><?= $i; ?></td>
                                                                    <td><?= $kt["nama_kategori"]; ?></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit<?= $kt["id"]; ?>">Edit</a></button>
                                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $kt["id"]; ?>">Hapus</button>
                                                                    </td>
                                                                </tr>
                                                                <!-- Modal Ubah Data -->
                                                                <div class="modal fade" id="myModalEdit<?php echo $kt["id"]; ?>">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Edit Kategori</h4>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>

                                                                            <form action="" method="POST">
                                                                                <div class="modal-body">
                                                                                    <?php
                                                                                    $id = $kt['id'];
                                                                                    $query_edit = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
                                                                                    while ($row = mysqli_fetch_array($query_edit)) {
                                                                                    ?>
                                                                                        <input type="hidden" name="id" value="<?php echo $kt['id']; ?>">

                                                                                        <div class="form-group">
                                                                                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $kt['nama_kategori']; ?>" placeholder="Masukan Nama Kategori">
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


                                                                <!-- Modal Hapus Data -->
                                                                <div class="modal fade" id="modal-hapus<?= $kt["id"]; ?>">
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
                                            <h4 class="modal-title">Tambah Data Kategori</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="" method="POST">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukan Kategori">
                                                </div>
                                                <div class="modal-footer ml-auto">
                                                    <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-one-tabContent">
                                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                                        <section class="content">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTambahJenis"><i class="fa fa-plus"></i>Tambah</button>
                                                        </div>
                                                        <div class="card-body">
                                                            <table id="example1" class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr>
                                                                        <th>No</th>
                                                                        <th>Jenis</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php $i = 1; ?>
                                                                    <?php foreach ($kategori as $kt) : ?>
                                                                        <tr>
                                                                            <td><?= $i; ?></td>
                                                                            <td><?= $kt["nama_kategori"]; ?></td>
                                                                            <td>
                                                                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModalEdit<?= $kt["id"]; ?>">Edit</a></button>
                                                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $kt["id"]; ?>">Hapus</button>
                                                                            </td>
                                                                        </tr>
                                                                        <!-- Modal Ubah Data -->
                                                                        <div class="modal fade" id="myModalEdit<?php echo $kt["id"]; ?>">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h4 class="modal-title">Edit Kategori</h4>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>

                                                                                    <form action="" method="POST">
                                                                                        <div class="modal-body">
                                                                                            <?php
                                                                                            $id = $kt['id'];
                                                                                            $query_edit = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
                                                                                            while ($row = mysqli_fetch_array($query_edit)) {
                                                                                            ?>
                                                                                                <input type="hidden" name="id" value="<?php echo $kt['id']; ?>">

                                                                                                <div class="form-group">
                                                                                                    <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" value="<?php echo $kt['nama_kategori']; ?>" placeholder="Masukan Nama Kategori">
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


                                                                        <!-- Modal Hapus Data -->
                                                                        <div class="modal fade" id="modal-hapus<?= $kt["id"]; ?>">
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
                                    <div class="modal fade" id="modalTambahJenis">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Data Jenis</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="" method="POST">
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" id="nama_kategori" name="nama_kategori" placeholder="Masukan Kategori">
                                                        </div>
                                                        <div class="modal-footer ml-auto">
                                                            <button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- /.content -->
</div>
</div>
</div>
</div>



<?php include 'footer.php' ?>