
    <div id="contact" class="section wb">
        <div class="container">
            <?php
             if(isset($this->session->userdata['suc_register'])) { ?>
                <script>
                    $(document).ready(function() {
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                          $("#success-alert").slideUp(500);
                        });
                    });
                </script>
                <div class="alert alert-success" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Success! </strong> You Have Successfully Registered With Us Please Proceed With Login.
                </div>
            <?php
            $this->session->unset_userdata('suc_register'); 
            } ?>

            <?php
             if(isset($this->session->userdata['invalid_login'])) { ?>
                <script>
                    $(document).ready(function() {
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                          $("#success-alert").slideUp(500);
                        });
                    });
                </script>
                <div class="alert alert-danger" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Sorry! </strong>Invalid Username or Password .
                </div>
            <?php
            $this->session->unset_userdata('invalid_login'); 
            } ?>

            <div class="section-title text-center">
                <h3>Log In</h3>
                <p class="lead">Log in to your account</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        echo form_open($action,'id="loginform" class="row" name="loginform" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">
                                <fieldset class="row-fluid">
                                    <label for="username" class="lead">User Name</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="username" id="username" class="form-control" placeholder="your username" required="required" maxlength="30">
                                    </div>
                                </fieldset>
                                <fieldset class="row-fluid">
                                    <label for="username" class="lead">Password</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="password" id="password" class="form-control" placeholder="your password" required="required" maxlength="30">
                                        </div>
                                </fieldset>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Login</button>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                	<a href="<?php echo base_url().'Forgot_password'; ?>">Forgot Password ?</a>
                                </div>
                            </fieldset>
                        </form>
                       
                    </div>
                     <div class="row">
                            <div class="well">
                            <span>Don't have a <?php echo APP_NAME; ?> account? <a href="<?=base_url()?>register">Create one</a></span>
                            </div>
                        </div>
                </div><!-- end col -->

            </div><!-- end row -->
            
           
                    
            
        </div><!-- end container -->
    </div><!-- end section -->
