<html>
<head>
<!-- Bootstrap 3.3.7 -->
<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.css">

    <style>
        *, *:before, *:after {
	 box-sizing: border-box;
}
 html {
	 overflow-y: scroll;
}
 body {
	 background: #c1bdba;
	 font-family: 'Titillium Web', sans-serif;
}
 a {
	 text-decoration: none;
	 color: #1ab188;
	 transition: 0.5s ease;
}
 a:hover {
	 color: #179b77;
}
 .form {
	 background: rgba(19, 35, 47, .9);
	 padding: 40px;
	 max-width: 600px;
	 margin: 40px auto;
	 border-radius: 4px;
	 box-shadow: 0 4px 10px 4px rgba(19, 35, 47, .3);
}
 .tab-group {
	 list-style: none;
	 padding: 0;
	 margin: 0 0 40px 0;
}
 .tab-group:after {
	 content: "";
	 display: table;
	 clear: both;
}
 .tab-group li a {
	 display: block;
	 text-decoration: none;
	 padding: 15px;
	 background: rgba(160, 179, 176, .25);
	 color: #a0b3b0;
	 font-size: 20px;
	 float: left;
	 width: 50%;
	 text-align: center;
	 cursor: pointer;
	 transition: 0.5s ease;
}
 .tab-group li a:hover {
	 background: #179b77;
	 color: #fff;
}
 .tab-group .active a {
	 background: #1ab188;
	 color: #fff;
}
 .tab-content > div:last-child {
	 display: none;
}
 h1 {
	 text-align: center;
	 color: #fff;
	 font-weight: 300;
	 margin: 0 0 40px;
}
 label {
	 position: absolute;
	 transform: translateY(6px);
	 left: 13px;
	 color: rgba(255, 255, 255, .5);
	 transition: all 0.25s ease;
	 -webkit-backface-visibility: hidden;
	 pointer-events: none;
	 font-size: 22px;
}
 label .req {
	 margin: 2px;
	 color: #1ab188;
}
 label.active {
	 transform: translateY(50px);
	 left: 2px;
	 font-size: 14px;
}
 label.active .req {
	 opacity: 0;
}
 label.highlight {
	 color: #fff;
}
 input, textarea {
	 font-size: 22px;
	 display: block;
	 width: 100%;
	 padding: 5px 10px;
	 background: none;
	 background-image: none;
	 border: 1px solid #a0b3b0;
	 color: #fff;
	 border-radius: 0;
	 transition: border-color 0.25s ease, box-shadow 0.25s ease;
}
 input:focus, textarea:focus {
	 outline: 0;
	 border-color: #1ab188;
}
 textarea {
	 border: 2px solid #a0b3b0;
	 resize: vertical;
}
 .field-wrap {
	 position: relative;
	 margin-bottom: 40px;
}
 .top-row:after {
	 content: "";
	 display: table;
	 clear: both;
}
 .top-row > div {
	 float: left;
	 width: 48%;
	 margin-right: 4%;
}
 .top-row > div:last-child {
	 margin: 0;
}
 .button {
	 border: 0;
	 outline: none;
	 border-radius: 0;
	 padding: 15px 0;
	 font-size: 2rem;
	 font-weight: 600;
	 text-transform: uppercase;
	 letter-spacing: 0.1em;
	 background: #1ab188;
	 color: #fff;
	 transition: all 0.5s ease;
	 -webkit-appearance: none;
}
 .button:hover, .button:focus {
	 background: #179b77;
}
 .button-block {
	 display: block;
	 width: 100%;
}
 .forgot {
	 margin-top: -20px;
	 text-align: right;
}
 
    </style>
