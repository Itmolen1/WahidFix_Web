<link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css' ?>" type="text/css" />
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.fr.js' ?>"></script>
    <div id="contact" class="section wb">
        <div class="container">

            <?php
             if(isset($this->session->userdata['suc_service'])) { ?>
                <script>
                    $(document).ready(function() {
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                          $("#success-alert").slideUp(500);
                        });
                    });
                </script>
                <div class="alert alert-success" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Success! </strong>We Have Successfully Registered your service request we will contact you ASAP.
                </div>
            <?php
            $this->session->unset_userdata('suc_service'); 
            } ?>
            
            <?php 
            //echo "<pre>";print_r($this->session->userdata);
            if(!isset($this->session->userdata['user']['tbl_user_email']))
            { 
            ?> 
            <div class="row">
                <P class="lead text-center"> Already A member ? please Login</P>
            </div>

            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8">
                    <a href="<?php echo base_url().'login'; ?>"><button style="width: 50%;" type="submit" value="submit" id="Loginbtn" class="btn btn-light btn-radius btn-brd grd1 btn-block">Login</button></a>
                </div>
            </div>

            <div class="row">
                <p style="text-align: center;">OR</p>
            </div>
            <?php } ?>

            <div class="section-title text-center">
                <h3>Book Now</h3>
                <p class="lead"></p>
            </div><!-- end title -->

            <div><h3><p style="text-align: center;"><?php echo $this->session->flashdata('message'); ?></p></h3></div>

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="contact_form">
                        <div id="message"></div>
                        <?php
                        echo form_open($action,'id="booknow" class="row" name="booknow" method="post"'); 
                        ?>
                            <fieldset class="row-fluid">

                               <?php 
                                if(isset($this->session->userdata['user']['tbl_user_email']))
                                { 
                                    $flag=1; 
                                ?>                                

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="tbl_user_name" class="lead">Name</label>
                                    <input type="text" name="tbl_user_name" id="tbl_user_name" class="form-control" placeholder="Name" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_name'];  ?>" maxlength="30" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                </div>
                                
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="tbl_user_mobile" class="lead">Mobile</label>
                                    <input type="text" name="tbl_user_mobile" id="tbl_user_mobile" class="form-control" placeholder="Your mobile number" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_mobile'];   ?>" maxlength="15" required onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))'">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="tbl_user_email" class="lead">Email</label>
                                    <input type="email" name="tbl_user_email" id="tbl_user_email" class="form-control" placeholder="Your Email" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_email']; ?>" maxlength="15">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="service_id" class="lead">Select Service</label>
                                    <select multiple class="form-control required selectpicker" id="service_id" name="service_id[]" required>
                                        <?php foreach($services as $service) { ?>
                                            <option value="<?php echo $service['service_id']; ?>"><?php echo $service['service_name'] ?></option>
                                        <?php } ?>
                                    </select>                                    
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="prefferd_date" class="lead">Prefferd Date</label>
                                    <input type="date" name="prefferd_date" id="prefferd_date" class="form-control" placeholder="prefferd_date" required="required">
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="prefferd_time" class="lead">Preffered</label>
                                    <select class="form-control" id="prefferd_time" name="prefferd_time" required>
                                        <option value="">Select Time</option>
                                        <option value="0">Anytime</option>
                                        <option value="1">10:00 AM - 01:00 PM</option>
                                        <option value="2">01:00 PM - 04:00 PM</option>
                                        <option value="3">04:00 PM - 07:00 PM</option>
                                    </select>                                    
                                </div>
                                
                                <input type="hidden" name="tbl_user_id" id="tbl_user_id" class="form-control" required="required" value="<?php echo $this->session->userdata['user']['tbl_user_id']; ?>">

                                <?php } else {  ?>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="tbl_guest_user_name" class="lead">Name</label>
                                    <input type="text" name="tbl_guest_user_name" id="tbl_guest_user_name" class="form-control" placeholder="Name" required="required" maxlength="30" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="tbl_guest_user_mobile" class="lead">Mobile</label>
                                        <input type="text" name="tbl_guest_user_mobile" id="tbl_guest_user_mobile" class="form-control" placeholder="Your mobile number" required="required" maxlength="15" required onkeypress='return ((event.charCode >= 48 && event.charCode <= 57))' >
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="tbl_guest_user_email" class="lead">Email</label>
                                        <input type="email" name="tbl_guest_user_email" id="tbl_guest_user_email" class="form-control" placeholder="Your Email" required="required" maxlength="40">
                                    </div>

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label for="service_id" class="lead">Select Service</label>
                                    <select multiple class="form-control required selectpicker" id="service_id" name="service_id[]" required>
                                        <?php foreach($services as $service) { ?>
                                            <option value="<?php echo $service['service_id']; ?>"><?php echo $service['service_name'] ?></option>
                                        <?php } ?>
                                    </select>                                    
                                </div>
                                    
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="tbl_guest_user_service_date" class="lead">Prefferd Date</label>
                                        <input type="date" name="tbl_guest_user_service_date" id="tbl_guest_user_service_date" class="form-control" required="required">
                                    </div>

                                    
                                    <?php /*<div class="input-group date form_date_date col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                    <label for="tbl_guest_user_service_date" class="lead">Prefferd Date</label>
                                      <input type="text" class="form-control"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                    </div>*/?>
                                    

                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label for="tbl_guest_user_service_time" class="lead">Preffered</label>
                                        <select class="form-control" id="tbl_guest_user_service_time" name="tbl_guest_user_service_time" required>
                                            <option value="">Select Time</option>
                                             <?php foreach($time_slots as $time) { ?>
                                            <option value="<?php echo $time['time_slot_id']; ?>"><?php echo $time['time_slot_name'] ?></option>
                                            <?php } ?>
                                        </select>                                    
                                    </div>

                                <?php } ?>
                               
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 text-center">
                                    <button type="submit" value="submit" id="submit" class="btn btn-light btn-radius btn-brd grd1 btn-block">Book Now</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div><!-- end col -->
            </div><!-- end row -->
            
            
        </div><!-- end container -->
    </div><!-- end section -->
<script type="text/javascript">
   
    $('.form_date_date').datetimepicker({
        language:  'en',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });    
</script>