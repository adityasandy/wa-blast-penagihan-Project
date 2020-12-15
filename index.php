<?php 
session_start();
if (!isset($_SESSION["login"])) {
  header("Location: login.php");
  exit;
}
require 'functions.php';
require_once "koneksi.php";
include('lib/paginator.class.2.php');

$notproses    ="SELECT count(*) AS jumlah FROM data_wa WHERE TGL_KIRIM IS NULL";
$query    =mysqli_query($conn,$notproses);
$result =mysqli_fetch_array($query);


$proses    ="SELECT count(*) AS terproses FROM data_wa WHERE TGL_KIRIM IS NOT NULL AND STATUS='SENT'";
$query1    =mysqli_query($conn,$proses);
$result1 =mysqli_fetch_array($query1);

$queue    ="SELECT count(*) AS antre FROM data_wa WHERE STATUS='QUEUE' AND TGL_KIRIM IS NOT NULL  ";
$query2    =mysqli_query($conn,$queue);
$result2 =mysqli_fetch_array($query2);
 
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
        <div class="sidebar-brand-text mx-3">WA BLASTER</div>
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
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pesan Belum Terproses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result['jumlah']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="far fa-clock fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Annual) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Antrean Proses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result2['antre']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-truck-loading fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            
            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pesan yang sudah terproses</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $result1['terproses']; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-check-double fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


      

      
              

              <!-- Collapsable Card Example -->
              <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                  <h6 class="m-0 font-weight-bold text-primary">Contoh Pesan Tagihan Whatsapp</h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse hidden" id="collapseCardExample">
                  <div class="card-body">
                    Selamat Sore Bapak/Ibu Keluarga *I KETUT DANA*,kami dari BPJS Kesehatan Kantor Cabang Klungkung bermaksud menyampaikan informasi bahwa nomor kartu JKN-KIS Keluarga 0002055919184 *memiliki tunggakan sampai dengan bulan Oktober 2020 sebesar Rp. 306,000 * (tunggakan 3 bulan dengan jumlah anggota keluarga 4 jiwa ).Segera lakukan pembayaran di kanal pembayaran iuran BPJS Kesehatan (Bank Mandiri, BNI, BTN, BRI, BCA, Indomaret, Tokopedia, Alfamart, PT Pos dan lain-lain). *Abaikan pesan ini jika sudah membayar*. 

Informasi kepesertaan dan rincian tagihan dapat dilihat melalui aplikasi Mobile JKN, yang dapat diunduh melalui Google Playstore atau AppStore. 

Demi kenyamanan Anda, segera daftarkan pembayaran iuran BPJS Kesehatan Anda melalui layanan autodebit di Bank Mandiri, BNI, BRI, BCA atau melalui aplikasi Mobile JKN.

Untuk informasi lebih lanjut dapat menghubungi Call Center BPJS Kesehatan 1500400 (24 jam).Salam BPJS Kesehatan Cabang Kantor Cabang Klungkung. Semoga sehat selalu.
                  </div>

                </div>

              </div>
<!-- Donut Chart -->
            <div class="col-xl-4 col-lg-5">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"> Chart</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4">
                    <canvas id="myPieChart"></canvas>
                  </div>
                  \
                </div>
              </div>
            </div>
          </div>

        </div>
            </div>

          </div>

        </div>
        <!-- /.container-fluid -->
</div>
      </div>






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
