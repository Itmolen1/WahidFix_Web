    <div class="banner-area banner-bg-1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="banner">
                        <h2>Contact Us</h2>
                        <ul class="page-title-link">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Contact US</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="contact" class="section wb">
        <div class="container">
           
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <form action="<?php echo base_url().'Contact/add'; ?>" method="post" id="contactform" name="contactform">
                        <?php
                        //echo form_open($action,'id="contactform" class="row" name="contactform" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" maxlength="30" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="email" name="email" id="email" class="form-control" placeholder="Your Email" maxlength="40" required >
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Your mobile number" maxlength="15" required onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))'>
                                </div>
                               
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <textarea class="form-control" name="comments" id="comments" rows="6" placeholder="Give us more details.." maxlength="200" required></textarea>
                                </div>
                                <div class="g-recaptcha col-lg-12 col-md-12 col-sm-12 col-xs-12" data-sitekey="6LfV98MUAAAAAPFIU3zMa0ST4LnGVPAVbWQQlyyr"></div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            
            <div class="row">
                <div class="col-md-offset-1 col-sm-10 col-md-10 col-sm-offset-1 pd-add">
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="icon icon-location2"></i>
                        </div>
                        <h3>Headquarters</h3>
                        <p>MUSSAFAH M13,PLOT 100 
                            <br>ABU DHABI,UAE</p>
                    </div>
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>info@wahidfix.com
                            <br>info@wahidfix.com</p>
                    </div>
                    <div class="address-item">
                        <div class="address-icon">
                            <i class="icon icon-headphones"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>+971 557383866
                            <br>+971 557383866</p>
                    </div>
                </div>
            </div><!-- end row -->
            
        </div><!-- end container -->
    </div><!-- end section -->
