<?php 
$newarray=array();
for($i=0;$i<count($services);$i++)
{
    $newarray[$services[$i]['service_id']]=$services[$i]['service_name'];
}
$ar2=$newarray;
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-user"></i>Employee Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($this->session->userdata['myfinal']['employee_listing']['p_add']) && $this->session->userdata['myfinal']['employee_listing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_employee"><i class="fa fa-plus"></i> Add New</a>
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
                        <form action="<?php echo base_url() ?>employee_listing" method="POST" id="searchList">
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
                        <th>DOJ</th>
                        <th>EMG CNTC</th>
                        <th>Nationality</th>
                        <th>Services Known</th>
                        <th>EMP ID</th>
                        <th>EMP IMAGE</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($employees))
                    {
                        foreach($employees as $record)
                        {
                            //echo unserialize(base64_decode($record->tbl_employee_skills));die;
                            $ar1=array_flip((unserialize(base64_decode($record->tbl_employee_skills))));
                            //echo "<pre>";print_r(array_intersect_key($ar2,$ar1));
                    ?>
                    <tr>
                        <td><?php echo $record->tbl_employee_name; ?></td>
                        <td><?php echo $record->tbl_employee_email; ?></td>
                        <td><?php echo $record->tbl_employee_mobile; ?></td>
                        <td><?php echo $record->tbl_employee_doj; ?></td>
                        <td><?php echo $record->tbl_employee_emegency_contact; ?></td>
                        <td><?php echo $record->tbl_employee_nationality; ?></td>
                        <td><?php echo implode("<br>", (array_values(array_intersect_key($ar2,$ar1))));?></td>
                        <td><a data-fancybox="gallery" href="<?php echo $record->tbl_employee_id_card; ?>"><img height="100" width="100" src="<?php echo $record->tbl_employee_id_card; ?>"></a></td>
                        <td><a data-fancybox="gallery" href="<?php echo $record->tbl_employee_image; ?>"><img height="100" width="100" src="<?php echo $record->tbl_employee_image; ?>"></a></td>
                        <td><?php if($record->tbl_employee_status==0) echo 'Available'; else if($record->tbl_employee_status==1) echo 'Busy'; ?></td>
                        <?php /*<td><?php echo date("d-m-Y", strtotime($record->tbl_employee_created_at));  ?></td>*/?>
                        <td class="text-center">
                            <?php if(isset($this->session->userdata['myfinal']['employee_listing']['p_update']) && $this->session->userdata['myfinal']['employee_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_employee/'.$record->tbl_employee_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <?php if(isset($this->session->userdata['myfinal']['employee_listing']['p_delete']) && $this->session->userdata['myfinal']['employee_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'delete_employee/'.$record->tbl_employee_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "employee_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
