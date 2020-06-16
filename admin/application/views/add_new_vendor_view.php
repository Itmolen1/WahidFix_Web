<script type="text/javascript">
    $(function () {
    $('.selectpicker').selectpicker();
});
</script>
<script type="text/javascript">
 jQuery(document).ready(function(){
    
    jQuery(document).on("click", "#move_address", function(){
        var vendor_billing_attention = $('#vendor_billing_attention').val();
        var vendor_billing_address = $("#vendor_billing_address").val();
        var vendor_billing_city = $("#vendor_billing_city").val();
        var vendor_billing_country = $("#vendor_billing_country").val();
        var vendor_billing_phone = $('#vendor_billing_phone').val();
        var vendor_billing_fax = $('#vendor_billing_fax').val();
        
        $('#vendor_shipping_attention').val(vendor_billing_attention);
        $('#vendor_shipping_address').val(vendor_billing_address);
        $('#vendor_shipping_city').val(vendor_billing_city);
        $('#vendor_shipping_country').val(vendor_billing_country);
        $('#vendor_shipping_phone').val(vendor_billing_phone);
        $('#vendor_shipping_fax').val(vendor_billing_fax);
            
    });

   
});
</script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-address-book"></i> Vendor Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    $this->session->set_userdata('referred_from', current_url());
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Vendor</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Vendor Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_vendor" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php
                                if(isset($record_num))
                                {
                                    ?><input type="hidden" id="vendor_id" name="vendor_id" value="<?php echo $record_num; ?>"><?php
                                }
                            ?>
                            <div class="row">
                                 <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vendor_salutation">Salutation</label>
                                        <select class="form-control required" id="vendor_salutation" name="vendor_salutation">
                                            <option value="0">Select</option>
                                            <option value="1" <?php if(isset($vendor) && $vendor['vendor_salutation']==1){ echo 'selected="selected"'; } ?>>Mr.</option>
                                            <option value="2" <?php if(isset($vendor) && $vendor['vendor_salutation']==2){ echo 'selected="selected"'; } ?>>Mrs.</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">                                
                                    <div class="form-group">
                                        <label for="vendor_name">Vendor Name</label>
                                        <input type="text" class="form-control required" value="<?php if(isset($vendor)){ echo $vendor['vendor_name']; } ?>" id="vendor_name" name="vendor_name" maxlength="128">
                                    </div>
                                </div>                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_company_name">Compnay Name</label>
                                        <input type="text" class="form-control required" id="vendor_company_name" value="<?php if(isset($vendor)){ echo $vendor['vendor_company_name']; } ?>" name="vendor_company_name" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_trn">VAT TRN#</label>
                                        <input type="text" class="form-control required" id="vendor_trn" value="<?php if(isset($vendor)){ echo $vendor['vendor_trn']; } ?>" name="vendor_trn" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_payment_term">Payment Term</label>
                                        <input type="text" class="form-control required" id="vendor_payment_term" value="<?php if(isset($vendor)){ echo $vendor['vendor_payment_term']; } ?>" name="vendor_payment_term" maxlength="128">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_email">Email address</label>
                                        <input type="email" class="form-control required email" id="vendor_email" value="<?php if(isset($vendor)){ echo $vendor['vendor_email']; } ?>" name="vendor_email" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_mobile">Mobile Number</label>
                                        <input type="text" class="form-control required" id="vendor_mobile" value="<?php if(isset($vendor)){ echo $vendor['vendor_mobile']; } ?>" name="vendor_mobile" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_tel">Telephone Number</label>
                                        <input type="text" class="form-control required" id="vendor_tel" value="<?php if(isset($vendor)){ echo $vendor['vendor_tel']; } ?>" name="vendor_tel" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="box-header">
                                        <h3 class="box-title"> Billing Address </h3>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                <div class="input-group-btn">
                                      <button type="button" class="btn" id="move_address" name="move_address"><i class="fa fa-arrow-right text-muted"></i></button>
                                </div>
                                </div>
                                <div class="col-md-4">
                                   <div class="box-header">
                                        <h3 class="box-title"> Shipping Address </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_attention">Attention</label>
                                        <input type="text" class="form-control required" id="vendor_billing_attention" value="<?php if(isset($vendor)){ echo $vendor['vendor_billing_attention']; } ?>" name="vendor_billing_attention" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_attention">Attention</label>
                                        <input type="text" class="form-control required" id="vendor_shipping_attention" value="<?php if(isset($vendor)){ echo $vendor['vendor_shipping_attention']; } ?>" name="vendor_shipping_attention" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_address">Address</label>
                                        <textarea class="form-control" rows="3" id="vendor_billing_address" name="vendor_billing_address"><?php if(isset($vendor)){ echo $vendor['vendor_billing_address']; } ?></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_address">Address</label>
                                         <textarea class="form-control" rows="3" id="vendor_shipping_address" name="vendor_shipping_address"><?php if(isset($vendor)){ echo $vendor['vendor_shipping_address']; } ?></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_city">City</label>
                                        <input type="text" class="form-control required" id="vendor_billing_city" value="<?php if(isset($vendor)){ echo $vendor['vendor_billing_city']; } ?>" name="vendor_billing_city" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_city">City</label>
                                        <input type="text" class="form-control required" id="vendor_shipping_city" value="<?php if(isset($vendor)){ echo $vendor['vendor_shipping_city']; } ?>" name="vendor_shipping_city" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_country">Country</label>
                                        <input type="text" class="form-control required" id="vendor_billing_country" value="<?php if(isset($vendor)){ echo $vendor['vendor_billing_country']; } ?>" name="vendor_billing_country" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_country">Country</label>
                                        <input type="text" class="form-control required" id="vendor_shipping_country" value="<?php if(isset($vendor)){ echo $vendor['vendor_shipping_country']; } ?>" name="vendor_shipping_country" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_phone">Phone</label>
                                        <input type="text" class="form-control required" id="vendor_billing_phone" value="<?php if(isset($vendor)){ echo $vendor['vendor_billing_phone']; } ?>" name="vendor_billing_phone" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_phone">Phone</label>
                                        <input type="text" class="form-control required" id="vendor_shipping_phone" value="<?php if(isset($vendor)){ echo $vendor['vendor_shipping_phone']; } ?>" name="vendor_shipping_phone" maxlength="128">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="vendor_billing_fax">Fax</label>
                                        <input type="text" class="form-control required" id="vendor_billing_fax" value="<?php if(isset($vendor)){ echo $vendor['vendor_billing_fax']; } ?>" name="vendor_billing_fax" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                         <label for="vendor_shipping_fax">Fax</label>
                                        <input type="text" class="form-control required" id="vendor_shipping_fax" value="<?php if(isset($vendor)){ echo $vendor['vendor_shipping_fax']; } ?>" name="vendor_shipping_fax" maxlength="128">
                                    </div>
                                </div>
                            </div>
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
<script src="<?php echo base_url(); ?>assets/js/add_new_vendor_view.js" type="text/javascript"></script>