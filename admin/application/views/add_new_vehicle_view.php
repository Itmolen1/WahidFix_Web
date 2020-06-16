<script type="text/javascript">
    $(function () {
    $('.selectpicker').selectpicker();
});
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-bus"></i> Vehicle Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    $this->session->set_userdata('referred_from', current_url());
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Vehicle</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Vehicle Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_vehicle" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php
                                if(isset($record_num))
                                {
                                    ?><input type="hidden" id="vehicle_id" name="vehicle_id" value="<?php echo $record_num; ?>"><?php
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vehicle_no">Vehicle No</label>
                                        <input type="text" class="form-control required" value="<?php if(isset($vehicle)){ echo $vehicle['vehicle_no']; } ?>" id="vehicle_no" name="vehicle_no" maxlength="128" <?php if(isset($vehicle)){ echo "disabled"; } ?>>
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_tc_no">TC Number</label>
                                        <input type="text" class="form-control required" id="vehicle_tc_no" value="<?php if(isset($vehicle)){ echo $vehicle['vehicle_tc_no']; } ?>" name="vehicle_tc_no" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vehicle_insurance_img"> Insurance Image</label>
                                        <input type="file" class="form-control <?php if(!isset($vehicle)){ echo 'required'; } ?>" id="vehicle_insurance_img" name="vehicle_insurance_img">
                                    </div>
                                    <?php if(isset($vehicle)){ ?>
                                    <div class="form-group">
                                        <label for="vehicle_insurance_img">Current Insurance Image</label>
                                        <img src="<?php echo $vehicle['vehicle_insurance_img']; ?>" height="200" width="250">
                                        <input type="hidden" name="vehicle_insurance_img_old" value="<?php echo $vehicle['vehicle_insurance_img']; ?>" id="vehicle_insurance_img_old">
                                    </div>
                                <?php }  ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_insurance_exp_date">Insurance Exp Date</label>
                                        <input type="date" class="form-control required" value="<?php if(isset($vehicle)){ echo $vehicle['vehicle_insurance_exp_date']; } ?>" id="vehicle_insurance_exp_date" name="vehicle_insurance_exp_date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_mulkia_front_img"> Mulkia Front Image</label>
                                        <input type="file" class="form-control <?php if(!isset($vehicle)){ echo 'required'; } ?>" id="vehicle_mulkia_front_img" name="vehicle_mulkia_front_img">
                                    </div>
                                    <?php if(isset($vehicle)){ ?>
                                    <div class="form-group">
                                        <label for="vehicle_mulkia_front_img">Current Mulkia Back Image</label>
                                        <img src="<?php echo $vehicle['vehicle_mulkia_front_img']; ?>" height="200" width="250">
                                        <input type="hidden" name="vehicle_mulkia_front_img_old" value="<?php echo $vehicle['vehicle_mulkia_front_img']; ?>" id="vehicle_mulkia_front_img_old">
                                    </div>
                                <?php }  ?>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_mulkia_back_img">Mulkia Back Image</label>
                                        <input type="file" class="form-control <?php if(!isset($vehicle)){ echo 'required'; } ?>" id="vehicle_mulkia_back_img" name="vehicle_mulkia_back_img">
                                    </div>
                                    <?php if(isset($vehicle)){ ?>
                                    <div class="form-group">
                                        <label for="vehicle_mulkia_back_img">Current Mulkia Back Image</label>
                                        <img src="<?php echo $vehicle['vehicle_mulkia_back_img']; ?>" height="200" width="250">
                                        <input type="hidden" name="vehicle_mulkia_back_img_old" value="<?php echo $vehicle['vehicle_mulkia_back_img']; ?>" id="vehicle_mulkia_back_img_old">
                                    </div>
                                <?php }  ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_mulkia_exp_date">Mulkia Exp Date</label>
                                        <input type="date" class="form-control required" value="<?php if(isset($vehicle)){ echo $vehicle['vehicle_mulkia_exp_date']; } ?>" id="vehicle_mulkia_exp_date" name="vehicle_mulkia_exp_date">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vehicle_status">Status</label>
                                        <select class="form-control required" id="vehicle_status" name="vehicle_status">
                                            <option value="0">Select Status</option>
                                                <option value="1" <?php if(isset($vehicle) && $vehicle['vehicle_status']==1){ echo 'selected="selected"'; } ?>>Available</option>
                                                <option value="2" <?php if(isset($vehicle) && $vehicle['vehicle_status']==2){ echo 'selected="selected"'; } ?>>Busy</option>
                                        </select>
                                    </div>
                                </div>    
                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/add_new_vehicle_view.js" type="text/javascript"></script>