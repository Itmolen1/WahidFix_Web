<!--MODAL DIALOG BOX FOR PAYMENT RECORD-->
<script type="text/javascript">
    jQuery(document).on("click", ".get_guest_suborder_details", function(){
    //$(document).ready(function(){
    //alert(this.id);
    var jss =this.id.split('get_guest_suborder_details');
    //alert(jss[1]);
    //var id = val;
        var data = jss[1];
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "get_guest_suborder_details";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){

                //alert(data);
                //window.open(data,'_blank');
                $('.suborder-display').html('');
                $('.suborder-display').append(data.finalresult);
                $('.test').html('');
                $('.test').append(data.sr_id);
                //$('#purchase_order_bill_no').val(data.purchase_order_bill_no);
                //$('#po_payment_record_total_amt').val(data.purchase_order_grand_total);
                //$('#po_payment_record_paid_amt').val(data.purchase_order_paid_amt);
                //$('#po_payment_record_due_amt').val(data.purchase_order_due_amt);
                //var data = JSON.parse(JSON.parse(json).data);
                //console.log(data);                 
            });
});
</script>
<div id="suborder-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Order Details</h3>
            </div>
            <form method="post">
                <div class="modal-body suborder-display">
                </div>
                <div class="modal-footer">                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="hidden" name="m_sr_id" id="m_sr_id">
                    <span class="test"></span>
                </div>
            </form>
        </div>
    </div>
</div>
<!--MODAL DIALOG BOX FOR PAYMENT RECORD-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-truck"></i>Guest Service Request Management
        <small>Modify Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Guest Services Request List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>guest_service_request_listing" method="POST" id="searchList">
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
                        <th>User Name</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Prefferd Date</th>
                        <th>Prefferd Time</th>
                        <th>Created At</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($servicesRecords))
                    {
                        foreach($servicesRecords as $record)
                        {
                            //echo "<pre>";print_r($record);die;
                    ?>
                        <td><?php echo $record->tbl_guest_user_name; ?></td>
                        <td><?php echo $record->tbl_guest_user_mobile ?></td>
                        <td><?php echo $record->tbl_guest_user_email ?></td>
                        <td><?php echo $record->tbl_guest_user_service_date ?></td>
                        <td><?php echo $record->time_slot_name ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->tbl_guest_user_createdat)) ?></td>
                        <td class="text-center">

                            <a class="btn btn-sm btn-info get_guest_suborder_details" href="javascript:void(0)" value="<?php echo $record->tbl_guest_user_id; ?>" id="<?php echo 'get_guest_suborder_details'.$record->tbl_guest_user_id; ?>" title="What's Inside" data-toggle="modal" data-target="#suborder-modal"><i class="fa fa-info-circle"></i></a>

                            <?php if(isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_update']) && $this->session->userdata['myfinal']['guest_service_request_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_guest_service_request/'.$record->tbl_guest_user_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>


                            <?php if(isset($this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']) && $this->session->userdata['myfinal']['guest_service_request_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger deleteServices" href="<?php echo base_url().'delete_guest_service_request/'.$record->tbl_guest_user_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "guest_service_request_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
