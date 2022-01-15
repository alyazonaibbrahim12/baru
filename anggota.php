<?php
// Proses Update Data
if (isset($_GET['update'])) {
  include('koneksi.php');
  $id         = $_GET['id'];
  $nis        = $_GET['nis'];
  $nama       = $_GET['nama'];
  $kelas      = $_GET['kelas'];
  $jurusan    = $_GET['jurusan'];
  $tgl_lahir  = $_GET['tanggal_lahir'];
  $tlp        = $_GET['no_telepon'];
  $alamat     = $_GET['alamat'];
  $jk         = $_GET['jenis_kelamin'];

  $query_update = mysqli_query($koneksi,"UPDATE anggota 
  SET nis ='$nis',
      nama = '$nama',
      kelas = '$kelas',
      jurusan = '$jurusan',
      tanggal_lahir = '$tgl_lahir',
      no_telepon = '$tlp',
      alamat = '$alamat',
      jenis_kelamin = '$jk'
      WHERE id_anggota = '$id'
      ");

  if ($query_update) {
    ?>
    <script>
        alert('Data berhasil di update!!!!!!');
        window.location.href='http://localhost/04_alyazona_12rpl2/admin.php?page=anggota';
    </script>
    <?php
    //header('Refresh:2; URL=http://localhost/04_mywebsite_12rpl2/admin.php?page=anggota');
  }
}
// Proses Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $query_delete = mysqli_query($koneksi,"DELETE FROM anggota WHERE id_anggota = '$id'");

    //Jika query delete berhasil maka munculkan notifikasi dan refresh halaman
    if ($query_delete) {
        ?>
        <script>
            alert("DATA BERHASIL DI HAPUS");
            window.location.href='http://localhost/04_alyazona_12rpl2/admin.php?page=anggota';
        </script>
        <?php
        //header('Refresh:2; URL=http://localhost/04_mywebsite_12rpl2/admin.php?page=anggota');
        
    }
}
// end of proses delete

