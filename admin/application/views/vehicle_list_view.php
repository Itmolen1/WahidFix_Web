<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-bus"></i>  Vehicle Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($this->session->userdata['myfinal']['vehicle_listing']['p_add']) && $this->session->userdata['myfinal']['vehicle_listing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_vehicle"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Employee List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>vehicle_listing" method="POST" id="searchList">
                            <div class="input-group">
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
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
                        <th>Vehicle No</th>
                        <th>TC No</th>
                        <th>Insurance IMG</th>
                        <th>Ins Exp Date</th>
                        <th>Mulkia FIMG</th>
                        <th>Mulkia BIMG</th>
                        <th>Mulkia Exp Date</th>
                        <th>Status</th>
                        <th>Created On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($vehicles))
                    {
                        foreach($vehicles as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->vehicle_no; ?></td>
                        <td><?php echo $record->vehicle_tc_no; ?></td>
                        <td><a data-fancybox="gallery" href="<?php echo $record->vehicle_insurance_img; ?>"><img height="100" width="100" src="<?php echo $record->vehicle_insurance_img; ?>"></a></td>
                        <td><?php echo $record->vehicle_insurance_exp_date; ?></td>
                        <td><a data-fancybox="gallery" href="<?php echo $record->vehicle_mulkia_front_img; ?>"><img height="100" width="100" src="<?php echo $record->vehicle_mulkia_front_img; ?>"></a></td>
                        <td><a data-fancybox="gallery" href="<?php echo $record->vehicle_mulkia_back_img; ?>"><img height="100" width="100" src="<?php echo $record->vehicle_mulkia_back_img; ?>"></a></td>
                        <td><?php echo $record->vehicle_mulkia_exp_date; ?></td>
                        <td><?php if($record->vehicle_status==1) echo 'Available'; else if($record->vehicle_status==2) echo 'Busy';  ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->vehicle_created_at));  ?></td>
                        <td class="text-center">

                            <?php if(isset($this->session->userdata['myfinal']['vehicle_listing']['p_update']) && $this->session->userdata['myfinal']['vehicle_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_vehicle/'.$record->vehicle_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['vehicle_listing']['p_delete']) && $this->session->userdata['myfinal']['vehicle_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'delete_vehicle/'.$record->vehicle_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                        }
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
            jQuery("#searchList").attr("action", baseURL + "vehicle_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
