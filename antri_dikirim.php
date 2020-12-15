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

<head>
  <meta http-equiv="refresh" content="300">
</head>

<?php
error_reporting(~E_NOTICE);
require_once "koneksi.php";
include('lib/paginator.class.2.php');
$pages = new Page;



// cek status antrian

$sql1 = "
	select * from data_wa where status='QUEUE' order by id_msg desc
";
$result1 = mysqli_query($conn,$sql1);

$jml_berhasil = 0;
$jml_gagal = 0;

if($_GET['sinkronisasi']=="1"){
	while ($antrian = mysqli_fetch_array($result1,MYSQLI_ASSOC)){
		$no_wa = $antrian[NO_WA];
		$id_msg = $antrian[ID_MSG];
		$tgl_kirim = $antrian[TGL_KIRIM];
		$status_antrian = cek_status_antrian($no_wa, $id_msg);
		if($status_antrian<>""){
			// jika gagal SENT harus diubah id_msg nya
			if($status_antrian=="SENT") {			
				$sql_antrian = "
					UPDATE data_wa SET
					status = '$status_antrian'
					WHERE id_msg=$id_msg
				";
			}
			else{
				$sql_antrian = "
					UPDATE data_wa a, (select max(id_msg)+1 as id_baru from data_wa) b SET
					a.id_msg = b.id_baru,
					a.status = '$status_antrian'
					WHERE a.id_msg=$id_msg
				";
			}
			//echo $sql_antrian;break;
			
			if($status_antrian=="FAILED (Rejected by APIWHA)") $jml_gagal++;
			else if($status_antrian=="SENT") $jml_berhasil++;
			
			$result_antrian = mysqli_query($conn,$sql_antrian);
		}
		$jml_antri++;
	}
	echo "<script>alert('Menunggu Antrian: ".($jml_antri-$jml_berhasil-$jml_gagal).". Berhasil dikirim: $jml_berhasil. Gagal dikirim: $jml_gagal')</script>";  
	echo "<script>window.open('autosinkron2.php','sinkron')</script>";
}




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

echo "<h2 class='p-3 mb-4 bg-gradient-success text-white shadow m'>Antrian Proses Kirim</h2>";
echo "<table width=100%  border=1 cellspacing=0 collpadding=2 class=table table-hover>";
echo "<tr align=center bgcolor=#CCCCCC>";
echo "<td>Nomor Whatsapp</td><td>Isi Pesan</td><td>Tanggal Kirim</td><td>Status Kirim</td>";
echo "</tr>";
while ($data = mysqli_fetch_array($result,MYSQLI_ASSOC)){
	$no_wa = $data['NO_WA'];
	$tgl_kirim = $data['TGL_KIRIM'];
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
	echo "<td>$no_wa</td><td>$isi_wa</td><td>$tgl_kirim</td><td>$status</td>";
	echo "</tr>";
}
echo "</table><br>";

echo $pages->display_pages();

echo " | Tot Data: ".$pages->items_total;

echo "<br><br>";
echo "<input value='Update Status Pengiriman' class='btn btn-success ' type=button onClick=\"if(confirm('Anda yakin akan melakukan Sinkronisasi Manual?')) window.open('antri_dikirim.php?sinkronisasi=1','_self');\">";



mysqli_free_result($result);
mysqli_free_result($result1);
mysqli_free_result($result2);
mysqli_close($conn);

function cek_status_antrian($no_wa,$custom_data){
	$my_apikey = $GLOBALS['my_apikey']; 
	$number = $no_wa; 
	$type = "OUT"; 
	$api_url  = "http://panel.apiwha.com/get_messages.php"; 
	$api_url .= "?apikey=". urlencode ($my_apikey); 
	$api_url .=	"&number=". urlencode ($number); 
	$api_url .=	"&custom_data=". urlencode ($custom_data); 
	$api_url .= "&type=". urlencode ($type); 
	$my_json_result = file_get_contents($api_url, false); 
	$my_php_arr = json_decode($my_json_result); 
	foreach($my_php_arr as $item) 
	{ 
		$from_temp = $item->from; 
		$to_temp = $item->to; 
		$text_temp = $item->text; 
		$type_temp = $item->type; 
		$failed = $item->failed_date;
		$process = $item->process_date;
		
		if($failed=="" && $process<>"") return "SENT";
		else if($failed<>"" && $process<>"") return "FAILED (Rejected by APIWHA)";
	  
	}
	return "";
}


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