
    <div id="contact" class="section wb">
        <div class="container">

            <div class="row">
                <P class="lead text-center"> <?php //var_dump($this->session->flashdata('message')); 
                echo $this->session->flashdata('message'); ?></P>
            </div>

            <div class="section-title text-center">
                <h3>Log In</h3>
                <p class="lead">Reset your Password</p>
            </div><!-- end title -->

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        echo form_open($action,'id="resetpasswordform" class="row" name="resetpasswordform" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">
                                
                                <fieldset class="row-fluid">
                                    <label for="username" class="lead"> New Password</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="password" id="password" class="form-control" required="required">
                                        </div>
                                </fieldset>

                                <fieldset class="row-fluid">
                                    <label for="username" class="lead"> Confirm New Password</label>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <input type="password" name="password" id="password" class="form-control" required="required">
                                        </div>
                                </fieldset>

                                <input type="hidden" name="token" id="token" value="<?php echo $token; ?>">

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
