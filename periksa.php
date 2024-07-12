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
     $id_pasien = '';
     $id_dokter = '';
     $tgl_periksa = '';
     $catatan = '';

     if (isset($_GET['id'])) {
          $ambil = mysqli_query($mysqli, "SELECT * FROM periksa WHERE id='" . $_GET['id'] . "'");
          while ($row = mysqli_fetch_array($ambil)) {
               $id_pasien = $row['id_pasien'];
               $id_dokter = $row['id_dokter'];
               $tgl_periksa = $row['tgl_periksa'];
               $catatan = $row['catatan'];
          }
          echo '<input type="hidden" name="id" value="' . $_GET['id'] . '">';
     }
     ?>
     <div class="col-sm-12 mb-2">
          <label for="inputPasien" class="form-label fw-bold">Pasien</label>
          <select class="form-select" name="id_pasien">
               <?php
               $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
               while ($data = mysqli_fetch_array($pasien)) {
                    $selected = $data['id'] == $id_pasien ? 'selected' : '';
                    echo "<option value='{$data['id']}' $selected>{$data['nama']}</option>";
               }
               ?>
          </select>
     </div>
     <div class="col-sm-12 mb-2">
          <label for="inputDokter" class="form-label fw-bold">Dokter</label>
          <select class="form-select" name="id_dokter">
               <?php
               $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
               while ($data = mysqli_fetch_array($dokter)) {
                    $selected = $data['id'] == $id_dokter ? 'selected' : '';
                    echo "<option value='{$data['id']}' $selected>{$data['nama']}</option>";
               }
               ?>
          </select>
     </div>
     <div class="col-sm-12 mb-2">
          <label for="tgl_periksa" class="form-label fw-bold">Tanggal Periksa</label>
          <input type="datetime-local" class="form-control" name="tgl_periksa" id="tgl_periksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa ?>">
     </div>
     <div class="col-sm-12 mb-2">
          <label for="catatan" class="form-label fw-bold">Catatan</label>
          <input type="text" class="form-control" name="catatan" id="catatan" placeholder="Catatan" value="<?php echo $catatan ?>">
     </div>
     <div class="col-sm-12 mb-2">
          <div class="form-group">
               <label for="obat" class="form-label fw-bold">Obat</label>
               <select id="obat" name="id_obat[]" class="form-control" multiple="multiple">
                    <?php
                    $obat_query = mysqli_query($mysqli, "SELECT * FROM obat");
                    while ($data = mysqli_fetch_array($obat_query)) {
                         $selected = ''; // Adjust selection logic if needed
                         echo "<option value='" . $data['id'] . "' $selected>" . $data['nama_obat'] . "</option>";
                    }
                    ?>
               </select>
          </div>
     </div>
     <div class="col">
          <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
     </div>
</form>

<?php
$result = mysqli_query($mysqli, "SELECT pr.*, d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY pr.tgl_periksa DESC");
$no = 1;
?>
<table class="table table-hover table-responsive">
     <thead>
          <tr>
               <th class="text-center alig-items-center">No</th>
               <th class="text-center alig-items-center">Pasien</th>
               <th class="text-center alig-items-center">Dokter</th>
               <th class="text-center alig-items-center">Tanggal</th>
               <th class="text-center alig-items-center">Catatan</th>
               <th class="text-center alig-items-center">Obat</th>
               <th class="text-center alig-items-center">Aksi</th>
          </tr>
     </thead>
     <tbody>
          <?php
          while ($data = mysqli_fetch_array($result)) {
               // Fetch obat details
               $obat_result = mysqli_query($mysqli, "SELECT o.nama_obat FROM detail_periksa dp JOIN obat o ON dp.id_obat = o.id WHERE dp.id_periksa = " . $data['id']);
               $obat_names = [];
               while ($obat_data = mysqli_fetch_array($obat_result)) {
                    $obat_names[] = $obat_data['nama_obat'];
               }
               $obat_list = implode(', ', $obat_names);
          ?>
               <tr>
                    <td class="text-center alig-items-center"><?php echo $no++ ?></td>
                    <td class="text-center alig-items-center"><?php echo $data['nama_pasien'] ?></td>
                    <td class="text-center alig-items-center"><?php echo $data['nama_dokter'] ?></td>
                    <td class="text-center alig-items-center"><?php echo $data['tgl_periksa'] ?></td>
                    <td class="text-center alig-items-center"><?php echo $data['catatan'] ?></td>
                    <td class="text-center alig-items-center w-25"><?php echo $obat_list ?></td>
                    <td class="text-center alig-items-center">
                         <a class="btn btn-sm btn-success rounded-pill px-2" href="index.php?page=periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                         <a class="btn btn-sm btn-danger rounded-pill px-2" href="index.php?page=periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                         <a class="btn btn-sm btn-info rounded-pill px-2" href="nota.php?id=<?php echo $data['id'] ?>" target="_blank">Nota</a>
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
          $ubah = mysqli_query($mysqli, "UPDATE periksa SET 
                                        id_pasien = '" . $_POST['id_pasien'] . "',
                                        id_dokter = '" . $_POST['id_dokter'] . "',
                                        tgl_periksa = '" . $_POST['tgl_periksa'] . "',
                                        catatan = '" . $_POST['catatan'] . "'
                                        WHERE id = '" . $_POST['id'] . "'");

          $id_periksa = $_POST['id'];
          // Delete existing obat records for the periksa
          mysqli_query($mysqli, "DELETE FROM detail_periksa WHERE id_periksa = '$id_periksa'");
          // Insert new obat records
          foreach ($_POST['id_obat'] as $id_obat) {
               mysqli_query($mysqli, "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$id_obat')");
          }
     } else {
          $tambah = mysqli_query($mysqli, "INSERT INTO periksa(id_pasien,id_dokter,tgl_periksa,catatan) 
                                        VALUES ( 
                                            '" . $_POST['id_pasien'] . "',
                                            '" . $_POST['id_dokter'] . "',
                                            '" . $_POST['tgl_periksa'] . "',
                                            '" . $_POST['catatan'] . "'
                                            )");
          $id_periksa = mysqli_insert_id($mysqli);
          // Insert obat records
          foreach ($_POST['id_obat'] as $id_obat) {
               mysqli_query($mysqli, "INSERT INTO detail_periksa (id_periksa, id_obat) VALUES ('$id_periksa', '$id_obat')");
          }
     }

     echo "<script> 
            document.location='index.php?page=periksa';
            </script>";
}

if (isset($_GET['aksi'])) {
     if ($_GET['aksi'] == 'hapus') {
          $id_periksa = $_GET['id'];
          // Delete obat records
          mysqli_query($mysqli, "DELETE FROM detail_periksa WHERE id_periksa = '$id_periksa'");
          // Delete periksa record
          mysqli_query($mysqli, "DELETE FROM periksa WHERE id = '$id_periksa'");
     }
     echo "<script> 
            document.location='index.php?page=periksa';
            </script>";
}
?>