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
        <i class="fa fa-list-alt"></i> Assign Rights
        <small><?php 
                    $last = $this->uri->total_segments();
                    $record_num = $this->uri->segment($last);
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Rights</small>
                    
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Rights Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="add_new_subservice" action="<?php echo base_url().$action?>" method="post">
                        <div class="box-body">
                            <input type="hidden" name="userId" id="userId" value="<?=$record_num;?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_id">Module Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="service_id">Rights</label>       
                                    </div>
                                </div>
                            </div>
                            <?php if(isset($existing_rights)) { ?><input type="hidden" name="update" id="update" value="update"><?php } ?>

                                <?php 
                                $i=0;
                                foreach($modules as $mode) 
                                { ?> 
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="service_id"><?php echo $mode['module_lable']; ?></label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="checkbox" <?php echo 'name="'.$mode['module_name'].'[]" class="'.$mode['module_name'].'"'; ?>  value="p_view" 
                                        <?php 
                                        if(isset($existing_rights) && isset($existing_rights[$i]['module_id'])) 
                                        { 
                                            if($existing_rights[$i]['module_id']==$mode['module_name'] && $existing_rights[$i]['p_view']==1)  
                                            {    
                                                echo "checked"; 
                                            } 
                                        } 
                                        ?>> View
                                        <input type="checkbox" <?php echo 'name="'.$mode['module_name'].'[]" class="'.$mode['module_name'].'"'; ?> value="p_add" <?php 
                                        if(isset($existing_rights) && isset($existing_rights[$i]['module_id'])) 
                                        { 
                                            if($existing_rights[$i]['module_id']==$mode['module_name'] && $existing_rights[$i]['p_add']==1)  
                                            {    
                                                echo "checked"; 
                                            } 
                                        } 
                                        ?>> Add
                                        <input type="checkbox" <?php echo 'name="'.$mode['module_name'].'[]" class="'.$mode['module_name'].'"'; ?> value="p_update" <?php 
                                        if(isset($existing_rights) && isset($existing_rights[$i]['module_id'])) 
                                        { 
                                            if($existing_rights[$i]['module_id']==$mode['module_name'] && $existing_rights[$i]['p_update']==1)  
                                            {    
                                                echo "checked"; 
                                            } 
                                        } 
                                        ?>> Update
                                        <input type="checkbox" <?php echo 'name="'.$mode['module_name'].'[]" class="'.$mode['module_name'].'"'; ?> value="p_delete" <?php 
                                        if(isset($existing_rights) && isset($existing_rights[$i]['module_id'])) 
                                        { 
                                            if($existing_rights[$i]['module_id']==$mode['module_name'] && $existing_rights[$i]['p_delete']==1)  
                                            {    
                                                echo "checked"; 
                                            } 
                                        } 
                                        ?>> Delete |
                                        <input type="checkbox" id="<?php echo $mode['module_name']; ?>"> Check All   <br>
                                    </div>                                    
                                </div>
                                <?
                                $i++;
                                 } 
                                 ?> 
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