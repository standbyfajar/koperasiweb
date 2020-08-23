<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
	<script src="<?php echo base_url('assets/DataTables/datatables.min.js') ?>"></script>

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
		        <div class="content-wrapper">
                    <section class="content">
                      <div class="container-fluid">
                        <div class="col-sm-12">
                            <!-- untuk isi -->
                            <div class="panel panel-info">
                                <div class="panel-heading">Formulir Input Nasabah Baru</div><br>
                                    <div class="panel-body">
                                                    <?php if (isset($pesan)) {?>
                                                        <div class="alert alert-danger" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert"> X </button>
                                                            <h4>Peringatan</h4>
                                                            <?php echo $pesan; ?>
                                                        </div>
                                                        <?php 
                                                                            } ?>
                                            <!-- awal pembuatan form -->
                                    <form class="form-horizontal" action="<?php echo base_url('CNasabah/savenasabah') ?>" method="POST" name="formbook" enctype="multipart/form-data">
                                      <div class="row">
                                          <div class="col-sm">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">No Nasabah</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="id" placeholder="isi Id nasabah...!">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Nama nasabah</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="nama" placeholder="isi nama nasabah...">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Tempat lahir</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="tmptlhr" onkeypress ="">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Tanggal lahir</label>
                                                <div class="col-sm-2">
                                                <input type="date" name="tgllahir" onkeypress ="" id="tgllahir">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Usia</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="usia" ReadOnly  id="usia">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Jenis Kelamin</label>
                                                <div class="col-sm-5">
                                                <input type="radio" name="jk" value="Laki-Laki">Laki-Laki <br>
                                                <input type="radio" name="jk" value="Perempuan">Perempuan

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">Type Identitas</label>
                                                <div class="col-sm-4">
                                                <select  class="form-control " id="type" name="type">
                                                    <option value="">Pilih</option> 
                                                    <option value="KTP">KTP</option>
                                                    <option value="SIM">SIM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label">No Identitas</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="noidentitas" onkeypress ="">
                                                </div>
                                            </div>
                                            
                                            
                                            </div>
                                
                                        <div class="col-sm">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Alamat</label>
                                                    <div class="col-sm-2">
                                                        <textarea name="alm" placeholder="isi alamat" ></textarea>
                                                    <!-- <input type="textarea" name="alm" placeholder="isi alamat..."> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Nama Bank</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="bank" onkeypress ="">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">No Rek</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="rek" onkeypress ="">
                                                    </div>
                                                </div>
                                            

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Telepon</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="tlp" onkeypress="return hanyaAngka(event)">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Gaji</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="gaji" onkeypress="return hanyaAngka(event)">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Foto</label>
                                                    <div class="col-sm-2">
                                                    <input type="File" name="ft" accept=".jpg,.png,.jpeg" onchange="bacaGambar(this)">
                                                    <img id="preview" src="" alt="" width="80px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Foto KTP</label>
                                                    <div class="col-sm-2">
                                                    <input type="File" name="ft2" accept=".jpg,.png,.jpeg" onchange="ReviewPic(this)" >
                                                    <img id="preview1" src="" alt="" width="80px"/>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-6">
                                                        <button type="submit" class="btn btn-primary" name="proses" value="proses"><span class="glyphicon glyphicon-save"></span>Simpan</button>
                                                        </div>
                                                </div>
                                                
                                        </div>
                                          
                              
                                  <!-- Tutup Form -->
                                        </div>           
                                      </form>                                      
                                        
                                                
                                      </div>
                                  </div>
                              </div>
            
                    
                    
                    
                        </div>
                      </div>
                    </section>
                </div>
          </div>     
      </div>
	  <!-- footer -->
      <?php $this->load->view('Footer'); ?>		  

</body>


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
    
</html>
<script type="text/javascript">
            $('#tgllahir').on('change', function() {
                var dob = new Date(this.value);
                var today = new Date();
                var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
                $('#usia').val(age);
            });
                    function bacaGambar(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                    
                        reader.onload = function (e) {
                            $('#preview').attr('src', e.target.result);

                        }
                    
                        reader.readAsDataURL(input.files[0]);
                    }
                    }
                    function ReviewPic(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                    
                        reader.onload = function (e) {
                            $('#preview1').attr('src', e.target.result);

                        }
                    
                        reader.readAsDataURL(input.files[0]);
                    }
                    }
                      
		function hanyaAngka(evt) {
				// alert('a');
				  var charCode = (evt.which) ? evt.which : event.keyCode;
				   if (charCode > 31 && (charCode < 48 || charCode > 57))
		 
				    return false;
				  return true;
				}
				function hanyaChar(evt){
				// alert('a');

					 var charCode = (evt.which) ? evt.which : event.keyCode;
			         if ((charCode < 65) || (charCode == 32))
			            return false;        
			         return true;
				}

</script>



<!-- <?php if (isset($pesan)) {?>
<?php if($pesan !== ""){ ?>
	<label id="pesan"><?php echo $pesan; ?></label>
	<script type="text/javascript">
		$(document).ready(function(){
			var pesan = $("label#pesan").text();
			$.alert({
			    title: 'Duplicate!',
			    content: pesan,
			});
		});
	</script>

<?php } } ?> -->

