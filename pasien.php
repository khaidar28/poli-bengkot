<?php
if (session_status() == PHP_SESSION_NONE) {
     session_start();
}
if (!isset($_SESSION['user'])) {
     header('location:index.php?page=masuk');
}
include('./koneksi.php');
?>
<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
     <?php
     $nama = '';
     $alamat = '';
     $no_hp = '';
     if (isset($_GET['id'])) {
          $ambil = mysqli_query(
               $mysqli,
               "SELECT * FROM pasien 
        WHERE id='" . $_GET['id'] . "'"
          );
          while ($row = mysqli_fetch_array($ambil)) {
               $nama = $row['nama'];
               $alamat = $row['alamat'];
               $no_hp = $row['no_hp'];
          }
     ?>
          <input type="hidden" name="id" value="<?php echo
                                                  $_GET['id'] ?>">
     <?php
     }
     ?>
     <div class="row">
          <div class="col-sm-12">
               <label for="nama" class="form-label fw-bold">
                    Nama pasien
               </label>
               <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama ?>">
          </div>
          <div class="col-sm-12">
               <label for="alamat" class="form-label fw-bold">
                    Alamat pasien
               </label>
               <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat pasien" value="<?php echo $alamat ?>">
          </div>
          <div class="col-sm-12 mb-2">
               <label for="no_hp" class="form-label fw-bold">
                    No hp
               </label>
               <input type="text" class="form-control" name="no_hp" id="no_hp" placeholder="No hp " value="<?php echo $no_hp ?>">
          </div>
          <div class="col">
               <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
          </div>
     </div>
</form>

<?php
$result = mysqli_query($mysqli, "SELECT * FROM pasien");
$no = 1;
?>
<table class="table table-hover">
     <!--thead atau baris judul-->
     <thead>
          <tr>
               <th scope="col">No</th>
               <th scope="col">Nama</th>
               <th scope="col">Alamat</th>
               <th scope="col">No hp</th>
               <th scope="col">Aksi</th>
          </tr>
     </thead>
     <!--tbody berisi isi tabel sesuai dengan judul atau head-->
     <tbody>
          <?php
          while ($data = mysqli_fetch_array($result)) {
          ?>
               <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['alamat'] ?></td>
                    <td><?php echo $data['no_hp'] ?></td>
                    <td>
                         <a class="btn btn-success rounded-pill px-3" href="index.php?page=pasien&id=<?php echo $data['id'] ?>">Ubah</a>
                         <a class="btn btn-danger rounded-pill px-3" href="index.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
               </tr>
          <?php
          }
          ?>
     </tbody>
</table>

<?php
if (isset($_POST['simpan'])) {
     if (isset($_POST['id'])) {
          $ubah = mysqli_query($mysqli, "UPDATE pasien SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
     } else {
          $tambah = mysqli_query($mysqli, "INSERT INTO pasien(nama,alamat,no_hp) 
                                        VALUES ( 
                                            '" . $_POST['nama'] . "',
                                            '" . $_POST['alamat'] . "',
                                            '" . $_POST['no_hp'] . "'
                                            )");
     }

     echo "<script> 
            document.location='index.php?page=pasien';
            </script>";
}

if (isset($_GET['aksi'])) {
     if ($_GET['aksi'] == 'hapus') {
          $hapus = mysqli_query($mysqli, "DELETE FROM pasien WHERE id = '" . $_GET['id'] . "'");
     }
     echo "<script> 
            document.location='index.php?page=pasien';
            </script>";
}
?>