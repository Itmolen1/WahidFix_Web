<div class="content-wrapper">
    <?php //echo "<pre>";print_r($list);die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck"></i>Service Request Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Service Request</small>
                    
      </h1>
    </section>
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Service Request Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewservice" action="<?php echo base_url().$action?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_id">Service Name</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($sr['service_name']) ? $sr['service_name'] : ""; ?>" id="sub_service_name" name="sub_service_name" maxlength="200" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Prefferd Date</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($sr['prefferd_date']) ? $sr['prefferd_date'] : ""; ?>" id="prefferd_date" name="prefferd_date" maxlength="200" readonly>
                                    </div>
                                </div>
                                 <?php
                                if(isset($record_num))
                                {
                                    ?><input type="hidden" id="sr_id" name="sr_id" value="<?php echo $record_num; ?>"><?php
                                }
                            ?>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">User Name</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($sr['tbl_user_name']) ? $sr['tbl_user_name'] : ""; ?>" id="tbl_user_name" name="tbl_user_name" maxlength="200" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="fname">Prefferd Time</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($sr['prefferd_time']) ? $sr['prefferd_time'] : ""; ?>" id="prefferd_time" name="prefferd_time" maxlength="200" readonly>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Status</label>
                                        <select disabled="true" class="form-control required" id="status" name="status" readonly>
                                            <option value="0" <?php if($sr['status']==0) {echo "selected=selected";} ?>>New</option>
                                            <option value="0" <?php if($sr['status']==1) {echo "selected=selected";} ?>>Assigned</option>
                                            <option value="0" <?php if($sr['status']==2) {echo "selected=selected";} ?>>In Progress</option>
                                            <option value="0" <?php if($sr['status']==3) {echo "selected=selected";} ?>>Completed</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="assigned_emp_id">Select Employee</label>
                                        <select class="form-control required" id="assigned_emp_id" name="assigned_emp_id">
                                            <?php for($i=0;$i<count($emp);$i++) { ?>
                                            <option value="<?php echo $emp[$i]['tbl_employee_id']; ?>" <?php //if($sr['status']==0) {echo "selected=selected";} ?>><?php echo $emp[$i]['tbl_employee_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
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
<script src="<?php echo base_url(); ?>assets/js/addUser.js" type="text/javascript"></script>