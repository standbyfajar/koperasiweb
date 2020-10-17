
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">

	<!-- <script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script> -->
	<script src="<?php echo base_url('assets/AdminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/bootstrap.min.css');?>">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css">

  
<!-- Icon -->
  <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/fontawesome-free/css/all.min.css');?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css');?>">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/icheck-bootstrap/icheck-bootstrap.min.css');?>">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/jqvmap/jqvmap.min.css');?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/adminlte.min.css');?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/overlayScrollbars/css/OverlayScrollbars.min.css');?>">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.css');?>">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/plugins/summernote/summernote-bs4.css');?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

</head>
<!-- Menu atas  -->
<?php $this->load->view('Navbar'); ?>
<!-- Menu Samping -->
  <?php $this->load->view('Aside'); ?>


<body class="nav-md">
    <div class="container body">
		<div class="main_container">
        
        <!-- menu atas -->
		<div class="content-wrapper">
			<section class="content">
			<div class="container-fluid">
				<div class="col-sm-12">
							<!-- untuk isi -->
							<div class="card card-primary">
								<div class="card-header">Daftar Peminjaman</div>
							<div class="panel-body">
							<table class="table" id="tbl_one">
							<thead>
								<tr>
								<th>No</th>
								<th>No pengajuan</th>
								<th>Tanggal Transaksi</th>
								<th>nomor Transaksi</th>
								<th>No Nasabah</th>
								<th>Keterangan</th>
								<th>Action &nbsp;<a  class="btn btn-primary btn-xs btn_new" href="<?php echo base_url('CPeminjaman/tambahP'); ?>"  role="button" title="New">
									<span class="glyphicon glyphicon-plus"></span> New</a>
									<button  type="button" class="btn btn-info btn-xs btn_details" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-th-large"></span>Details</button></th>
							</tr>
							</thead>
						<tbody>

						<?php 
						// $n=0;
						$n=0;
						foreach ($datakar as $row) {
							$n++;
							?>
							<tr>
								<td><?php echo $n; ?></td>
								<td><?php echo $row->nomor_pengajuan; ?></td>
								<td><?php echo $row->tanggal_transaksi; ?></td>
								<td><?php echo $row->nomor_pinjam; ?></td>
								<td><?php echo $row->nomor_nasabah; ?></td>
								<td><?php echo $row->keterangan; ?></td>
								
								<td >
								<div class="btn-group">
								<a href="<?php echo base_url('CPeminjaman/delete_detil/').$row->nomor_pengajuan ?>" class="btn btn-danger btn-xs" role="button" 
								onclick="return Confirm()">
								<i class="icon-trash"></i>hapus data</a>
								
								<a style="width: 110px;" href="<?php echo base_url('CPeminjaman/Cetak_form/').$row->nomor_pengajuan ?>" target="_blank"  class="btn btn-success btn-xs" >
								<i class="icon-print"></i> Cetak</a>
								</td></div>
							</tr><?php
						}
							?>
							</tbody>
							</table>
							<!-- <?php //echo $this->pagination->create_links(); ?> -->
							</div>
						</div>
							<!-- Modal -->
							<div id="myModal" class="modal fade" role="dialog" >
								<div class="modal-dialog modal-lg">
									<!-- konten modal-->
									<div class="modal-content">
										<!-- heading modal -->
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title"></h4>
										</div>
										<!-- body modal -->
									<div class="panel panel-info">
										
										<div class="modal-body" style="overflow: auto;">

									<div>
										<div style="overflow: auto;">
											
											<table class="table">
												<thead>
													<th>No</th>
													<th>No Pinjam</th>
													<th>Tanggal Transaksi</th>
													<th>No Nasabah</th>
													<th>Nominal</th>
													

												

												</thead>
												<?php 
										// $n=0;
										$n=0;
										foreach ($datakar as $row) {
											$n++;
											?>

												<tbody>
												<td><?php echo $n; ?></td>
												<td><?php echo $row->nomor_transaksi; ?></td>
												<td><?php echo $row->tanggal_transaksi; ?></td>
												<td><?php echo $row->nomor_nasabah; ?></td>
												<td><?php echo $row->nominal; ?></td>
							
												
												</tbody><?php } ?>
											</table>
										</div>
										
									</div>

									</div>
								</div>

										<!-- footer modal -->
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
										</div>
									</div>
								</div>
							</div>
							<!-- modal info -->
							<div id="infoModal" class="modal fade" role="dialog" >
								<div class="modal-dialog modal-lg">
									<!-- konten modal-->
									<div class="modal-content">
										<!-- heading modal -->
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Data Pengajuan</h4>
										</div>
										<!-- body modal -->
									<div class="panel panel-info">
										
										<div class="modal-body" style="overflow: auto;">

								<div class="col-sm-6">
									<form class="form-horizontal" action="<?php echo base_url('') ?>" method="POST" name="formbook" enctype="multipart/form-data">

									<div class="form-group">
										<label class="col-sm-2 control-label">Nomor Transaksi</label>
										<div class="col-sm-2">
										<input type="text" id="id" value="" readonly>
										
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nomor Nasabah</label>
										<div class="col-sm-2">
										<input type="text" id="nomor" readonly>
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Pengajuan</label>
										<div class="col-sm-2">
										<input type="text" id="tgl1" readonly>
									</div></div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Pinjam</label>
										<div class="col-sm-2">
										<input type="text" id="tgl2" readonly>
										
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Keterangan</label>
										<div class="col-sm-2">
										<input type="text" id="ket" readonly>
									</div></div>
									
									
									
									
								</form>
								</div>



										<!-- footer modal -->
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
										</div>
									</div>
								</div>
							</div>
			</div>
			</section>

      
		</div>
  </div>
  <!-- footer -->
  <?php $this->load->view('Footer'); ?>


<!-- jQuery -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery/jquery.min.js')?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js')?>"></script>

<script src="<?php echo base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/chart.js/Chart.min.js')?>"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/sparklines/sparkline.js')?>"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jqvmap/jquery.vmap.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery-knob/jquery.knob.min.js')?>"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/moment/moment.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/daterangepicker/daterangepicker.js')?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')?>"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/summernote/summernote-bs4.min.js')?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/adminlte.js')?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/pages/dashboard.js')?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/AdminLTE/dist/js/demo.js')?>"></script>

</body>


<script type="text/javascript">
// let btnxx = document.querySelector('.btn-xx');
// btnxx.addEventListener('click', (e) => {
// 	e.target.parentNode.parentNode.innerHTML = 'active'
// })
$(".btn_detail").click(function(){
			nomor=$(this).attr("data-id");
			console.log(nomor);
			$.ajax({url: "<//?php echo base_url('CPengajuan/get_P/') ?>"+nomor, 
			method :"POST",
			dataType:"json",
			success: function(result){
				$('#id').val(data.nomor_transaksi);
				$('#nomor').val(data.nomor_nasabah);
				$('#tgl').val(data.tanggal_transaksi);
				$('#tgl2').val(data.tanggal_peminjaman);
				$('#ket').val(data.keterangan);
			}});

				$('#infoModal').modal("show");
		
					});

	
	$(document).ready(function(){

		$('#tbl_one').DataTable();

		

	});

	function Confirm() {
		Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				Swal.fire(
				'Deleted!',
				'Your file has been deleted.',
				'success'
				)
			}
		})
	}
</script>


  
</html>

