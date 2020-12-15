<?php 
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';


 ?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="assets/img/icon.png" />

  <title>WABLAST</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" class="mr-3">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion mr-1" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon">
          <i class="fab fa-whatsapp 5"></i>
        </div>
        <div class="sidebar-brand-text mx-3">WA BLASTER <sup><br>KC KLUNGKUNG</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="upload.php">
          <i class="fas fa-file-import"></i>
          <span>Upload Excel</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Proses W.A Massal
      </div>

      
      <!-- Nav Item - Charts -->
      <li class="nav-item">
        <a class="nav-link" href="belum_dikirim.php">
          <i class="fas fa-microchip"></i>
          <span>Belum Proses</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="antri_dikirim.php">
          <i class="fas fa-spinner"></i>
          <span>Sedang Proses</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="sudah_dikirim.php">
          <i class="fas fa-clipboard-check"></i>
          <span>Sudah Terproses</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">
      <script src="assets/package/dist/sweetalert2.all.min.js"></script>
      <li class="nav-item">
        <a class="nav-link"   onclick="Swal.fire({
  position: 'center',
  icon: 'info',
  title: 'Yakin?',
  showConfirmButton: true,
  timer: 7000,
}).then((isConfirmed) => {
  if (isConfirmed); {
    window.open('logout.php')
  }
})">
          <i class="fas fa-clipboard-check"></i>
          <script src="assets/package/dist/sweetalert2.all.min.js"></script>
          <span href="">Logout</span></a>
      </li>
    <script></script>
      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-light topbar mb-3 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

         

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="logout.php" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Tim Penagihan</span>
                <img class="img-profile rounded-circle" src="assets/img/avatar.jpg">
              </a>
              <!-- Dropdown - User Information -->
              
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->





        <!-- Begin Page Content -->


        <?php
error_reporting(~E_NOTICE);
require_once "koneksi.php";
include('lib/paginator.class.2.php');
$pages = new Page;


$sql1 = "
	select * from data_wa where (status <> 'SENT' and status<>'QUEUE') or status is null order by id_msg desc
";
$result1 = mysqli_query($conn,$sql1);

$sql2 = "
	select count(*) JML from ($sql1) x
";
$result2 = mysqli_query($conn,$sql2);
$data2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);


$pages->items_total = $data2['JML'];
$pages->mid_range = 9; // Number of pages to display. Must be odd and > 3
$pages->paginate();

$batasan = str_replace("and",",", $pages->limit );

$sql = "
	$sql1 LIMIT $batasan
";
$result = mysqli_query($conn,$sql);

echo " <h2 class='p-3 mb-4 bg-gradient-success text-white shadow'>Belum Proses Kirim</h2>";
// update format =====
echo "<form action='update_format_wa.php' method='POST' onsubmit=\"return confirm('Anda yakin akan mengupdate format WA?');\">";
echo "<h3>Kirim Pesan Penagihan</h3>";

echo " <p>
  <a class='btn btn-info text-white' data-toggle='collapse' href='#collapseExample' role='button' aria-expanded='false' aria-controls='collapseExample'>
    Tips Format Pesan Whatsapp
  </a>
</p>
<div class='collapse' id='collapseExample'>
  <div class='card card-body'>
   Untuk memasukan Nilai yang ada pada tabel gunakan tanda kurung siku [   ], <br>Contoh : Halo Bapak/Ibu, [VAR_1]<br>Hasil : Halo Bapak/Ibu, Aditya<br><br>Contoh Pesan Lengkap : Selamat Sore Bapak/Ibu Keluarga [VAR_1],kami dari BPJS Kesehatan Kantor Cabang Klungkung bermaksud menyampaikan informasi bahwa nomor kartu JKN-KIS Keluarga  [VAR_2], memiliki tunggakan sebesar [VAR_3] * (tunggakan [VAR_4] dengan jumlah anggota keluarga [VAR_5] ).Segera lakukan pembayaran di kanal pembayaran iuran BPJS Kesehatan (Bank Mandiri, BNI, BTN, BRI, BCA, Indomaret, Tokopedia, Alfamart, PT Pos dan lain-lain). *Abaikan pesan ini jika sudah membayar*. Informasi kepesertaan dan rincian tagihan dapat dilihat melalui aplikasi Mobile JKN, yang dapat diunduh melalui Google Playstore atau AppStore. Demi kenyamanan Anda, segera daftarkan pembayaran iuran BPJS Kesehatan Anda melalui layanan autodebit di Bank Mandiri, BNI, BRI, BCA atau melalui aplikasi Mobile JKN. Untuk informasi lebih lanjut dapat menghubungi Call Center BPJS Kesehatan 1500400 (24 jam), atau layanan melalui Whatsapp ke nomor 081246448445.Salam BPJS Kesehatan Cabang Kantor Cabang Klungkung. Semoga sehat selalu.
  </div>
