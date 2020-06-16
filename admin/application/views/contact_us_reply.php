<div class="content-wrapper">
    <?php //echo "<pre>";print_r($list);die; ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-share"></i> Contact Us Reply
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Reply Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addNewservice" action="<?php echo base_url().$action?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <?php
                                        $last = $this->uri->total_segments();
                                        $record_num = $this->uri->segment($last);
                                        if(is_numeric($record_num))
                                        {
                                            ?>
                                            <input type="hidden" name="id" value="<?php echo $list['id']; ?>" id="id" >
                                            <?php
                                        }
                                    ?>

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['name']) ? $list['name'] : ""; ?>" id="name" name="name" maxlength="200" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['email']) ? $list['email'] : ""; ?>" id="email" name="email" maxlength="200"  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="mobile_number">Mobile Number</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['mobile_number']) ? $list['mobile_number'] : ""; ?>" id="mobile_number" name="mobile_number" maxlength="200"  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="comments">Comments</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['comments']) ? $list['comments'] : ""; ?>" id="comments" name="comments" maxlength="200"  readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="admin_reply">Admin Reply</label>
                                        <input type="text" class="form-control required" value="<?php echo isset($list['admin_reply']) ? $list['admin_reply'] : ""; ?>" id="admin_reply" name="admin_reply" maxlength="200" tabindex="1">
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