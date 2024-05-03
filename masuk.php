    <?php
     include('./koneksi.php'); ?>
    <div class="container">
         <div class="row justify-content-center mt-5">
              <div class="col-md-6">
                   <div class="card">
                        <div class="card-header text-center">
                             <h2>Login</h2>
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
                                  <button type="submit" class="btn btn-primary">Login</button>
                             </form>
                        </div>
                        <div class="card-footer">
                             <p class="text-center mb-0">Belum punya akun? <a href="index.php?page=daftar">Register</a></p>
                        </div>
                   </div>
              </div>
         </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>

    <?php
     if (isset($_POST['username'])) {
          $username = $_POST['username'];
          $password = md5($_POST['password']);

          $query = mysqli_query($mysqli, "SELECT*FROM user where username='$username'AND password='$password'");

          if (mysqli_num_rows($query) > 0) {
               $data = mysqli_fetch_array($query);
               $_SESSION['user'] = $data;
               echo '<script>alert("Selamat berhasil login ' . $data['username'] . '"); window.location.href = "index.php";</script>';
          } else {
               echo "<script>alert('Login gagal, Username/Password salah');</script>";
          }
     }
     ?>