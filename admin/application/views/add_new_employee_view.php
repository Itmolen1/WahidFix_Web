<script type="text/javascript">
    $(function () {
    $('.selectpicker').selectpicker();
});
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i> Employee Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    $this->session->set_userdata('referred_from', current_url());
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Employee</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Employee Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_employee" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php
                                if(isset($record_num))
                                {
                                    ?><input type="hidden" id="tbl_employee_id" name="tbl_employee_id" value="<?php echo $record_num; ?>"><?php
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="tbl_employee_name">Full Name</label>
                                        <input type="text" class="form-control required" value="<?php if(isset($employee)){ echo $employee['tbl_employee_name']; } ?>" id="tbl_employee_name" name="tbl_employee_name" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_email">Email address</label>
                                        <input type="text" class="form-control required email" id="tbl_employee_email" value="<?php if(isset($employee)){ echo $employee['tbl_employee_email']; } ?>" name="tbl_employee_email" maxlength="128" <?php if(isset($employee)){ echo 'disabled="disabled"'; } ?>>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_password">Password</label>
                                        <input type="password" class="form-control required" id="tbl_employee_password" name="tbl_employee_password" maxlength="20" value="<?php if(isset($employee)){ echo $employee['tbl_employee_password']; } ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ctbl_employee_password">Confirm Password</label>
                                        <input type="password" class="form-control required equalTo" id="ctbl_employee_password" name="ctbl_employee_password" maxlength="20" value="<?php if(isset($employee)){ echo $employee['tbl_employee_password']; } ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_mobile">Mobile Number</label>
                                        <input type="text" class="form-control required digits" id="tbl_employee_mobile" value="<?php if(isset($employee)){ echo $employee['tbl_employee_mobile']; } ?>" name="tbl_employee_mobile" maxlength="10">
                                    </div>
                                </div>
                                <?php 
                                    if(isset($employee)){
                                        $ar1=unserialize(base64_decode($employee['tbl_employee_skills']));
                                        //echo "<pre>";print_r($ar1);die;
                                    } ?>    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_skills">Services</label>
                                        <select multiple class="form-control required selectpicker" id="tbl_employee_skills" name="tbl_employee_skills[]">
                                            <option value="0">Select Services</option>
                                            <?php for($i=0;$i<count($services);$i++){ ?>
                                                <option value="<?php echo $services[$i]['service_id']; ?>" <?php if(isset($employee)){ if(in_array($services[$i]['service_id'], $ar1)){echo 'selected="selected"';} } ?>><?php echo $services[$i]['service_name'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>    
                            </div>
                           
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="tbl_employee_id_card"> Emirates ID Image</label>
                                        <input type="file" class="form-control <?php if(!isset($employee)){ echo 'required'; } ?>" value="<?php echo isset($sliderInfo->tbl_employee_id_card) ? $sliderInfo->tbl_employee_id_card : ""; ?>" id="tbl_employee_id_card" name="tbl_employee_id_card">
                                    </div>
                                    <?php if(isset($employee)){ ?>
                                    <div class="form-group">
                                        <label for="tbl_employee_id_card">Current Emirates ID Image</label>
                                        <img src="<?php echo $employee['tbl_employee_id_card']; ?>" height="200" width="250">
                                        <input type="hidden" name="tbl_employee_id_card_old" value="<?php echo $employee['tbl_employee_id_card']; ?>" id="tbl_employee_id_card_old">
                                    </div>
                                <?php }  ?>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_image"> Employee Image</label>
                                        <input type="file" class="form-control <?php if(!isset($employee)){ echo 'required'; } ?>" value="<?php echo isset($sliderInfo->tbl_employee_image) ? $sliderInfo->tbl_employee_image : ""; ?>" id="tbl_employee_image" name="tbl_employee_image">
                                    </div>
                                    <?php if(isset($employee)){ ?>
                                    <div class="form-group">
                                        <label for="tbl_employee_image">Current Employee Image</label>
                                        <img src="<?php echo $employee['tbl_employee_image']; ?>" height="200" width="250">
                                        <input type="hidden" name="tbl_employee_image_old" value="<?php echo $employee['tbl_employee_image']; ?>" id="tbl_employee_image_old">
                                    </div>
                                <?php }  ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="tbl_employee_basic_salary"> Employee Basic Salary</label>
                                        <input type="text" class="form-control required" id="tbl_employee_basic_salary" value="<?php if(isset($employee)){ echo $employee['tbl_employee_basic_salary']; } ?>" name="tbl_employee_basic_salary" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_doj">Employee Date Of Join</label>
                                        <input type="date" class="form-control required" value="<?php if(isset($employee)){ echo $employee['tbl_employee_doj']; } ?>" id="tbl_employee_doj" name="tbl_employee_doj">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="tbl_employee_emegency_contact"> Employee Emergency Contact</label>
                                        <input type="text" class="form-control required" id="tbl_employee_emegency_contact" value="<?php if(isset($employee)){ echo $employee['tbl_employee_emegency_contact']; } ?>" name="tbl_employee_emegency_contact" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_notes"> Employee Notes</label>
                                        <input type="text" class="form-control required" id="tbl_employee_notes" value="<?php if(isset($employee)){ echo $employee['tbl_employee_notes']; } ?>" name="tbl_employee_notes" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="tbl_employee_nationality"> Employee Nationality</label>
                                        <input type="text" class="form-control required" id="tbl_employee_nationality" value="<?php if(isset($employee)){ echo $employee['tbl_employee_nationality']; } ?>" name="tbl_employee_nationality" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tbl_employee_status"> Employee Status</label>
                                        <input type="text" class="form-control required" id="tbl_employee_status" value="<?php if(isset($employee)){ echo $employee['tbl_employee_status']; } ?>" name="tbl_employee_status" maxlength="128">
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
<script src="<?php echo base_url(); ?>assets/js/add_new_employee_view.js" type="text/javascript"></script>