<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-sliders"></i> Slider Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Slider</small>
                    
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Slider Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewslider" action="<?php echo base_url().$action?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    
                                    <?php
                                        $last = $this->uri->total_segments();
                                        $record_num = $this->uri->segment($last);
                                        if(is_numeric($record_num))
                                        {
                                            ?>
                                            <input type="hidden" name="slider_id" value="<?php echo $sliderInfo->slider_id; ?>" id="slider_id">
                                            <?php
                                        }
                                    ?>
                                
                                    <div class="form-group">
                                        <label for="fname"><?php if(is_numeric($record_num)) echo "update "; ?>Select Slider Image</label>
                                        <input type="file" class="form-control required" value="<?php echo isset($sliderInfo->slider_image) ? $sliderInfo->slider_image : ""; ?>" id="slider_image" name="slider_image">
                                    </div>
                                    <?php if(is_numeric($record_num)) { ?>
                                    <div class="form-group">
                                        <label for="fname">Current Slider Image</label>
                                        <img height="128" width="128" src="<?php echo $sliderInfo->slider_image; ?>">
                                    </div>
                                <?php } ?>
                                <?php
                                    if(is_numeric($record_num))
                                    {
                                        ?>
                                        <input type="hidden" name="slider_image_old" value="<?php echo $sliderInfo->slider_image; ?>" id="slider_image_old">
                                        <?php
                                    }
                                ?>
                                     <div class="form-group">
                                        <label for="fname">Slider Image Alt</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($sliderInfo->slider_image_alt) ? $sliderInfo->slider_image_alt : ""; ?>" id="slider_image_alt" name="slider_image_alt" maxlength="10000" >
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
<script src="<?php echo base_url(); ?>assets/js/addNewslider.js" type="text/javascript"></script>