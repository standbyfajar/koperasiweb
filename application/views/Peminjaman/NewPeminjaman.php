<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- untuk hape -->
	<meta http-equiv="content-Language" content="en-us">
	<meta charset="utf-8">
	<link rel="icon" href="<?php echo base_url('image/era.jpg') ?>" type="image/ico" />
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/AdminLTE/dist/css/adminlte.min.css');?>">
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
  <link rel="stylesheet" href="<?php echo base_url('assets/jquery/jquery-ui.css');?>">
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
                                <div class="panel-heading">Formulir Input Peminjaman Baru</div><br>
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
                                    <form class="form-horizontal" action="<?php echo base_url('CPeminjaman/saveP') ?>" method="POST" name="formbook" enctype="multipart/form-data">
                                      <div class="row">
                                          <div class="col-sm">
                                          <!-- <?php print_r($_SESSION); ?>  -->

                                            <div class="form-group">
                                                <label class="col-sm-4 control-label">No Pengajuan</label>
                                                <div class="col-sm-8">
                                                <input type="text" name="no_pengajuan" id="no_pengajuan">
                                                <button id="btnPop" type="button" class="btn btn-info btn-xs btn_PP"><i class="fa fa-search-plus" aria-hidden="true"></i></button>

                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-5 control-label">Tanggal Transaksi</label>
                                                <div class="col-sm-2">
                                                <input type="text" name="tgl" id="tgl" value ="<?php echo date('Y-m-d') ?>" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                    <label class="col-sm-5 control-label">No Transaksi</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="nomor" id="nomor" value="<?php echo $this->session->noPM; ?>" readonly/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">No Nasabah</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="nasa" id="nasa" readonly/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Total Tabungan</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="tot_tabungan" id="tot_tabungan" readonly/>                                                    
                                                    </div>
                                                </div>
                                            <div class="form-group">
                                                        <label class="col-sm-2 control-label"></label>
                                                        <div class="col-sm-6">
                                                        <button type="submit" class="btn btn-primary" name="proses" value="proses"><span class="glyphicon glyphicon-save"></span>Simpan</button>
                                                        </div>
                                                </div>
                                            
                                            </div>
                                
                                        <div class="col-sm">
                                           
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label">Nominal Pinjam</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="nominal" id="nominal"/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Cicilan</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="cicil" id="cicil"/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Bunga %</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="bunga" id="bunga" readonly/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Cicilan/bulan</label>
                                                    <div class="col-sm-2">
                                                    <input type="text" name="cicil_bulan" id="cicil_bulan" readonly/>                                                    
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                    <div class="col-sm-2">
                                                    <!-- <input type="text" name="ket" onkeypress =""> -->
                                                    <textarea name="ket" id="" cols="30" rows="2"></textarea>
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

        <!-- Modal -->
        <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Data PP</h4>
            </div>
            <div class="modal-body">
              <div style="overflow: auto;">
                      
                      <table class="table" id="tb_PP">
                        <thead>
                          <th>No.</th>
                          <th>No PP</th>
                          <th>tanggal</th>
                          <th>No nasabah</th>
                          <th>Nama nasabah</th>
                          <th>tanggal peminjaman</th>

                        </thead>
                        <tbody>
                        <?php 
                    // $n=0;
                    $n=0;
                    foreach ($datapp->result() as $row) {
                      $n++;
                      ?>
                        <tr>
                        
                        <td><?php echo $n; ?></td>
                        <td><span><?php echo $row->nomor_transaksi; ?></span></td>
                        <td><span><?php echo $row->tanggal_transaksi; ?></span></td>
                        <td><span><?php echo $row->nomor_nasabah; ?></span></td>
                        <td><span><?php echo $row->nama_nasabah; ?></span></td>
                        <td><span><?php echo $row->tanggal_peminjaman; ?></span></td>
                   


                        <td>
                          <button  class="btn btn-danger btn_pilih"><i class=""></i>SELECT</buttton>
                        </td>
                        </tr>
                        
                        
                        <?php } ?>


                        </tbody>
                      </table>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>

        </div>
      </div>
