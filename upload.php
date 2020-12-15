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
require_once "koneksi.php"

?>
<script src="assets/package/dist/sweetalert2.all.min.js"></script>
<form action="" method="post" enctype="multipart/form-data" name="form1" id="form1" onsubmit="return confirm('Anda yakin akan mengupload Excel?');">
  <h2 class="p-3 mb-4 bg-gradient-success text-white shadow">Upload Excel</h2>
  <p>Silahkan Upload File sesuai Format dari IT Helpdesk </p>
  <table table class="table table-sm x-4" border="1">
    <tr bgcolor="#CCCCCC">
      
    </tr>
    
    <tr>
      
    </tr>
  </table>
  <br />
  <table width="60%" >
    <tr>
      <td width="12%">File Excel <strong>(.xlsx) </strong></td>
      <td width="91%"><input type="file" class="btn btn-secondary shadow" name="file" />
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><br />

</div>
      
  

 

  </div>
</div>
<script src="assets/package/dist/sweetalert2.all.min.js"></script>
    <input  class="btn btn-success" type="submit"  name="Submit" value="Upload">
      </td></tr>
  </table>
</form>
<?php

function getExtension($str) {

         $i = strrpos($str,".");
         if (!$i) { return ""; } 

         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return strtoupper($ext);
 }

if($_FILES['file']['name']<>""){
  $ekstensi = getExtension($_FILES['file']['name']);
  if($ekstensi=="XLS" || $ekstensi=="XLSX"){
    move_uploaded_file($_FILES['file']['tmp_name'], "excel/upload.".$ekstensi);
    $save = true;
    
  }
  else echo "<script>alert('Error, file yang diupload harus file excel.')</script>";
}
if($save){
  
  //require_once "koneksi.php";
  
  /*
  // kosongkan pb_pelanggan_upload
  $sql = "delete from pb_pelanggan_upload";
  $result = oci_parse($c, $sql);
  $hasil = oci_execute($result);
  */
  
  include 'excel/simplexlsx.class.php';
  $xlsx = new SimpleXLSX("excel/upload.".$ekstensi);
  
  
  list($cols,) = $xlsx->dimension();
  $jml_data = 0;
  
  foreach( $xlsx->rows() as $k => $r) {
    //if ($k == 0) continue; // skip first row
    if ($k == 0) { // cek data
      if (
      strtoupper($r[0])<>"NO_WA" ||
      strtoupper($r[1])<>"VAR_1" ||
      strtoupper($r[2])<>"VAR_2" 
      ) {
        echo "<script>alert('Upload gagal, nama kolom tidak sesuai standar.')</script>";
        break;
      }
    }
    //$tmp = "";
    echo '<tr>';
    
    //echo "<td>$tmp</td>";
    
    if ($k<>0) {
      
      $r[0] = strtoupper($r[0]);
      $r[1] = strtoupper($r[1]);
      
      $sql = "
      insert into data_wa (tgl_input,no_wa,var_1,var_2,var_3,var_4,var_5,var_6,var_7,var_8,var_9,var_10)
      values (now(),'$r[0]','$r[1]','$r[2]','$r[3]','$r[4]','$r[5]','$r[6]','$r[7]','$r[8]','$r[9]','$r[10]')
      ";
      $result = mysqli_query($conn, $sql);
      $jml_data=$jml_data+1;
      //echo $sql;
    }
  }
  
  if($jml_data>0){
    
    echo "<script src='assets/package/dist/sweetalert2.all.min.js'></script>
<script >Swal.fire({
  position: 'center',
  icon: 'success',
  title: '$jml_data Data Berhasil diupload!',
  showConfirmButton: true,
  timer: 10000,
}).then((isConfirmed) => {
  if (isConfirmed); {
    window.open('belum_dikirim.php','_self')
  }
})</script>";   

   // echo "<script>window.open('belum_dikirim.php','_self')</script>";
  }
  
  mysqli_close($conn);
  
}
?>





!












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
