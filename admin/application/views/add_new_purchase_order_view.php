<?php 
$last = $this->uri->total_segments();
$record_num = $this->uri->segment($last);
$this->session->set_userdata('referred_from', current_url());
?>
<?php 
if(isset($record_num))
{
?>
<script type="text/javascript">
 $(window).bind("load", function() {
    
        var session_id = $('#session_id').val();
        var baseURL = $('#base').val();
        var hitURL = baseURL + "edit_po_boi_session";
       
            $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { session_id : session_id } 
            }).done(function(data){
                console.log(data);
                $('#boi_table > tbody').html('');
                $('#boi_table > tbody').html(data.finalresult);
                $('#purchase_order_sub_total').val('');
                $('#purchase_order_sub_total').val(data.subtotal);
                $('#purchase_order_tax_amt').val('');
                $('#purchase_order_tax_amt').val(data.taxamount);
                $('#purchase_order_grand_total').val('');
                $('#purchase_order_grand_total').val(data.grandtotal);  
            });   
});
</script>
<?php 
}
?>
<script type="text/javascript">
function DoTrim(strComp) {
            ltrim = /^\s+/
            rtrim = /\s+$/
            strComp = strComp.replace(ltrim, '');
            strComp = strComp.replace(rtrim, '');
            return strComp;
}


 jQuery(document).ready(function(){
    
    jQuery(document).on("click", "#add_po_boi_session", function(){


        /*validation*/

        var fields;
        fields = "";
        if (document.add_new_purchase_order.item_master_id_session.selectedIndex=="")
        {
            if(fields != 1)
            {
                document.getElementById("item_master_id_session").focus();
            }
            fields = '1';
            $("#item_master_id_session").addClass("error");
        }
        if (DoTrim(document.getElementById('po_boi_detail_session').value).length == 0)
        {
            if(fields != 1)
            {
                document.getElementById("po_boi_detail_session").focus();
            }
            fields = '1';
            $("#po_boi_detail_session").addClass("error");
            //document.getElementById('po_boi_detail_session').className = 'error';
        }
        if (document.add_new_purchase_order.item_unit_id_session.selectedIndex=="")
        {
            if(fields != 1)
            {
                document.getElementById("item_unit_id_session").focus();
            }
            fields = '1';
            $("#item_unit_id_session").addClass("error");
        }
        if (DoTrim(document.getElementById('po_boi_qty_session').value).length == 0)
        {
            if(fields != 1)
            {
                document.getElementById("po_boi_qty_session").focus();
            }
            fields = '1';
            $("#po_boi_qty_session").addClass("error");
            //document.getElementById('po_boi_qty_session').className = 'error';
        }
        if (DoTrim(document.getElementById('po_boi_rate_session').value).length == 0)
        {
            if(fields != 1)
            {
                document.getElementById("po_boi_rate_session").focus();
            }
            fields = '1';
            $("#po_boi_rate_session").addClass("error");
            //document.getElementById('po_boi_rate_session').className = 'error';
        }
        if (fields != "") 
        {
            fields = "Please fill in the following details:" + fields;
            return false;
        }
        /*validation*/

        var item_master_id_session = $('#item_master_id_session').val();
        var item_unit_id_session = $("#item_unit_id_session").val();
        var po_boi_qty_session = $("#po_boi_qty_session").val();
        var po_boi_rate_session = $("#po_boi_rate_session").val();
        var po_boi_detail_session = $('#po_boi_detail_session').val();
        var baseURL = $('#base').val();
        var hitURL = baseURL + "add_po_boi_session";
        //alert(item_master_id);
        
            $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { item_master_id_session : item_master_id_session,po_boi_detail_session:po_boi_detail_session,item_unit_id_session:item_unit_id_session,po_boi_qty_session:po_boi_qty_session,po_boi_rate_session:po_boi_rate_session} 
            }).done(function(data){
                console.log(data);
                $('#item_master_id_session').val("0");
                $('#po_boi_detail_session').val('');
                $('#item_unit_id_session').val("0");
                $('#po_boi_qty_session').val('');
                $('#po_boi_rate_session').val('');
                $('#boi_table > tbody').html('');
                $('#boi_table > tbody').html(data.finalresult);
                $('#purchase_order_sub_total').val('');
                $('#purchase_order_sub_total').val(data.subtotal);
                $('#purchase_order_tax_amt').val('');
                $('#purchase_order_tax_amt').val(data.taxamount);
                $('#purchase_order_grand_total').val('');
                $('#purchase_order_grand_total').val(data.grandtotal);  
                //if(data.status = true) { alert("Record successfully deleted"); }
                //else if(data.status = false) { alert("Record deletion failed"); }
                //else { alert("Access denied..!"); }
            });
    });

   
});
</script>
<script type="text/javascript">
	function del_poi_id(val)
	{
		//alert(val);
		var data = val;
        var baseURL = $('#base').val();
        var hitURL = baseURL + "delete_po_boi_session";
        $.ajax({
            type : "POST",
            dataType : "json",
            url : hitURL,
            data : { data : data } 
            }).done(function(data){
                console.log(data);
                $('#boi_table > tbody').html('');
                $('#boi_table > tbody').html(data.finalresult);
                $('#purchase_order_sub_total').val('');
                $('#purchase_order_sub_total').val(data.subtotal);
                $('#purchase_order_tax_amt').val('');
                $('#purchase_order_tax_amt').val(data.taxamount);
                $('#purchase_order_grand_total').val('');
                $('#purchase_order_grand_total').val(data.grandtotal);  
            });
	}
