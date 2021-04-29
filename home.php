<?php
  include('koneksi.php'); //agar index terhubung dengan database, maka koneksi sebagai penghubung harus di include
  $conn = mysqli_connect($host,$user,$pass,$nama_db);
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Perpustakaan Sekolah</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <nav class="navbar navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">
        <img src="logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Perpustakaan Sekolah
      </a>
    </div>
  </nav>
      <div class="container">
          <div class="tittle mt-5">
            <center><h1>Data Buku Perpustakaan</h1><center>
          </div>  

        <div class="row mt-5">
            <div class="col-md-6">
              <div class="search mt-4">
                <form class="mt-4" method="GET" action="index.php">
                    <label>Kata Pencarian : </label>
                    <input type="text" name="cari kata" value="">
                    <button class="btn btn-light" type="submit">Cari</button>
                </form>
              </div>
            </div>
            <div class="col-md-2 mt-3 ml-auto">
              <div class="ml-5 button">
                <a class="btn btn-light" href="tambah_buku.php">+ &nbsp; Tambah Buku</a>
              </div>
            </div>
        </div>

        
        <br/>

          <div class="d-flex flex-wrap mt-5">
            <?php
            // jalankan query untuk menampilkan semua data diurutkan berdasarkan nim
            $query = "SELECT * FROM produk ORDER BY id ASC";
            $result = mysqli_query($koneksi, $query);
            //mengecek apakah ada error ketika menjalankan query
            if(!$result){
              die ("Query Error: ".mysqli_errno($koneksi).
                " - ".mysqli_error($koneksi));
            }

            //buat perulangan untuk element tabel dari data mahasiswa
            // hasil query akan disimpan dalam variabel $data dalam bentuk array
            // kemudian dicetak dengan perulangan while
            $query = mysqli_query($conn, "SELECT * FROM produk");
            if (isset($_GET['cari_kata'])){
              $query = mysqli_query($conn, "SELECT * FROM produk WHERE judul LIKE '%".
              $_GET['cari_kata']."%'");
            }

            while($row = mysqli_fetch_assoc($query))
            {
            ?>

              <div class="content col-md-4">
                <div class="card mb-3" style="max-width: 540px;">
                  <div class="row g-0">
                    <div class="col-md-4">
                      <img src="gambar/<?php echo $row['gambar_buku']; ?>" style="width: 120px; height: 200px"  alt="...">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <h5 class="card-title"><?php echo $row['judul']; ?></h5>
                        <p class="card-text"><?php echo substr($row['deskripsi'], 0, 50); ?>...</p>
                        <p class="card-text"><small class="text-muted"><?php echo $row['pengarang']; ?></small></p>
                        <a href="edit_buku.php?id=<?php echo $row['id']; ?>">Edit</a> |
                        <a href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              
              
            <?php
              
            }
            ?>
            </div>

      </div>
  </body>
</html>