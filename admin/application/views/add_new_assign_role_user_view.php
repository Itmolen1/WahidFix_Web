<script type="text/javascript">
    $(document).ready(function(){        
        // $("#servicesListing").click(function () {
        //   $('.servicesListing').attr('checked', this.checked);
        // });
    <?php 
        foreach($modules as $mode){
    ?>
    $("#<?php echo $mode['module_name']; ?>").click(function(){$('.<?php echo $mode['module_name']; ?>').attr('checked',this.checked);});
    <?php } ?>
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $('.searchType').click(function() {
        alert($(this).attr('id'));  //-->this will alert id of checked checkbox.
           if(this.checked){
                $.ajax({
                    type: "POST",
                    url: 'searchOnType.jsp',
                    data: $(this).attr('id'), //--> send id of checked checkbox on other page
                    success: function(data) {
                        alert('it worked');
                        alert(data);
                        $('#container').html(data);
                    },
                     error: function() {
                        alert('it broke');
                    },
                    complete: function() {
                        alert('it completed');
                    }
                });

                }
          });
    });
</script>

<div class="content-wrapper">
    <section class="content-header">
      <h1>
        <i class="fa fa-list-alt"></i> Assign Role
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Role</small>
                    
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Assign Role to user</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_subservice" action="<?php echo base_url().$action?>" method="post">
                        <div class="box-body">
                            <input type="hidden" name="userId" id="userId" value="<?=$record_num;?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="roleId">Assign Role</label>
                                        <select class="form-control required" id="roleId" name="roleId" tabindex="1" required="required">
                                            <option value="">Select Role</option>
                                            <?php
                                            if(!empty($roles))
                                            {
                                                foreach ($roles as $role)
                                                {
                                                    ?>
                                                    <option value="<?php echo $role['roleId']; ?>" <?php if(isset($list) && $role['roleId'] == $list['roleId']) {echo "selected=selected";} ?>><?php echo $role['role']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>       
                                    </div>
                                </div>
                            </div> 
                        </div>
                        </div>
    
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="Save" tabindex="3" />
                        </div>
                    </form>
                </div>
            </div>
            
        </div>    
    </section>
    
</div>
<script src="<?php echo base_url(); ?>assets/js/add_new_subservice.js" type="text/javascript"></script>