// Proses Insert Tambah Data
if(isset($_POST['simpan']))
{
    $nis        = $_POST['nis'];
    $nama       = $_POST['nama'];
    $kelas      = $_POST['kelas'];
    $jurusan    = $_POST['jurusan'];
    $tgl_lahir  = $_POST['tanggal_lahir'];
    $tlp        = $_POST['no_telepon'];
    $alamat     = $_POST['alamat'];
    $jk         = $_POST['jenis_kelamin'];

    $query_insert = mysqli_query($koneksi,"INSERT INTO anggota 
    VALUES('','$nis','$nama','$kelas','$jurusan','$tgl_lahir','$tlp','$alamat',
    '$jk')");
    
    // Membuat notifikasi jika berhasil/tidak disimpan datanya
    if($query_insert) 
    {
        ?>
            <div class="alert alert-success">
                Data Berhasil Disimpan !!!
            </div>
        <?php
        header('Refresh:2; URL=http://localhost/04_alyazona_12rpl2/admin.php?page=anggota');
    }
    else
    {
        ?>
            <div class="alert alert-danger">
                Data GAGAL Disimpan !!!
            </div>
        <?php
    }

}
//
?>
<center><h4 class="mt-4 mb-3">Data Anggota</h4></center>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#inputdata">
    Tambah Data
</button>
<!-- ------------------------------------------------------------------------------------- -->
<table class="table table-striped table-hover">
    <tr>
        <th>NO</th>
        <th>NIS</th>
        <th>NAMA</th>
        <th>KELAS</th>
        <th>JURUSAN</th>
        <th>TGL LAHIR</th>
        <th>TELEPON</td>
        <th>ALAMAT</th>
        <th>GENDER</th>
        <th>--Action--</th>
    </tr>
    <?php
        $query = mysqli_query($koneksi,"SELECT * FROM anggota");
        $no = 1;
        foreach ($query as $row) {
    ?>
    <tr>
        <td align="center" valign="middle"><?php echo $no; ?></td>
        <td valign="middle"><?php echo $row['nis']; ?></td>
        <td valign="middle"><?php echo $row['nama']; ?></td>
        <td valign="middle"><?php echo $row['kelas']; ?></td>
        <td valign="middle">
        <?php
            if ($row['jurusan']=='RPL') {
                echo "Rekayasa Perangkat Lunak";
            }elseif($row['jurusan']=='TAV'){
                echo "Teknik Audio Video";
            }elseif($row['jurusan']=='TKR'){
                echo "Teknik Kendaraan Ringan";
            }else{
                echo "Teknik Instalasi Tenaga Listrik";
            }
        ?>
            <?php echo $row['jurusan']; ?>
        </td>
        <td valign="middle"><?php echo $row['tanggal_lahir']; ?></td>
        <td valign="middle"><?php echo $row['no_telepon']; ?></td>
        <td valign="middle"><?php echo $row['alamat']; ?></td>
        <td align="center" valign="middle">
            <?php echo $row['jenis_kelamin']; ?>
        </td>
        <td valign="middle">
        <a href="?page=anggota&delete=&id=<?php echo $row['id_anggota']; ?>">
            <button class="btn btn-danger">Hapus</button>
        </a>
        <a  href="?page=anggota&edit=&id=<?php echo $row['id_anggota']; ?>">
            <button class="btn btn-warning" >Edit</button>
        </a>
        </td>
    </tr>
    <?php
    $no++;
    }
    ?>
</table>
<!------------------------------------------------------------------------------------------------------------------------->


<!-- Modal Input Data -->
<div class="modal fade" id="inputdata" tabindex="-1" aria-labelledby="inputModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="inputModalLabel">Tambah Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
<!-- Form Input Anggota -------------------------------------------------------- -->
            <form action="" method="post">
            <input class="hidden" name="id_anggota" value="<?php echo $row['id_anggota'];?>">
                <div class="form-group">
                    <input class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="kelas">
                        <option value="">--Pilih Kelas--</option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jurusan">
                        <option value="<?php echo $row['jurusan']; ?>">
                        <?php
                              if ($row['jurusan']=='RPL') {
                                echo "Rekayasa Perangkat Lunak";
                              }elseif($row['jurusan']=='TAV'){
                                echo "Teknik Audio Video";
                              }elseif($row['jurusan']=='TKR'){
                                echo "Teknik Kendaraan Ringan";
                              }else{
                                echo "Teknik Instalasi Tenaga Listrik";
                              }
                        ?>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="TAV">Teknik Audio Video</option>
                        <option value="TKR">Teknik Kendaraan Ringan</option>
                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span class="input-group-text" >Tanggal Lahir</span>
                        <input class="form-control" type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input class="form-control" type="text" name="no_telepon" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"></textarea>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="jenis_kelamin">
                        <option value="">--Pilih Gender--</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
<!-- ---------------------------------------------------------------------------- -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="simpan">Simpan</button>
        </div>
            <!-- tag tutup formnya pinda ke sini -->
            </form>
            <!-- ------------------------------- -->
        </div>
    </div>
</div>
<!-- End of modal input data -->


<!-- Modal Edit Data -->
<?php
if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $query = mysqli_query($koneksi,"SELECT * FROM anggota WHERE id_anggota = '$id'");
    foreach ($query as $row) {
?>
<script>
	$(document).ready(function(){
		$("#editModal").modal('show');
	});
</script>
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel">Edit Data Anggota</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <!-- Form Edit Anggota -------------------------------------------------------- -->
            <form action="anggota.php" method="get">
            <input type="hidden" name="id_anggota" value="<?php echo $row['id_anggota']; ?>">
                <div class="form-group">
                    <input value="<?php echo $row['nis']; ?>" class="form-control" type="text" name="nis" placeholder="NIS" required>
                </div>
                <div class="form-group mt-2">
                    <input value="<?php echo $row['nama']; ?>" class="form-control" type="text" name="nama" placeholder="Nama Siswa" required>
                </div>
                <div class="form-group mt-2">
                    <select class="form-control" name="kelas">
                        <option value="<?php echo $row['kelas']; ?>"><?php echo $row['kelas']; ?></option>
                        <option value="X">X</option>
                        <option value="XI">XI</option>
                        <option value="XII">XII</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <select  class="form-control" name="jurusan">
                        <option value="<?php echo $row['jurusan']; ?>">
                        <?php
                              if ($row['jurusan']=='RPL') {
                                echo "Rekayasa Perangkat Lunak";
                              }elseif($row['jurusan']=='TAV'){
                                echo "Teknik Audio Video";
                              }elseif($row['jurusan']=='TKR'){
                                echo "Teknik Kendaraan Ringan";
                              }else{
                                echo "Teknik Instalasi Tenaga Listrik";
                              }
                        ?>
                        </option>
                        <option value="RPL">Rekayasa Perangkat Lunak</option>
                        <option value="TAV">Teknik Audio Video</option>
                        <option value="TKR">Teknik Kendaraan Ringan</option>
                        <option value="TITL">Teknik Instalasi Tenaga Listrik</option>
                    </select>
                </div>
                <div class="form-group mt-2">
                    <div class="input-group">
                        <span value="<?php echo $row['tanggal_lahir']; ?>" class="input-group-text" >Tanggal Lahir</span>
                        <input class="form-control" type="date" name="tanggal_lahir">
                    </div>
                </div>
                <div class="form-group mt-2">
                    <input value="<?php echo $row['no_telepon']; ?>" class="form-control" type="text" name="no_telepon" placeholder="No Telepon">
                </div>
                <div class="form-group mt-2">
                    <textarea class="form-control" name="alamat" placeholder="Alamat Lengkap"><?php echo $row['alamat']; ?></textarea>
                </div>
                <div class="form-group mt-2">
                    <select value="<?php echo $row['jenis_kelamin']; ?>" class="form-control" name="jenis_kelamin">
                        <option value="<?php echo $row['jenis_kelamin']; ?>">
                        <?php
                              if ($row['jenis_kelamin']=='L') {
                                echo "Laki_Laki";
                              }else{
                                echo "Perempuan";
                              }
                        ?>
                        </option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
        <!-- ---------------------------------------------------------------------------- -->
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button class="btn btn-success mt-2" type="submit" name="update">Update</button>
        </div>
            <!-- tag tutup formnya pinda ke sini -->
            </form>
            <!-- ------------------------------- -->
        </div>
    </div>
</div>
<?php
}
}
?>
<!-- End of modal input data -->