</head>
    <body>
    <?php if (isset($pesan)) {?>
    <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert"> X </button>
        <h4>Peringatan</h4>
        <?php echo $pesan; ?>
    </div>
    <?php       } ?>

            <div class="form">
            
            <ul class="tab-group">
                <li class="tab active"><a id="btn_panel_signup" href="#signup">Sign Up</a></li>
                <li class="tab"><a id="btn_panel_login" href="#login">Log In</a></li>
            </ul>
            
            <div class="tab-content">
                <div id="signup">   
                <h1>Sign Up for Free</h1>
                
                <form action="<?php echo base_url('cLogin/save')?>" method="post">
                
                <!-- <div class="field-wrap">
                  
                    <input type="hidden" name="login" required autocomplete="off"/>
                </div> -->
          
                <div class="top-row">
                    <div class="field-wrap">
                    <label>
                        First Name<span class="req">*</span>
                    </label>
                    <input type="text" name="namadepan" required autocomplete="off" />
                    </div>
                
                    <div class="field-wrap">
                    <label>
                        Last Name<span class="req">*</span>
                    </label>
                    <input type="text" name="namabelakang" required autocomplete="off"/>
                    </div>
                </div>

                <div class="field-wrap">
                    <label>
                    Username<span class="req">*</span>
                    </label>
                    <input type="text" name="user" required autocomplete="off"/>
                </div>

                <div class="field-wrap">
                    <label>
                    Email Address<span class="req">*</span>
                    </label>
                    <input type="email" name="email" required autocomplete="off"/>
                </div>
                
                <div class="field-wrap">
                    <label>
                    Set A Password<span class="req">*</span>
                    </label>
                    <input type="password" name="pass" required autocomplete="off"/>
                </div>
                
                <button type="submit" class="button button-block"/>Get Started</button>
                
                </form>

                </div>
                
                <div id="login">  
				<?php if($this->session->flashdata('msg_login')){ ?>
					<div class="alert alert-danger" role="alert">
						<?= $this->session->flashdata('msg_login'); ?>
					</div>
				<?php } ?> 
                <h1>Welcome Back!</h1>
                
                <form id="frm_login" action="<?php echo base_url('cLogin/login') ?>" method="post">
                
                    <div class="field-wrap">
                    <label>
                    Email Address<span class="req">*</span>
                    </label>
                    <input type="email" name="email" required autocomplete="off"/>
                </div>
                
                <div class="field-wrap">
                    <label>
                    Password<span class="req">*</span>
                    </label>
                    <input type="password" name="pass" required autocomplete="off"/>
                </div>
                
                <p class="forgot"><a href="#">Forgot Password?</a></p>
                
                <button class="button button-block"/>Log In</button>
                
                </form>

                </div>
                
            </div><!-- tab-content -->
            
        </div> <!-- /form -->



<!-- jQuery -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery/jquery.min.js')?>"></script>

<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/jquery-ui/jquery-ui.min.js')?>"></script>
<!-- Sweetalert -->
<script src="<?php echo base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.all.min.js')?>"></script>
<script src="<?php echo base_url('assets/AdminLTE/plugins/sweetalert2/sweetalert2.min.js')?>"></script>


    </body>
<!-- 
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> -->

    <script type="text/javascript">
    $('.form').find('input, textarea').on('keyup blur focus', function (e) {
  
  var $this = $(this),
      label = $this.prev('label');

	  if (e.type === 'keyup') {
			if ($this.val() === '') {
          label.removeClass('active highlight');
        } else {
          label.addClass('active highlight');
        }
    } else if (e.type === 'blur') {
    	if( $this.val() === '' ) {
    		label.removeClass('active highlight'); 
			} else {
		    label.removeClass('highlight');   
			}   
    } else if (e.type === 'focus') {
      
      if( $this.val() === '' ) {
    		label.removeClass('highlight'); 
			} 
      else if( $this.val() !== '' ) {
		    label.addClass('highlight');
			}
    }

});

$('.tab a').on('click', function (e) {
  
  e.preventDefault();
  
  $(this).parent().addClass('active');
  $(this).parent().siblings().removeClass('active');
  
  target = $(this).attr('href');

  $('.tab-content > div').not(target).hide();
  
  $(target).fadeIn(600);
  
});

$("form#frm_login").submit(function(ev){
	ev.preventDefault();
	var this_data = $(this).serialize();
	$.ajax({ 
		type: 'POST', 
		url: 'CLogin/login', 
		data: this_data, 
		dataType: 'json',
		success: function (res_data) {
			if(res_data.res == false){
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: 'Something went wrong!, Username dan Password salah',
				
				}).then((result) => {
					window.location.href=res_data.url;
				})
				// window.location.href=res_data.url;
			}else{
				Swal.fire({
					icon: 'success',
					title: 'Horey..',
					text: 'Login Berhasil',
				
				}).then((result) => {
					window.location.href=res_data.url;
				})
			}
		}
	});
});

<?php if($this->session->flashdata('msg_login')){ ?>
	$("#btn_panel_login").click();
<?php } ?> 

    </script>
</html>