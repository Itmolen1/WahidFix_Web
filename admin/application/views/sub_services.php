<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-list-alt"></i> Sub Services Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <form action="<?php echo base_url().'sub_service_listing'?>" method="POST" id="service_id">
                Select Parent Service                
                <select class="required" id="service_id" name="service_id" tabindex="1">
                    <option value="">Select</option>
                <?php
                    foreach($services as $s) 
                    { 
                ?>
                    <option value="<?php echo $s['service_id'] ?>" <?php if(isset($service_id) && $service_id==$s['service_id']){ echo 'selected="selected"'; } ?>><?php echo $s['service_name'] ?></option>
                <?php } ?>
                </select>
                <button class="btn btn-sm btn-default service_id"><i class="fa fa-arrow-right">GO</i></button>
                
            </form>
            </div>
            <?php if(isset($this->session->userdata['myfinal']['sub_service_listing']['p_add']) && $this->session->userdata['myfinal']['sub_service_listing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_subservice"><i class="fa fa-plus"></i> Add New</a>
                </div>

            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Services List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>sub_service_listing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search" />
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                        <th>Service Name</th>
                        <th>Sub Service Name</th>
                        <th>Image</th>
                        <th>Created On</th>
                        <th>Updated On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($servicesRecords))
                    {
                        foreach($servicesRecords as $record)
                        {
                            //echo "<pre>";print_r($record);die;
                    ?>
                    <tr>
                        <td><?php echo $record->service_name ?></td>
                        <td><?php echo $record->sub_service_name ?></td>
                        <td><?php if(isset($record->sub_service_image) && $record->sub_service_image!='')  { ?><a data-fancybox="gallery" href="<?php echo $record->sub_service_image; ?>"><img height="100" width="100" src="<?php echo $record->sub_service_image; ?>"></a><?php } ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->created_at)) ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->updated_at)) ?></td>
                        <td class="text-center">
                            
                            <?php if(isset($this->session->userdata['myfinal']['sub_service_listing']['p_update']) && $this->session->userdata['myfinal']['sub_service_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_sub_subservice/'.$record->sub_service_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['sub_service_listing']['p_delete']) && $this->session->userdata['myfinal']['sub_service_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger deleteServices" href="<?php echo base_url().'delete_sub_service/'.$record->sub_service_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                            <?php } ?>

                        </td>
                    </tr>
                    <?php
                        }
                    }
                    else{ ?>
                        <td><?php echo "no recodrs found"; ?></td>
                    <?php
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "sub_service_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#service_id").attr("action", baseURL + "sub_service_listing/" + value);
            jQuery("#service_id").submit();
        });
    });
</script>
