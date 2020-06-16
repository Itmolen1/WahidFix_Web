<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa-credit-card"></i>  Sales Master Management
        <small>View</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Sales Master List</h3>
                    <div class="box-tools">
                        <form id="modalform" style="display:none">
                             <input type="text" name="something">
                             <input type="text" name="somethingelse">
                        </form> 
                        <form action="<?php echo base_url() ?>sales_master_listing" method="POST" id="searchList">
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
                        <th>Order #</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($sales_master))
                    {
                        foreach($sales_master as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->service_request_ref; ?></td>
                        <td><?php echo ($record->sales_master_status==1) ?  'OK' :  'Pending'; ?></td>
                        <td><?php echo $record->sales_master_createdat; ?></td>
                        <td class="text-center">

                            <a class="btn btn-sm btn-info bg-blue" href="<?php echo $record->sales_master_pdf; ?>" target="_blank" title="PFD"><i class="fa fa-file-pdf-o" id="<?php echo $record->sales_master_id; ?>"></i></a>

                            <a class="btn btn-sm btn-info bg-orange" href="javascript:void(0)" title="E-Mail"><i class="fa fa-envelope-o" id="<?php echo $record->sales_master_id; ?>" onclick="return send_mail('<?php echo $record->sales_master_id; ?>')"></i></a>

                            <a class="btn btn-sm btn-info bg-olive" href="<?php echo base_url().'pm_export_exl/'.$record->sales_master_id; ?>" title="Excel"><i class="fa fa-file-excel-o"></i></a>

                            <?php if(isset($this->session->userdata['myfinal']['sales_master_listing']['p_delete']) && $this->session->userdata['myfinal']['sales_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'delete_purchase_master/'.$record->sales_master_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a><?php } ?>
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
            jQuery("#searchList").attr("action", baseURL + "sales_master_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
