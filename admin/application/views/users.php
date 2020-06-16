<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i>Admin User Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($this->session->userdata['myfinal']['userListing']['p_add']) && $this->session->userdata['myfinal']['userListing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>addNew"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Admin Users List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>userListing" method="POST" id="searchList">
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Role</th>
                        <th>Created On</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($userRecords))
                    {
                        foreach($userRecords as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->name ?></td>
                        <td><?php echo $record->email ?></td>
                        <td><?php echo $record->mobile ?></td>
                        <td><?php echo $record->role ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->createdDtm)) ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-primary" href="<?= base_url().'login-history/'.$record->userId; ?>" title="Login history"><i class="fa fa-history"></i></a> | 

                            <?php /*<a class="btn btn-sm btn-info" href="<?php echo base_url().'AssignRights/'.$record->userId; ?>" title="Assign Rights"><i class="fa fa-wheelchair"></i></a>*/?>

                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'AssignRole/'.$record->userId; ?>" title="Assign Role"><i class="fa fa-wheelchair"></i></a>

                            <?php if(isset($this->session->userdata['myfinal']['userListing']['p_update']) && $this->session->userdata['myfinal']['userListing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'editOld/'.$record->userId; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['userListing']['p_delete']) && $this->session->userdata['myfinal']['userListing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'deleteUser/'.$record->userId; ?>" data-userid="<?php echo $record->userId; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "userListing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
