
    <div id="contact" class="section wb">
        <div class="container">

            <div class="row">
                <P class="lead text-center"> <?php //var_dump($this->session->flashdata('message')); 
                echo $this->session->flashdata('message'); ?></P>
            </div>

            <div class="section-title text-center">
                <h3>Reset Your Password</h3>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        echo form_open($action,'id="forgot_password_form" class="row" name="forgot_password_form" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">
                                <fieldset class="row-fluid">
                                    <label for="email" class="lead">Enter Your Registered Email Address</label>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="email" name="email" id="email" class="form-control"  required="required">
                                    </div>
                                </fieldset>                             

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Reset</button>
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