</html>

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
<script src="<?php echo base_url('assets/jquery/jquery-ui.js')?>"></script>
    

<script type="text/javascript">

    $("#btnPop").click(function(){
      $("#myModal").find(".modal-dialog").css({width:'800'});
      $('#myModal').modal('show');
    })

    // $(".btn_pilih").click(function(){
    //   //alert('aa');
    //   index=$(this).parent().parent().index();
    //   NoPM=$("#tb_PP tbody tr:eq("+index+") td:nth-child(2) span").text();
    //   tgl=$("#tb_PP tbody tr:eq("+index+") td:nth-child(3) span").text();
    //   nonasabah=$("#tb_PP tbody tr:eq("+index+") td:nth-child(4) span").text();
    //   namanasabah=$("#tb_PP tbody tr:eq("+index+") td:nth-child(5) span").text();
    //   jabat=$("#tb_PP tbody tr:eq("+index+") td:nth-child(7) span").text();
      
    //   // if ( $("#tb_PP tbody tr:eq("+index+") td:nth-child(9) span").text() == 0 ){
    //   //   gaji=$("#tb_PP tbody tr:eq("+index+") td:nth-child(8) span").text();
    //   // }else{
    //   //   gaji=$("#tb_PP tbody tr:eq("+index+") td:nth-child(9) span").text();
    //   // }
    //   $("#pp").val(NoPP);
    //   $("#karyawan").val(idkar);
    //   $("#dep").val(kddept);
    //   $("#jbt").val(jabat);
    //   $("#tanggal").val(tgl);
    //   $("#gajihidden").val(gaji);


    //   $("#myModal").modal("hide");
    // })
$("#nominal").keyup(function(){
    var nominal = $(this).val();
    var jasa    = 0;
    if (nominal==5000) {
        jasa=0.1;
    }
    else if (nominal >5000 && nominal <10000){
        jasa=0.2;  
    }
    else{
         jasa= 0.3;
    }
    $("#bunga").val(jasa);
})

$("#cicil").keyup(function(){
    var cicil = $(this).val();
    var nominal = $("#nominal").val();
    var bunga = $("#bunga").val();
    var cicil_bln = 0;
    cicil_bln = (nominal/cicil) + bunga;
    $("#cicil_bulan").val(Math.round(parseInt((cicil_bln))));

})

// $("#no_pengajuan").autocomplete({
//     source: <?php echo base_url('CPeminjaman/autocomp/?'); ?>
// });

$( "#no_pengajuan" ).autocomplete({
        source: function( request, response ) {
          // Fetch data
          $.ajax({
            url: "<?=base_url()?>CPeminjaman/autocomp",
            type: 'post',
            dataType: "json",
            data: {
              term: request.term
            },
            success: function( data ) {
                // console.log(data);
                response( data );
            }
          });
        },
        select: function (event, ui) {
          // Set selection
        //   $('#no_pengajuan').val(ui.item.label); // display the selected text
          $('#no_pengajuan').val(ui.item.value); // save selected id to input
          $.ajax({
              url: "<?php echo base_url(''); ?>" + 'CPeminjaman/get_P/' + ui.item.value,
              type: "post",
              dataType: "json",
              success:function(data){
                  console.log(data);
                  $("#nasa").val(data.nomor_nasabah);
                  $("#tot_tabungan").val(data.total_tabungan);
              }
          })
          return false;

        }
      });

                      
// 		function hanyaAngka(evt) {
// 				// alert('a');
// 				  var charCode = (evt.which) ? evt.which : event.keyCode;
// 				   if (charCode > 31 && (charCode < 48 || charCode > 57))
		 
// 				    return false;
// 				  return true;
// 				}
// 				function hanyaChar(evt){
// 				// alert('a');

// 					 var charCode = (evt.which) ? evt.which : event.keyCode;
// 			         if ((charCode < 65) || (charCode == 32))
// 			            return false;        
// 			         return true;
// 				}

</script>