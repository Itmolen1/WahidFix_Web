    <div id="contact" class="section wb">
        <div class="container">
            <div class="section-title text-center">
                <h3>Register</h3>
                <p class="lead"></p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        //echo form_open($action,'id="registrationform" class="row" name="registrationform" method="post"'); 
                        ?>
                        <form action="http://wahidfix.com/index.php/register/add" id="registrationform" class="row" name="registrationform" method="post">
                            <fieldset class="row-fluid">
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="tbl_user_name" id="tbl_user_name" class="form-control" placeholder="Name" required="required" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' maxlength="30">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="email" name="tbl_user_email" id="tbl_user_email" class="form-control" placeholder="Your Email" required="required">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="tbl_user_mobile" id="tbl_user_mobile" class="form-control" placeholder="Your mobile number" required="required" maxlength="15" onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))'>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" onkeyup="checkPass()" required="required">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="password" name="password2" id="password2" class="form-control" placeholder="Reenter Password" onkeyup="checkPass()" required="required">
                                    <span id="confirmMessage" class="confirmMessage" ></span>
                                </div>
                               
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Register</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            
            
        </div><!-- end container -->
    </div><!-- end section -->
<script>

document.forms['registrationform'].reset();   
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