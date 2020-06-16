<div class="content-wrapper">
    <?php //echo "<pre>";print_r($list);die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-alt"></i> Sub Services Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Service</small>
                    
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Sub Service Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_subservice" action="<?php echo base_url().$action?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="service_id">Parent Service</label>
                                        <select class="form-control required" id="service_id" name="service_id" tabindex="1">
                                            <option value="0">Select Parent Service</option>
                                            <?php
                                            if(!empty($services))
                                            {

                                                foreach ($services as $l)
                                                {

                                                    ?>
                                                    <option value="<?php echo $l['service_id']; ?>" <?php if(isset($list) && $l['service_id'] == $list['service_id']) {echo "selected=selected";} ?>><?php echo $l['service_name']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="fname">Sub Service Name</label>
                                        <?php
                                            $last = $this->uri->total_segments();
                                            $record_num = $this->uri->segment($last);
                                            if(is_numeric($record_num))
                                            {
                                                ?>
                                                <input type="hidden" name="sub_service_id" value="<?php echo $list['sub_service_id']; ?>" id="sub_service_id" >
                                                <?php
                                            }
                                        ?>
                                        <textarea class="ckeditor input" id="sub_service_name" name="sub_service_name"><?php echo isset($list['sub_service_name']) ? $list['sub_service_name'] : ""; ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="fname"><?php if(is_numeric($record_num)) echo "update "; ?>Sub Service Logo</label>
                                        <input type="file" class="form-control" value="<?php echo isset($list['sub_service_image']) ? $list['sub_service_image'] : ""; ?>" id="sub_service_image" name="sub_service_image">
                                    </div>

                                    <?php if(is_numeric($record_num)) { ?>
                                    <div class="form-group">
                                        <label for="fname">Current subService Logo</label>
                                        <img height="128" width="128" src="<?php echo $list['sub_service_image']; ?>">
                                    </div>
                                    <?php } ?>
                                    <?php
                                    if(is_numeric($record_num))
                                    {
                                        ?>
                                        <input type="hidden" name="sub_service_image_old" value="<?php echo $list['sub_service_image']; ?>" id="sub_service_image_old">
                                        <?php
                                    }
                                ?>
                                    
                                </div>    
                                </div>
                            </div>
                        </div><!-- /.box-body -->
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Submit" tabindex="3" />
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
<script src="<?php echo base_url(); ?>assets/js/add_new_subservice.js" type="text/javascript"></script>