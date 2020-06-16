<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-share"></i>Contact Us Management
        <small>Reply, Delete</small>
      </h1>

      <h1><?php echo $this->session->flashdata('message'); ?></h1>
    </section>
    <section class="content">

        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Contact Us List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>contact_us_listing" method="POST" id="searchList">
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
                        <th>name</th>
                        <th>email</th>
                        <th>mobile_number</th>
                        <th>comments</th>
                        <th>created_at</th>
                        <th>status</th>
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
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->email ?></td>
                        <td><?php echo $record->mobile_number ?></td>
                        <td><?php echo $record->comments ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->created_at)) ?></td>
                        <td><?php echo ($record->status==1) ?  'Replied' :  'Not Replied'; ?></td>
                        <td class="text-center">

                            <?php if(isset($this->session->userdata['myfinal']['contact_us_listing']['p_update']) && $this->session->userdata['myfinal']['contact_us_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>                            
                            <a class="btn btn-sm btn-info" <?php if($record->status==0) { ?> href="<?php echo base_url().'contact_us_reply/'.$record->id; ?>" <?php } else { ?> href="javascript:void(0)" <?php } ?>title="Reply"><i class="fa fa-reply"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['contact_us_listing']['p_delete']) && $this->session->userdata['myfinal']['contact_us_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger delete_contact_us" href="<?php echo base_url().'delete_contact_us/'.$record->id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "contact_us_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
