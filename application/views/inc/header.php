<!DOCTYPE html>
<html lang="en">
<?php //echo base_url();die; ?>
    <!-- Basic -->
    
    <meta name="robots" content="nofollow">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Welcome to the largest multiple maintenance company in the UAE. Get AC Services,Plumbing Services,Electric Services,Glass work Services,Gypsum Ceiling,Painting services,Masonary Services and much more. Visit Now!" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="AC Services Dubai | <?php echo APP_NAME; ?>" />
    <meta property="og:description" content="Welcome to the largest multiple maintenance company in the UAE. Get AC Services,Plumbing Services,Electric Services,Glass work Services,Gypsum Ceiling,Painting services,Masonary Services and much more. Visit Now!" />
    <meta property="og:url" content="https://wahidfix.com/" />
    <meta property="og:site_name" content="Wahidfix" />
    <meta name="twitter:card" content="Wahidfix" />
    <meta name="twitter:description" content="Welcome to the largest multiple maintenance company in the UAE. Get AC Services,Plumbing Services,Electric Services,Glass work Services,Gypsum Ceiling,Painting services,Masonary Services and much more. Visit Now!" />
    <meta name="twitter:title" content="Various Maintenance Service Provider in UAE | Wahidfix Services" />   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=yes">
 
     <!-- Site Metas -->
    <title><?php echo APP_NAME; ?> - Service Provider</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Google Tag Manager -->
   
    <!-- End Google Tag Manager -->

    <!-- Site Icons -->
    <link rel="shortcut icon" href="<?=base_url()?>favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="<?=base_url()?>assets/images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="<?=base_url()?>style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>assets/css/custom.css">

    <script src="<?php echo base_url(); ?>admin/assets/bower_components/jquery/dist/jquery.min.js"></script>

    <style>
    ::-moz-selection { /* Code for Firefox */
    color: #ffffff;
    background: #fd6802;
    }

    ::selection {
    color: #ffffff;
    background: #fd6802;
    }
    </style>

    <style>
    	.fixed_button{
    		display: block;
		    left: 0;
		    top: 84%;
		    position: fixed;
		    -webkit-transform: rotate(-90deg);
		    -moz-transform: rotate(-90deg);
		    -o-transform: rotate(-90deg);
		    -ms-transform: rotate(-90deg);
		    transform-origin: left top 0;
		    color: #fd6802;
		    border-color: #414042;
		    letter-spacing: 1px;
		    font-size: 12px;
		    text-transform: uppercase!important;
		    background-color: #414042;
		    padding: 7px 28px!important;
		    font-family: 'Oswald',Helvetica,Arial,Lucida,sans-serif;
		    margin: 0;
		    border-radius: 3px;
		    z-index: 999;
		    transition: all .3s ease-in-out 0s;
		    background: #23282d!important;
    	}
    </style>

    <!-- Modernizer for Portfolio -->
    <script defer src="<?=base_url()?>assets/js/modernizer.js"></script>
    
    <script>
    $(function() {
  $("#payment_record_form").validate({
    rules: {
      tbl_guest_user_name: {
        required: true
      },
      tbl_guest_user_mobile: {
        required: true
      },
      tbl_guest_user_email: {
        required: true
      },
      tbl_guest_user_service_name : { required : true, selected : true},
      tbl_guest_user_service_date: {
        required: true
      },
      tbl_guest_user_service_time : { required : true, selected : true},
      action: "required"
    },
    messages: {
      tbl_guest_user_name: {
        required: "Please enter name"
      },
      tbl_guest_user_mobile: {
        required: "Please enter mobile number"
      },
      tbl_guest_user_email: {
        required: "Please enter email address"
      },
      tbl_guest_user_service_name : { required : "This field is required", selected : "Please select atleast one option" },
      tbl_guest_user_service_date: {
        required: "Please select date"
      },
      tbl_guest_user_service_time : { required : "This field is required", selected : "Please select atleast one option" },
      action: "Please provide some data"
    }
  });
});    
</script>

    <script>
	    jQuery(document).on("click", ".fixed_button", function(){
	    
	        var baseURL = '<?php echo base_url(); ?>';
	        var hitURL = baseURL + "get_guest_user_vals";
	        $.ajax({
	            type : "GET",
	            dataType : "json",
	            url : hitURL
	            }).done(function(data){
	               	//alert(JSON.stringify(data));
	                //window.open(data,'_blank');
	                //var data = JSON.parse(data);
	                var select = $("#tbl_guest_user_service_name"), options = '';
				    select.empty(); 
				    options+="<option value='0'>Select Service</option>";     
				    for(var i=0;i<data.length;i++)
				    {
				    	options += "<option value='"+data[i].service_name+"'>"+ data[i].service_name +"</option>";   
				    }
				    select.append(options);
	                console.log(data);                 
	            });
	    $("#payment_record_form").submit(function(event){
            
            alert('We have received your request we will contact you as soon as possible. Thanks.');
            submitForm();
	        //return false;
	    });
	});
	</script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<body>
	<!--/////////////////////-->
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXPM4RT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="contact-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-footer">                
                <h3 style="margin-right: 400px;">Schedule A Service</h3>
                <button type="button" class="btn" data-dismiss="modal">X</button>
            </div>
            <form id="payment_record_form" name="contact" method="post" action="<?php echo base_url().'add_guest'; ?>">
                <div class="modal-body">

                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_name">Name :</label>
                            <input type="text" name="tbl_guest_user_name" id="tbl_guest_user_name" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' maxlength="30">
                        </div>
                    </div>

                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_mobile">Mobile :</label>
                            <input type="text" name="tbl_guest_user_mobile" id="tbl_guest_user_mobile" class="form-control" maxlength="15" required onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))' pattern="[1-9]{1}[0-9]{9}">
                        </div>
                    </div>

                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_email">E-Mail :</label>
                            <input type="text" name="tbl_guest_user_email" id="tbl_guest_user_email" class="form-control" maxlength="40">
                        </div>
                    </div> 
                    
                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_service_name">Service Type</label>
                            <select class="form-control required" id="tbl_guest_user_service_name" name="tbl_guest_user_service_name">
                            </select>
                        </div>
                    </div>

                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_service_date">Preffered Date</label>
                            <input type="date" class="form-control required" id="tbl_guest_user_service_date" name="tbl_guest_user_service_date">
                        </div>
                    </div>

                    <div class="row">               
                        <div class="col-md-8">
                            <label for="tbl_guest_user_service_time">Preffered Time</label>
                            <select class="form-control required" id="tbl_guest_user_service_time" name="tbl_guest_user_service_time">
                            <option value="0">Select Time</option>
                            <option value="10:00 AM - 01:00 PM">10:00 AM - 01:00 PM</option>
                            <option value="01:00 PM - 04:00 PM">01:00 PM - 04:00 PM</option>
                            <option value="04:00 PM - 07:00 PM">04:00 PM - 07:00 PM</option>
                            </select>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="Send" class="btn btn-success" id="submit1" >
                </div>
            </form>
        </div>
    </div>
