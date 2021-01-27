<?php
require 'functions.php';

$id = $_GET["id"];

if (hapustransaksi($id) > 0) {
    echo "
            <script>
                alert('Data Berhasil Dihapus');
                document.location.href='transaksi.php';
                </script>
            ";
} else {
    echo "
                <script>
                alert('Data Berhasil Dihapus');
                document.location.href='transaksi.php';
                </script>
                ";
}
