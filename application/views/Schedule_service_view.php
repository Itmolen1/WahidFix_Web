<div class="banner-area banner-bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    <h2>Schedule Service</h2>
                    <ul class="page-title-link">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Schedule Service</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script> 
    function onLoad() {
  var input = document.getElementById("prefferd_date");
  var today = new Date();
  // Set month and day to string to add leading 0
  var day = new String(today.getDate());
  var mon = new String(today.getMonth()+1); //January is 0!
  var yr = today.getFullYear();

    if(day.length < 2) { day = "0" + day; }
    if(mon.length < 2) { mon = "0" + mon; }

    var date = new String( yr + '-' + mon + '-' + day );

  input.disabled = false; 
  input.setAttribute('min', date);
}
document.addEventListener('load', onLoad, false);
/*function form_validation()                                    
{ 
    var tbl_user_name = document.forms["registrationform"]["tbl_user_name"];               
    var tbl_user_email = document.forms["registrationform"]["tbl_user_email"];    
    var tbl_user_mobile = document.forms["registrationform"]["tbl_user_mobile"];  
    var password =  document.forms["registrationform"]["password"];  
    var password2 = document.forms["registrationform"]["password2"];  
      
    if (tbl_user_name.value == "")                                  
    { 
        window.alert("Please enter your name."); 
        tbl_user_name.focus(); 
        return false; 
    } 
   
    if (tbl_user_email.value == "")                               
    { 
        window.alert("Please enter your email address."); 
        tbl_user_email.focus(); 
        return false; 
    } 
       
    if (tbl_user_mobile.value == "")                                   
    { 
        window.alert("Please enter a valid mobile number."); 
        tbl_user_mobile.focus(); 
        return false; 
    } 
   
    if (password.value.indexOf("@", 0) < 0)                 
    { 
        window.alert("Please enter a valid password."); 
        password.focus(); 
        return false; 
    } 
   
    if (password2.value.indexOf(".", 0) < 0)                 
    { 
        window.alert("Please enter a valid password match."); 
        password2.focus(); 
        return false; 
    }  
    return true; 
}*/</script>    

    <div id="contact" class="section wb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Schedule Service</h3>
                <?php 
                //echo "<pre>";print_r($sr);
                $last = $this->uri->total_segments();
                $record_num = $this->uri->segment($last);
                ?>
                <p class="lead"></p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        echo form_open($action,'id="schedule_service_form" class="row" name="schedule_service_form" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">

                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Name</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="tbl_user_name" id="tbl_user_name" class="form-control" placeholder="Name" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_name']; ?>" readonly>
                                </div>
                                </fieldset>

                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Email</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="email" name="tbl_user_email" id="tbl_user_email" class="form-control" placeholder="Your Email" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_email']; ?>" readonly>
                                </div>
                                </fieldset>

                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Mobile</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="tbl_user_mobile" id="tbl_user_mobile" class="form-control" placeholder="Your mobile number" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_mobile']; ?>" readonly>
                                </div>
                                </fieldset>

                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Service</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="service_name" id="service_name" class="form-control" placeholder="service_name" required="required" value="<?php echo $record_num; ?>" readonly>
                                </div>
                                </fieldset>

                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Prefferd Date</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="date" name="prefferd_date" id="prefferd_date" class="form-control" placeholder="prefferd_date" required="required" value="<?php echo $record_num; ?>">
                                </div>
                                </fieldset>                               
                                
                                <fieldset class="row-fluid">
                                <label for="username" class="lead">Prefferd Time</label>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <select required name="prefferd_time" id="prefferd_time" class="form-control">
                                  <option value="">Select Option</option>
                                  <?php foreach($time_slot as $time) { ?>
                                    <option value="<?php echo $time['time_slot_id']; ?>"><?php echo $time['time_slot_name']; ?></option>
                                  <?php } ?>
                                </select>
                                </div>
                                </fieldset>

                                <input type="hidden" name="tbl_user_id" id="tbl_user_id" class="form-control" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_id']; ?>">

                                <input type="hidden" name="service_id" id="service_id" class="form-control" required="required" value="<?php echo $sr['service_id']; ?>">

                               
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Schedule</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            
            
        </div><!-- end container -->
    </div><!-- end section -->
<script type="text/javascript">

document.forms['schedule_service_form'].reset();   
    function checkPass() {
    
var get_elem = document.getElementById,
pass1 = document.getElementById('password'),
pass2 = document.getElementById('password2'),
message = document.getElementById('confirmMessage'),
colors = {
goodColor: "#fff",
goodColored: "#087a08",
badColor: "#fff",
badColored:"#ed0b0b"
},
strings = {
"confirmMessage": ["Password Matched", "Password not matching"]
};

if(password.value === password2.value && (password.value + password2.value) !== "") {
password2.style.backgroundColor = colors["goodColor"];
message.style.color = colors["goodColored"];
message.innerHTML = strings["confirmMessage"][0];
}
else if(!(password2.value === "")) {
password2.style.backgroundColor = colors["badColor"];
message.style.color = colors["badColored"];
message.innerHTML = strings["confirmMessage"][1];
}
else {
message.innerHTML = ""; 
}

}  
</script>