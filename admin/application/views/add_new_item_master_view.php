<div class="content-wrapper">
    <?php //echo "<pre>";print_r($list);die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-indent"></i> Item Master Management
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Item</small>
                    
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Item Master Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_item_unit" action="<?php echo base_url().$action?>" method="post" role="form" enctype="multipart/form-data">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_name">Item Name</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['item_master_name']) ? $list['item_master_name'] : ""; ?>" id="item_master_name" name="item_master_name" maxlength="200" tabindex="2">
                                    </div>
                                    <?php 
                                        if(isset($record_num))
                                        {
                                            ?><input type="hidden" name="item_master_id" id="item_master_ids" value="<?php echo $record_num; ?>"><?php
                                        }
                                    ?>
                                </div> 
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_desc">Item Desc</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['item_master_desc']) ? $list['item_master_desc'] : ""; ?>" id="item_master_desc" name="item_master_desc" maxlength="200" tabindex="2">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_stock">Item Stock</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['item_master_stock']) ? $list['item_master_stock'] : ""; ?>" id="item_master_stock" name="item_master_stock" maxlength="200" tabindex="2">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_price">Item Price</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['item_master_price']) ? $list['item_master_price'] : ""; ?>" id="item_master_price" name="item_master_price" maxlength="200" tabindex="2">
                                    </div>
                                </div>   
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_category">Item Category</label>
                                        <select class="form-control required" name="item_master_category" id="item_master_category" required>
                                            <option value="">Select Category</option>
                                        <?php if(!empty($category)) { foreach ($category as $c) { ?>
                                        <option value="<?php echo $c['item_category_id']; ?>" <?php if(isset($list) && $list['item_master_category']==$c['item_category_id']){ echo 'selected="selected"'; } ?>><?php echo $c['item_category_name']; ?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_unit">Item Unit</label>
                                        <select class="form-control required" name="item_master_unit" id="item_master_unit" required>
                                            <option value="">Select Unit</option>
                                        <?php if(!empty($unit)) { foreach ($unit as $u) { ?>
                                        <option value="<?php echo $u['item_unit_id']; ?>" <?php if(isset($list) && $list['item_master_unit']==$u['item_unit_id']){ echo 'selected="selected"'; } ?>><?php echo $u['item_unit_name']; ?></option>
                                        <?php } } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="item_master_logo">Item Image</label>
                                        <input type="file" class="form-control <?php if(!isset($list)){ echo 'required'; } ?>" value="<?php echo isset($list->item_master_logo) ? $list->item_master_logo : ""; ?>" id="item_master_logo" name="item_master_logo">
                                    </div>
                                    <?php if(isset($list)){ ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <label for="item_master_logo">Current Image</label>
                                        <img src="<?php echo $list['item_master_logo']; ?>" height="200" width="250">
                                        <input type="hidden" name="item_master_logo_old" value="<?php echo $list['item_master_logo']; ?>" id="item_master_logo_old">
                                        </div>
                                    </div>
                                    <?php }  ?>
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
<script src="<?php echo base_url(); ?>assets/js/add_new_item_unit.js" type="text/javascript"></script>