
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
							<div class="panel panel-info">
								<div class="panel-heading">Daftar Pengajuan</div>
							<div class="panel-body">
							<table class="table" id="tbl_one">
							<thead>
								<tr>
								<th>No</th>
								<th>Id Transaksi</th>
								<!-- <th>Tanggal Transaksi</th> -->
								<th>Nomor Nasabah</th>
								<th>Tanggal Peminjaman</th>
								<th>Keterangan</th>
								<th>Aksi &nbsp;<a  class="btn btn-primary btn-xs btn_new" href="<?php echo base_url('CNasabah/tambahnasabah'); ?>"  role="button" title="New">
									<span class="glyphicon glyphicon-plus"></span> New</a>
									<button  type="button" class="btn btn-info btn-xs btn_details" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-th-large"></span>Details</button></th>
							</tr>
							</thead>
						<tbody>

						<?php 
						// $n=0;
						$n=0;
						foreach ($datakr as $row) {
							$n++;
							?>
							<tr>
								<td><?php echo $n; ?></td>
								<td><?php echo $row->nomor_transaksi; ?></td>
								<!-- <td><//?php echo $row->tanggal_transaksi; ?></td> -->
								<td><?php echo $row->nomor_nasabah; ?></td>
								<td><?php echo $row->tanggal_peminjaman; ?></td>
								<td><?php echo $row->keterangan; ?></td>
								<!-- <td><?php //echo $row->jenis_kelamin; ?></td>
								<td><?php //echo $row->nomor_telpon; ?></td>
								<td><?php //echo $row->gaji; ?></td>
						-->
								
								<td><a class="btn btn-primary btn-xs" role="button" title="Edit" href="<?php echo base_url('CNasabah/editnasabah/').$row->nomor_nasabah; ?>">
									<span class="glyphicon glyphicon-edit">Edit</span> </a>
									<a class="btn btn-danger btn-xs" href="<?php echo base_url('CNasabah/deletnasabah/').$row->nomor_nasabah; ?>" role="button" title="Delete"  title="delete nasabah" onclick="return confirm('benar akan dihapus?');" >
									<span class="glyphicon glyphicon-remove"></span> Delete</a>
									<button data-id="<?php echo $row->nomor_nasabah; ?>" type="button" class="btn btn-info btn-xs btn_detail" ><span class="glyphicon glyphicon-th-large"></span>info</button></td>
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
													<th>Id Nasabah</th>
													<th>Nama Nasabah</th>
													<th>Type Identitas</th>
													<th>No Identitas</th>
													<th>No Rekening</th>
													<th>Alamat</th>

												

												</thead>
												<?php 
										// $n=0;
										$n=0;
										foreach ($datakr as $row) {
											$n++;
											?>

												<tbody>
												<td><?php echo $n; ?></td>
												<td><?php echo $row->nomor_nasabah; ?></td>
												<td><?php echo $row->nama_nasabah; ?></td>
												<td><?php echo $row->type_identitas; ?></td>
												<td><?php echo $row->no_identitas; ?></td>
												<td><?php echo $row->no_rek; ?></td>
												<td><?php echo $row->alamat; ?></td>
												
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
											<h4 class="modal-title">Data Nasabah</h4>
										</div>
										<!-- body modal -->
									<div class="panel panel-info">
										
										<div class="modal-body" style="overflow: auto;">

								<div class="col-sm-6">
									<form class="form-horizontal" action="<?php echo base_url('') ?>" method="POST" name="formbook" enctype="multipart/form-data">

									<div class="form-group">
										<label class="col-sm-2 control-label">Nomor Nasabah</label>
										<div class="col-sm-2">
										<input type="text" id="id" value="" readonly>
										
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Nama Nasabah</label>
										<div class="col-sm-2">
										<input type="text" id="nama" readonly>
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Tanggal Lahir</label>
										<div class="col-sm-2">
										<input type="text" id="eml" readonly>
									</div></div>

									<div class="form-group">
										<label class="col-sm-2 control-label">Tempat Lahir</label>
										<div class="col-sm-2">
										<input type="text" id="tmpt" readonly>
										
									</div></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">type Identitas</label>
										<div class="col-sm-2">
										<input type="text" id="type" readonly>
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
	
	$(document).ready(function(){

		$('#tbl_one').DataTable();

		$(document).on('click','.btn_detail',function(){
			nomor=$(this).attr("data-id");
			
				$.ajax({
						url:"<?php echo base_url('CNasabah/get_nasabah/') ?>"+nomor_nasabah,
						method:"POST",
						dataType:"json",
						success:function(data){
							$('#id').val(data.nomor_nasabah);
							$('#nama').val(data.nama_nasabah);
							$('#eml').val(data.tanggal_lahir);
							$('#tmpt').val(data.tempat_lahir);
							$('#type').val(data.type_identitas);
							
							//$('#foto').attr('src','<?=base_url()?>/image/'+data.Foto);

							$('#infoModal').modal("show");
						},
						error:function(xhr){
							console.log(xhr);
						}
					});
		})

		

	});
</script>


  
</html>

