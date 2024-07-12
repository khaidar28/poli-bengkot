<?php
if (session_status() == PHP_SESSION_NONE) {
     session_start();
}
if (!isset($_SESSION['user'])) {
     header('location:index.php?page=masuk');
}
include('./koneksi.php');

$id_periksa = $_GET['id'];
$periksa_query = mysqli_query($mysqli, "SELECT p.*, pa.nama as 'nama_pasien', pa.alamat as 'alamat_pasien', pa.no_hp as 'no_hp_pasien', d.nama as 'nama_dokter', d.alamat as 'alamat_dokter', d.no_hp as 'no_hp_dokter' FROM periksa p JOIN pasien pa ON p.id_pasien = pa.id JOIN dokter d ON p.id_dokter = d.id WHERE p.id = '$id_periksa'");
$periksa = mysqli_fetch_array($periksa_query);

$obat_query = mysqli_query($mysqli, "SELECT o.nama_obat, o.harga FROM detail_periksa dp JOIN obat o ON dp.id_obat = o.id WHERE dp.id_periksa = '$id_periksa'");
$obat_list = [];
$total_obat = 0;
while ($obat = mysqli_fetch_array($obat_query)) {
     $obat_list[] = $obat;
     $total_obat += $obat['harga'];
}

$jasa_dokter = 150000;
$total = $total_obat + $jasa_dokter;
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Nota</title>
     <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
     <style>
          @media print {
               .print-hidden {
                    display: none !important;
               }
          }
     </style>
</head>

<body>
     <div class="container mt-5">
          <div class="row mb-4">
               <div class="col">
                    <h1>Nota Pembayaran</h1>
               </div>
          </div>
          <div class="row mb-2">
               <div class="col-md-6">
                    <p>Nomor Periksa:</p>
                    <p><strong>#<?php echo $periksa['id']; ?></strong></p>
               </div>
               <div class="col-md-6 text-right">
                    <p>Tanggal Periksa:</p>
                    <strong><?php echo $periksa['tgl_periksa']; ?></strong>
               </div>
          </div>
          <div class="row mb-4">
               <div class="col-md-6">
                    <p>Pasien:</p>
                    <p><strong><?php echo $periksa['nama_pasien']; ?></strong></p>
                    <p><strong><?php echo $periksa['alamat_pasien']; ?></strong></p>
                    <p><strong><?php echo $periksa['no_hp_pasien']; ?></strong></p>
               </div>
               <div class="col-md-6 text-right">
                    <p>Dokter:</p>
                    <p><strong><?php echo $periksa['nama_dokter']; ?></strong></p>
                    <p><strong><?php echo $periksa['alamat_dokter']; ?></strong></p>
                    <p><strong><?php echo $periksa['no_hp_dokter']; ?></strong></p>
               </div>
          </div>
          <div class="row mb-4">
               <div class="col-md-12">
                    <table class="table table-bordered">
                         <thead>
                              <tr>
                                   <th>Deskripsi</th>
                                   <th class="text-right">Harga</th>
                              </tr>
                         </thead>
                         <tbody>
                              <?php foreach ($obat_list as $obat) { ?>
                                   <tr>
                                        <td><?php echo $obat['nama_obat']; ?></td>
                                        <td class="text-right"><?php echo number_format($obat['harga'], 0, ',', '.'); ?></td>
                                   </tr>
                              <?php } ?>
                              <tr>
                                   <td>Jasa Dokter</td>
                                   <td class="text-right"><?php echo number_format($jasa_dokter, 0, ',', '.'); ?></td>
                              </tr>
                         </tbody>
                    </table>
               </div>
          </div>
          <div class="row mb-2">
               <div class="col-md-12 text-right">
                    <p>Jasa Dokter: <strong><?php echo number_format($jasa_dokter, 0, ',', '.'); ?></strong></p>
               </div>
          </div>
          <div class="row mb-2">
               <div class="col-md-12 text-right">
                    <p>Subtotal Obat: <strong><?php echo number_format($total_obat, 0, ',', '.'); ?></strong></p>
               </div>
          </div>
          <div class="row mb-5">
               <div class="col-md-12 text-right">
                    <p>Total: <strong><?php echo number_format($total, 0, ',', '.'); ?></strong></p>
               </div>
          </div>
          <div class="row print-hidden">
               <div class="col-md-12 text-center">
                    <button class="btn btn-primary" onclick="window.print()">Cetak</button>
               </div>
          </div>
     </div>
</body>

</html>