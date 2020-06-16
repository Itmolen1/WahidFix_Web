<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list"></i> Services Management
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
                        <h3 class="box-title">Enter Service Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewservice" action="<?php echo base_url().$action?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="fname">Service Name</label>
                                        <?php
                                            $last = $this->uri->total_segments();
                                            $record_num = $this->uri->segment($last);
                                            if(is_numeric($record_num))
                                            {
                                                ?>
                                                <input type="hidden" name="service_id" value="<?php echo $servicesInfo->service_id; ?>" id="service_id">
                                                <?php
                                            }
                                        ?>
                                        <input type="text" class="form-control required" value="<?php echo isset($servicesInfo->service_name) ? $servicesInfo->service_name : ""; ?>" id="service_name" name="service_name" maxlength="128" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="service_desc">Service Desc</label>
                                        <textarea class="ckeditor input" id="service_desc" name="service_desc"><?php echo isset($servicesInfo->service_desc) ? $servicesInfo->service_desc : ""; ?></textarea>
                                    </div>

                                     <div class="form-group">
                                        <label for="fname">Detail Page URL</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($servicesInfo->detail_page) ? $servicesInfo->detail_page : ""; ?>" id="detail_page" name="detail_page">
                                    </div>

                                    <div class="form-group">
                                        <label for="fname"><?php if(is_numeric($record_num)) echo "update "; ?>Service Logo</label>
                                        <input type="file" class="form-control required" value="<?php echo isset($servicesInfo->service_logo) ? $servicesInfo->service_logo : ""; ?>" id="service_logo" name="service_logo">
                                    </div>
                                    <?php if(is_numeric($record_num)) { ?>
                                    <div class="form-group">
                                        <label for="fname">Current Service Logo</label>
                                        <img height="128" width="128" src="<?php echo $servicesInfo->service_logo; ?>">
                                    </div>
                                <?php } ?>
                                <?php
                                    if(is_numeric($record_num))
                                    {
                                        ?>
                                        <input type="hidden" name="service_logo_old" value="<?php echo $servicesInfo->service_logo; ?>" id="service_logo_old">
                                        <?php
                                    }
                                ?>
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
<?php 
    $last = $this->uri->total_segments();
    $record_num = $this->uri->segment($last);
    if(is_numeric($record_num))
        {    echo "";   }
    else
    { 
        ?>
        <script src="<?php echo base_url(); ?>assets/js/addNewService.js" type="text/javascript"></script>
        <?php
        
    } 
?>
 