</div>
<!--/////////////////////-->

    <!-- LOADER -->
    <div id="preloader">
        <div class="loader">
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__bar"></div>
            <div class="loader__ball"></div>
        </div>
    </div><!-- end loader -->
    <!-- END LOADER -->
    
    <div class="top-bar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="left-top">
                        <div class="email-box">
                            <a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i>info@wahidfix.com</a>
                        </div>
                        <div class="phone-box">
                            <a href="tel:+971 557383866"><i class="fa fa-phone" aria-hidden="true"></i> +971 557383866</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="right-top">
                        <div class="social-box">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
                                <li><a href="#"><i class="fa fa-rss-square" aria-hidden="true"></i></a></li>
                                <?php if(isset($this->session->userdata['user']['tbl_user_email'])) { ?>
                            <li><i class="">Hello,<?php echo $this->session->userdata['user']['tbl_user_name'].'   '; ?></i><a href="<?=base_url()?>login/getlogout"><i class="" aria-hidden="true"></i>Logout</a></li>
                                <?php } else { ?>
                            <li><a href="<?=base_url()?>login/login"><i class="" aria-hidden="true"></i>Login</a></li>
                            <li></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="header header_style_01"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <nav class="megamenu navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?=base_url()?>assets/images/logos/logo.png" alt="wahidfix" height="51" width="180"></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-right">
                    	<?php 
                    	$last = $this->uri->total_segments();
            			$record_num = $this->uri->segment($last);
            			?>
                        <li><a <?php if(!$record_num){ echo 'class="active"'; } ?> href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a <?php if($record_num=='About'){ echo 'class="active"'; } ?> href="<?=base_url();?>About">About us</a></li>
                        <li><a <?php if($record_num=='Services'){ echo 'class="active"'; } ?> href="<?=base_url();?>Services">Our Services</a></li>
                        <?php /*<li><a href="portfolio.html">Portfolio</a></li>*/?>
                        <li><a <?php if($record_num=='Booknow'){ echo 'class="active"'; } ?> href="<?=base_url();?>Booknow">Book Now</a></li>
                        <li><a <?php if($record_num=='Contact'){ echo 'class="active"'; } ?> href="<?=base_url();?>Contact">Contact Us</a></li>
                        <li><a <?php if($record_num=='Careers'){ echo 'class="active"'; } ?> href="<?=base_url();?>Careers">Careers</a></li>
                        <li><a <?php if($record_num=='Partner'){ echo 'class="active"'; } ?> href="<?=base_url();?>Partner">Partner</a></li>
                        <?php if($this->session->userdata('user')){?><li><a <?php if($record_num=='service_taken'){ echo 'class="active"'; } ?> href="<?=base_url()?>service_taken">Services Taken</a></li><?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>