<script type="text/javascript">
    function get_pdf(val)
    {
        //alert(val);
        var data = val;
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "purchase_master_pdf";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){
                //alert(data);
                window.open(data,'_blank');
                //var data = JSON.parse(JSON.parse(json).data);
                //console.log(data);                 
            });
    }
</script>

<script type="text/javascript">
    function send_mail(val)
    {
        //alert(val);
        var data = val;
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "purchase_master_email";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){
                //alert(data);
                //window.open(data,'_blank');
                //var data = JSON.parse(JSON.parse(json).data);
                //console.log(data);                 
            });
    }
</script>

<script type="text/javascript">
    $(function() {
  $("#payment_record_form").validate({
    rules: {
      pm_payment_record_due_amt: {
        required: true,
        minlength: 2
      },
      pm_payment_record_date: {
        required: true
      },
      pm_payment_record_payment_no: {
        required: true
      },
      pm_payment_record_type : { required : true, selected : true},
      action: "required"
    },
    messages: {
      pm_payment_record_due_amt: {
        required: "Please enter some data",
        minlength: "Your data must be at least 2 characters"
      },
      pm_payment_record_date: {
        required: "Please enter date"
      },
      pm_payment_record_payment_no: {
        required: "Please enter some value"
      },
      pm_payment_record_type : { required : "This field is required", selected : "Please select atleast one option" },
      action: "Please provide some data"
    }
  });
});    
</script>

