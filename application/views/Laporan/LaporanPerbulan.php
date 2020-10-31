
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
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/adminlte.css');?>">


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
            <div class="content-wrapper" role="main">
                <div class="right_col" role="main">
                <!-- <section class="content"> -->
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h3 class="card-title">Laporan Perbulan</h3>
                                    </div>
                                        <form class="form-horizontal" name="formbook" enctype="multipart/form-data" action="<?php echo base_url('CLaporan/act_preview') ?> " method="POST" >
                                        <div class="form-group">
                                            <label style="margin-top: 5px;" class="col-md-4 control-label">Dari tanggal</label>
                                                <div class="col-md-8">
                                                    <input type="date" name="dari" id="dari" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                                </div>
                                        </div>

                                        <div class="form-group">
                                            <label style="margin-top: 5px;" class="col-md-4 control-label">sampai Tanggal</label>
                                                <div class="col-md-8">
                                                    <input type="date" name="sampai" id="sampai" class="form-control" value="<?php echo date('Y-m-d') ?>">
                                                </div>
                                        </div>
                                        <div class="col-sm-3"></div>
                                            <div class="col-sm-4">
                                                    <button type="submit" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-print"></span>Preview</a></button>										</div>
                                            <div class="col-sm-4">			
                                        </div>
                    					</form>

                                        <div class="col-sm-12">
                                            <?php 
                                            if ($this->session->muncul==true) {
                                                # code...
                                            
                                            ?>
                                        </div>

                                        <div class="col-sm-12">
                                            <div class="panel panel-primary">
                                            <div class="panel-heading">
                                            <h5>Laporan Peminjaman</h5>
                                            <h6>Periode tanggal : <?php echo $tglawal; ?> sampai <?php echo $tglakhir; ?></h6>
                                        </div>
                                            <table class="table table-bordered" id="TabelLaporan">
                                                <thead>
                                                    <tr class="info">
                                                        <th style="width:35px;">No</th>
                                                        <th style="width:130px;">Nomor Transaksi</th>
                                                        <th style="width:250px;">Tanggal Transaksi</th>
                                                        <th style="width:150px;">Nomor Nasabah</th>
                                                        <th style="width:150px;">Nama Nasabah</th>
                                                        <th style="width:75px;">Keterangan</th>
                                                        <th style="width:75px;">Jumlah Uang</th>
                                                        <!-- <th style="width:40px;"></th> -->

                                                    </tr>
                                                </thead>
                                                <?php 
                                            
                                            ?>
                                                <tbody>
                                                    <?php 
                                                    $no=0;
                                                    $tot=0;
                                                        $qti=0;
                                                    foreach ($laporan as $row) {
                                                        $no++;
                                                        $tot=$tot+$row->nominal;

                                                        ?>

                                                        <tr>
                                                            <td><?php echo $no; ?></td>
                                                            <td><?php echo $row->nomor_pinjam; ?></td>
                                                            <td><?php echo $row->tanggal_transaksi; ?></td>
                                                            <td><?php echo $row->nomor_nasabah; ?></td>
                                                            <td><?php echo $row->nama_nasabah; ?></td>
                                                            <td><?php echo $row->keterangan; ?></td>
                                                            <td><?php echo $row->nominal; ?></td>
                                                           
                                                        </tr>

                                                        <?php 

                                                    }
                                                    ?> 
                                                        <tr>
                                                            <td colspan="6" align="right">
                                                                Total:
                                                            </td>


                                                            <td align="right">
                                                                <?php echo number_format($tot,0) ?>
                                                            </td>
                                                        </tr>


                                                </tbody>
                                            </table>
                                        </div>
                                            
                                            <a href="<?php echo base_url('CLaporan/list_penjualan_pdf?tglawal='
                                            .$this->session->tglawal.'&tglakhir='.$this->session->tglakhir); ?>" type="button" class="btn btn-success" target="_blank"><i class="fa fa-print" aria-hidden="true"></i> Print PDF</a>
                                            <?php } ?>
                                        
                                        
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>    
  </body>
  <!-- footer -->
  <?php $this->load->view('Footer'); ?>


<!-- jQuery -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery/jquery.min.js')?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
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




  
</html>

