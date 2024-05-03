<?php
include('./koneksi.php');
?>
<div class="container">
     <div class="row justify-content-center mt-5">
          <div class="col-md-6">
               <div class="card">
                    <div class="card-header text-center ">
                         <h2>Register</h2>
                    </div>
                    <div class="card-body">
                         <form action="" method="POST">
                              <div class="mb-3">
                                   <label for="username" class="form-label">Username</label>
                                   <input type="text" class="form-control" id="username" name="username" required>
                              </div>
                              <div class="mb-3">
                                   <label for="password" class="form-label">Password</label>
                                   <input type="password" class="form-control" id="password" name="password" required>
                              </div>
                              <div class="mb-3">
                                   <label for="password" class="form-label">Konfirmasi Password</label>
                                   <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                              </div>
                              <button type="submit" class="btn btn-primary">Register</button>
                         </form>
                    </div>
                    <div class="card-footer">
                         <p class="text-center mb-0">Sudah punya akun? <a href="index.php?page=masuk">Login</a></p>
                    </div>
               </div>
          </div>
     </div>
</div>


<?php
if (isset($_POST['username'])) {
     $username = $_POST['username'];
     $password = md5($_POST['password']);
     $confirm_password = md5($_POST['confirm_password']);

     // Validasi konfirmasi password
     if ($password !== $confirm_password) {
          echo "<script>alert('Password tidak sama');</script>";
     } else {
          // Periksa apakah username sudah ada di database
          $check_query = mysqli_query($mysqli, "SELECT * FROM user WHERE username='$username'");
          if (mysqli_num_rows($check_query) > 0) {
               echo "<script>alert('Username sudah digunakan. Silakan pilih username yang lain.');</script>";
          } else {
               // Username belum ada, tambahkan ke database
               $query = mysqli_query($mysqli, "INSERT INTO user (username, password) VALUES ('$username', '$password')");

               if ($query) {
                    echo "<script>alert('Berhasil silahkan login.'); window.location.href = 'index.php?page=masuk';</script>";
               } else {
                    echo "<script>alert('Gagal silahkan daftar lagi.'); window.location.href = 'index.php?page=daftar';</script>";
               }
          }
     }
}
?>