</script>

<script type="text/javascript">
    $(function () {
    $('.selectpicker').selectpicker();
});
</script>
<style type="text/css">
    table, thead,tbody ,td, th {
  border: 1px solid black;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-shopping-cart"></i> Purchase Order Management
        <small><?php 
                    if(is_numeric($record_num))
                        {    echo "Edit";   }
                    else
                    {
                        echo "Add"; } ?> Purchase Order</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Purchase Order Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" name="add_new_purchase_order" id="add_new_purchase_order" action="<?php echo base_url().$action; ?>" method="post" enctype="multipart/form-data">
                        <div class="box-body">
                            <?php
                                if(isset($record_num))
                                {
                                    ?><input type="hidden" id="purchase_order_id" name="purchase_order_id" value="<?php echo $record_num; ?>">
                                    <?php
                                }
                                if (isset($session_id)) 
                                {
                                    ?>
                                    <input type="hidden" id="session_id" name="session_id" value="<?php echo $session_id; ?>">
                                    <?php
                                }
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_order_venodr_id">Vendor</label>
                                        <select class="form-control required" id="purchase_order_venodr_id" name="purchase_order_venodr_id">
                                            <option value="0">Select Vendor</option>
                                            <?php for($i=0;$i<count($vendor);$i++){ ?>
                                                <option value="<?php echo $vendor[$i]['vendor_id']; ?>" <?php if(isset($purchase_order) && $purchase_order['purchase_order_venodr_id']==$vendor[$i]['vendor_id']){ echo 'selected="selected"'; } ?>><?php echo $vendor[$i]['vendor_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" id="base" value="<?php echo base_url(); ?>">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_order_bill_no">Bill No#</label>
                                        <input type="text" class="form-control required" id="purchase_order_bill_no" value="<?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_bill_no']; } else echo $bill_no; ?>" name="purchase_order_bill_no" maxlength="128" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_order_date">Bill Date</label>
                                        <input type="date" class="form-control required" value="<?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_date']; } ?>" id="purchase_order_date" name="purchase_order_date">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                         <label for="purchase_order_payment_term"> Payment Term</label>
                                        <input type="text" class="form-control required" id="purchase_order_payment_term" value="<?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_payment_term']; } ?>" name="purchase_order_payment_term" maxlength="128">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_order_due_date">Due Date</label>
                                        <input type="date" class="form-control required" value="<?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_due_date']; } ?>" id="purchase_order_due_date" name="purchase_order_due_date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_order_reference_no">Reference #</label>
                                        <input type="text" class="form-control required" value="<?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_reference_no']; } ?>" id="purchase_order_reference_no" name="purchase_order_reference_no">
                                    </div>
                                </div>
                            </div>

                            
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="item_master_id">Item</label>
                                        <select class="form-control required" id="item_master_id_session" name="item_master_id_session">
                                            <option value="0">Select Item</option>
                                            <?php for($i=0;$i<count($item);$i++){ ?>
                                                <option value="<?php echo $item[$i]['item_master_id']; ?>" <?php if(isset($vehicle) && $vehicle['item_master_id']==1){ echo 'selected="selected"'; } ?>><?php echo $item[$i]['item_master_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="po_boi_detail">Desc.</label>
                                        <input class="form-control required" id="po_boi_detail_session" name="po_boi_detail_session" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="item_unit_id_session">Unit</label>
                                        <select class="form-control required" id="item_unit_id_session" name="item_unit_id_session">
                                            <option value="0">Select Unit</option>
                                            <?php for($i=0;$i<count($unit);$i++){ ?>
                                                <option value="<?php echo $unit[$i]['item_unit_id']; ?>" <?php if(isset($vehicle) && $vehicle['item_unit_id']==1){ echo 'selected="selected"'; } ?>><?php echo $unit[$i]['item_unit_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="po_boi_qty">Qty</label>
                                        <input class="form-control required" id="po_boi_qty_session" name="po_boi_qty_session" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="po_boi_rate">Unit Price</label>
                                        <input type=number step=0.01 class="form-control required" id="po_boi_rate_session" value="" name="po_boi_rate_session" maxlength="6">
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label for="vehicle_tc_no">+</label>
                                        <input type="button" class="form-control btn btn-primary" id="add_po_boi_session" name="btn" value="Add">
                                    </div>
                                </div>
                            </div>
                          

                            <div class="row">
                                <div class="col-xs-12 table-responsive">
                                      <table class="table table-striped" id="boi_table">
                                        <thead>
                                        <tr>
                                          <th>Sr. No</th>
                                          <th>Item Name</th>
                                          <th>Description</th>
                                          <th>Unit</th>
                                          <th>Quantity</th>
                                          <th>Unit Price</th>
                                          <th>Total</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        
                                        </tbody>
                                      </table>
                                    </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-9">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="purchase_order_vendor_notes">Vendor Notes</label>
                                             <textarea class="form-control" rows="3" id="purchase_order_vendor_notes" name="purchase_order_vendor_notes"><?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_vendor_notes']; } ?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                             <label for="purchase_order_tc">Terms and Condition</label>
                                             <textarea class="form-control" rows="3" id="purchase_order_tc" name="purchase_order_tc"><?php if(isset($purchase_order)){ echo $purchase_order['purchase_order_tc']; } ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-3">
                                  <div class="table-responsive">
                                    <table class="table">
                                      <tbody><tr>
                                        <th style="width:50%">Subtotal:</th>
                                        <td><input type="text" class="form-control required" id="purchase_order_sub_total" value="<?php if(isset($vehicle)){ echo $vehicle['purchase_order_sub_total']; } ?>" name="purchase_order_sub_total" maxlength="128" readonly></td>
                                      </tr>
                                      <tr>
                                        <th>Tax</th>
                                        <td><input type="text" class="form-control required" id="purchase_order_tax_per" value="5%" name="purchase_order_tax_per" maxlength="128" readonly></td>
                                      </tr>
                                      <tr>
                                        <th>Tax Amount</th>
                                        <td><input type="text" class="form-control required" id="purchase_order_tax_amt" value="<?php if(isset($vehicle)){ echo $vehicle['purchase_order_tax_amt']; } ?>" name="purchase_order_tax_amt" maxlength="128" readonly></td>
                                      </tr>
                                      <tr>
                                        <th>Grand Total:</th>
                                        <td><input type="text" class="form-control required" id="purchase_order_grand_total" value="<?php if(isset($vehicle)){ echo $vehicle['purchase_order_grand_total']; } ?>" name="purchase_order_grand_total" maxlength="128" readonly></td>
                                      </tr>
                                    </tbody></table>
                                  </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                         <label for="purchase_order_image">Choose File</label>
                                         <input type="file" class="form-control <?php if(!isset($purchase_order)){ echo 'required'; } ?>" value="<?php echo isset($purchase_order->purchase_order_image) ? $purchase_order->purchase_order_image : ""; ?>" id="purchase_order_image" name="purchase_order_image">
                                    </div>
                                </div>                                
                            </div>
                            <?php if(isset($purchase_order)){ ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <label for="purchase_order_image">Current Image</label>
                                        <img src="<?php echo $purchase_order['purchase_order_image']; ?>" height="200" width="250">
                                        <input type="hidden" name="purchase_order_image_old" value="<?php echo $purchase_order['purchase_order_image']; ?>" id="tbl_employee_id_card_old">
                                        </div>
                                    </div>
                                <?php }  ?>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="submit" class="btn btn-primary" value="<?php if(isset($record_num)) echo "Save"; else echo "Submit"; ?>" />
                            <input type="reset" class="btn btn-default" value="Reset" />
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
            </div>
        </div>    
    </section>
</div>
<script src="<?php echo base_url(); ?>assets/js/add_new_purchase_order_view.js" type="text/javascript"></script>
<script type="text/javascript">
$(window).on("beforeunload", function() {
            return "Are you sure? You didn't finish the form!";
        });
        
        $(document).ready(function() {
            $("#add_new_purchase_order").on("submit", function(e) {
                //check form to make sure it is kosher
                //remove the ev
                $(window).off("beforeunload");
                return true;
            });
        });
</script>