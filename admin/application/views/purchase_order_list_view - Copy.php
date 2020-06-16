<script type="text/javascript">
    function get_pdf(val)
    {
        //alert(val);
        var data = val;
        var baseURL = '<?php echo base_url(); ?>';
        var hitURL = baseURL + "purchase_order_pdf";
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
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-shopping-cart"></i>  Purchase Order Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>add_new_purchase_order"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Purchase Order List</h3>
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
                        <th>Bill No</th>
                        <th>Vendor</th>
                        <th>Date</th>
                        <th>Referance #</th>
                        <th>Due Date</th>
                        <th>Payment Term</th>
                        <th>Amount</th>
                        <th>Tax Amount</th>
                        <th>Subtotal</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($purchase_order))
                    {
                        foreach($purchase_order as $record)
                        {
                    ?>
                    <tr>
                        <td><?php echo $record->purchase_order_bill_no; ?></td>
                        <td><?php echo $record->vendor_name; ?></td>
                        <td><?php echo $record->purchase_order_date; ?></td>
                        <td><?php echo $record->purchase_order_reference_no; ?></td>
                        <td><?php echo $record->purchase_order_due_date; ?></td>
                        <td><?php echo $record->purchase_order_payment_term; ?></td>
                        <td><?php echo $record->purchase_order_grand_total; ?></td>
                        <td><?php echo $record->purchase_order_tax_amt; ?></td>
                        <td><?php echo $record->purchase_order_sub_total; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($record->purchase_order_created_at));  ?></td>
                        <td class="text-center">
                            <a class="btn btn-sm btn-info" href="<?php echo base_url().'edit_purchase_order/'.$record->purchase_order_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-sm btn-info bg-orange" href="javascript:void(0)" title="Pdf"><i class="fa fa-file-pdf-o" id="<?php echo $record->purchase_order_id; ?>" onclick="return get_pdf('<?php echo $record->purchase_order_id; ?>')"></i></a>
                            <a class="btn btn-sm btn-info bg-olive" href="<?php echo base_url().'edit_purchase_order/'.$record->purchase_order_id; ?>" title="Excel"><i class="fa fa-file-excel-o"></i></a>
                            <a class="btn btn-sm btn-danger deleteUser" href="<?php echo base_url().'delete_purchase_order/'.$record->purchase_order_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