</div>";
               



echo "<br>";
echo "<textarea name=teks rows=6 cols=100>$format_wa</textarea>";
echo "<input type=hidden name=url value='$_SERVER[REQUEST_URI]'>";
echo "<br><br><input type=submit class='btn btn-primary mb-1' value='Update Format' data-toggle=tooltip data-placement=top title='Update Format Pesan Tagihan Pada kolom isi WA'>";
echo "</form>";

// kirim WA =====
echo "<form action='kirim_wa.php' method='POST' onsubmit=\"return confirm('Anda yakin akan mengirimkan WA?');\">";

echo "<input type=hidden name=url value='$_SERVER[REQUEST_URI]'>";
echo "<h3> </h3>";
echo "<input type=submit class='btn btn-info mb-3' value='Kirim Whatsapp Blast' data-toggle=tooltip data-placement=top title='Pastikan Format Pesan sudah benar dan data Valid'>";
echo "</form>";
echo "<table width=100% border=1 cellspacing=0 collpadding=2 class=table table-hover >";
echo "<tr align=center bgcolor=#CCCCCC>";
echo "<td >AKSI</td><td>NOMOR WHATSAPP</td><td>STATUS</td><td>ISI PESAN</td><td>VAR_1</td><td>VAR_2</td><td>VAR_3</td><td>VAR_4</td><td>VAR_5</td><td>VAR_6</td><td>VAR_7</td><td>VAR_8</td><td>VAR_9</td><td>VAR_10</td>";
echo "</tr>";
while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$id_msg = $data['ID_MSG'];
	$no_wa = $data['NO_WA'];
	$status = $data['STATUS'];
	$format_wa = $data['FORMAT_WA'];
	$isi_wa = $data['ISI_WA'];
	$var_1 = $data['VAR_1'];
	$var_2 = $data['VAR_2'];
	$var_3 = $data['VAR_3'];
	$var_4 = $data['VAR_4'];
	$var_5 = $data['VAR_5'];
	$var_6 = $data['VAR_6'];
	$var_7 = $data['VAR_7'];
	$var_8 = $data['VAR_8'];
	$var_9 = $data['VAR_9'];
	$var_10 = $data['VAR_10'];
	
	echo "<tr>";

  echo "<td>
  <a href=hapus.php?id_msg=$id_msg class='btn btn-danger btn-sm text-white btn-shadow' onclick=\"return confirm('Yakin Akan Menghapus?')\">Hapus
 </a>
  </td>
 ";
 

	echo "

	<td>$no_wa</td><td>$status</td><td>$isi_wa</td><td>$var_1</td><td>$var_2</td><td>$var_3</td><td>$var_4</td><td>$var_5</td><td>$var_6</td><td>$var_7</td><td>$var_8</td><td>$var_9</td><td>$var_10</td>";
	echo "</tr>";
}
echo "</table><br>";

echo $pages->display_pages();

echo " | Tot Data: ".$pages->items_total;





mysqli_free_result($result);
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_close($conn);
?>
<!-- End of Main Content -->





<!-- Footer -->
      <footer class="sticky-footer bg-light">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <a  href="blocked.php">
          
            <span>Copyright &copy; IT KC Klungkung 2020</span></a>
          </div>
        </link>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="assets/js/demo/chart-area-demo.js"></script>
  <script src="assets/js/demo/chart-pie-demo.js"></script>

</body>

</html>