<!--MODAL DIALOG BOX FOR PAYMENT RECORD-->
<script type="text/javascript">
    jQuery(document).on("click", ".payment_record", function(){
    //$(document).ready(function(){
    //alert(this.id);
    var jss =this.id.split('payment_record');
    //alert(jss[1]);
    //var id = val;
        var data = jss[1];
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "purchase_master_get_payment_record_details";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){
                //alert(data);
                //window.open(data,'_blank');
                $('#vendor_name').val(data.vendor_name);
                $('#pm_payment_record_pm_id').val(data.purchase_master_id);
                $('#purchase_master_due_amt').val(data.purchase_master_due_amt);
                $('#purchase_master_bill_no').val(data.purchase_master_bill_no);
                $('#pm_payment_record_total_amt').val(data.purchase_master_grand_total);
                $('#pm_payment_record_paid_amt').val(data.purchase_master_paid_amt);
                $('#pm_payment_record_due_amt').val(data.purchase_master_due_amt);
                //var data = JSON.parse(JSON.parse(json).data);
                //console.log(data);                 
            });
    $("#payment_record_form").submit(function(event){
        //alert('coming');
        submitForm();
        //alert('coming 222');
        //return false;
    });
});
</script>
<div id="contact-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <a class="close" data-dismiss="modal">×</a>
                <h3>Payment Record</h3>
            </div>
            <form id="payment_record_form" name="contact" role="form" method="post" action="<?php echo base_url().'purchase_master_add_payment_record'; ?>">
                <div class="modal-body">
                    <div class="row">               
                        <div class="col-md-12">
                            <label for="vendor_name">Vendor Name</label>
                            <input type="text" name="vendor_name" id="vendor_name" class="form-control" readonly>
                            <input type="hidden" name="pm_payment_record_pm_id" id="pm_payment_record_pm_id">
                            <input type="hidden" name="purchase_master_due_amt" id="purchase_master_due_amt">
                        </div>
                    </div> 
                    <div class="row">               
                        <div class="col-md-4">
                            <label for="pm_payment_record_date">Date</label>
                            <input type="date" class="form-control required" id="pm_payment_record_date" name="pm_payment_record_date">
                        </div>
                        <div class="col-md-4">
                            <label for="purchase_master_bill_no">Invoice #</label>
                            <input type="text" name="purchase_master_bill_no" id="purchase_master_bill_no" readonly class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="pm_payment_record_payment_no">Payment No#</label>
                            <input type="text" name="pm_payment_record_payment_no" id="pm_payment_record_payment_no" class="form-control">
                        </div>
                    </div>
                    <div class="row">               
                        <div class="col-md-4">
                            <label for="pm_payment_record_type">Payment Type</label>
                            <select class="form-control required" id="pm_payment_record_type" name="pm_payment_record_type">
                            <option value="0">Select Type</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Cash">Cash</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="pm_payment_record_cheque_no">Cheque #</label>
                            <input type="text" name="pm_payment_record_cheque_no" id="pm_payment_record_cheque_no" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="pm_payment_record_bank">Bank</label>
                            <input type="text" name="pm_payment_record_bank" id="pm_payment_record_bank" class="form-control">
                        </div>
                    </div>
                    <div class="row">               
                       <div class="col-md-4">
                            <label for="pm_payment_record_total_amt">Total Amount</label>
                            <input type="text" name="pm_payment_record_total_amt" id="pm_payment_record_total_amt" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="pm_payment_record_paid_amt">Paid Amount</label>
                            <input type="text" name="pm_payment_record_paid_amt" id="pm_payment_record_paid_amt" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="pm_payment_record_due_amt">Payment Amount</label>
                            <input type="text" name="pm_payment_record_due_amt" id="pm_payment_record_due_amt" class="form-control">
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-md-12">
                            <label for="pm_payment_record_note">Notes</label>               
                            <textarea class="form-control" rows="3" id="pm_payment_record_note" name="pm_payment_record_note"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">                  
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input type="submit" value="save" class="btn btn-success" id="submit" >
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
        <i class="fa-credit-card"></i>  Purchase Master Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <?php if(isset($this->session->userdata['myfinal']['purchase_master_listing']['p_add']) && $this->session->userdata['myfinal']['purchase_master_listing']['p_add']==1 || $this->session->userdata['role']==1) { ?>
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_purchase_master"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
            <?php } ?>
        </div>        
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Purchase Order List</h3>
                    <div class="box-tools">
                        <form id="modalform" style="display:none">
                             <input type="text" name="something">
                             <input type="text" name="somethingelse">
                        </form> 
                        <form action="<?php echo base_url() ?>purchase_master_listing" method="POST" id="searchList">
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
                        <th>Bill No</th>
                        <th>Vendor</th>
                        <th>Date</th>
                        <th>Ref #</th>
                        <th>Due Date</th>
                        <th>Pay Term</th>
                        <th>Amount</th>
                        <th>Tax AMT</th>
                        <th>Subtotal</th>
                        <th>Paid</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($purchase_master))
                    {
                        foreach($purchase_master as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->purchase_master_bill_no; ?></td>
                        <td><?php echo $record->vendor_name; ?></td>
                        <td><?php echo $record->purchase_master_date; ?></td>
                        <td><?php echo $record->purchase_master_reference_no; ?></td>
                        <td><?php echo $record->purchase_master_due_date; ?></td>
                        <td><?php echo $record->purchase_master_payment_term; ?></td>
                        <td><?php echo $record->purchase_master_grand_total; ?></td>
                        <td><?php echo $record->purchase_master_tax_amt; ?></td>
                        <td><?php echo $record->purchase_master_sub_total; ?></td>
                        <td><?php echo $record->purchase_master_paid_amt; ?></td>
                        <td class="text-center">

                            <a class="btn btn-sm btn-info payment_record" href="javascript:void(0)" value="<?php echo $record->purchase_master_id; ?>" id="<?php echo 'payment_record'.$record->purchase_master_id; ?>" title="Payment Record" data-toggle="modal" data-target="#contact-modal"><i class="fa fa-money"></i></a>

                            <?php if(isset($this->session->userdata['myfinal']['purchase_master_listing']['p_update']) && $this->session->userdata['myfinal']['purchase_master_listing']['p_update']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_purchase_master/'.$record->purchase_master_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <?php } ?>

                            <a class="btn btn-sm btn-info bg-blue" href="javascript:void(0)" title="PDF"><i class="fa fa-file-pdf-o" id="<?php echo $record->purchase_master_id; ?>" onclick="return get_pdf('<?php echo $record->purchase_master_id; ?>')"></i></a>

                            <a class="btn btn-sm btn-info bg-orange" href="javascript:void(0)" title="E-Mail"><i class="fa fa-envelope-o" id="<?php echo $record->purchase_master_id; ?>" onclick="return send_mail('<?php echo $record->purchase_master_id; ?>')"></i></a>

                            <a class="btn btn-sm btn-info bg-olive" href="<?php echo base_url().'pm_export_exl/'.$record->purchase_master_id; ?>" title="Excel"><i class="fa fa-file-excel-o"></i></a>

                            <?php if(isset($this->session->userdata['myfinal']['purchase_master_listing']['p_delete']) && $this->session->userdata['myfinal']['purchase_master_listing']['p_delete']==1 || $this->session->userdata['role']==1) { ?>
                            <a class="btn btn-sm btn-danger" href="<?php echo base_url().'delete_purchase_master/'.$record->purchase_master_id; ?>" title="Delete" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
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
            jQuery("#searchList").attr("action", baseURL + "purchase_master_listing/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
