<div class="banner-area banner-bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    <h2>Our Services Taken By You</h2>
                    <ul class="page-title-link">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Services Taken</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

        <!--services section-->
     <div id="about" class="section wb">
        <div class="container">

             <?php
             if(isset($this->session->userdata['suc_service'])) { ?>
                <script>
                    $(document).ready(function() {
                        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
                          $("#success-alert").slideUp(500);
                        });
                    });
                </script>
                <div class="alert alert-success" id="success-alert">
                  <button type="button" class="close" data-dismiss="alert">x</button>
                  <strong>Success! </strong>We Have Successfully Registered your service request we will contact you ASAP.
                </div>
            <?php
            $this->session->unset_userdata('suc_service'); 
            } ?>

           <div class="section-title text-center">
            <h3>Service History</h3>
            <table class="table table-striped table-bordered table-hover">
                <tr>
                    <td>Sr. No</td>
                    <td>Order No</td>
                    <td>Services Name</td>
                    <td>Requested Date</td>
                    <td>Requested Time</td>
                    <td>Status</td>
                </tr>
                <?php
                    for($i=0;$i<count($services);$i++) 
                    {
                ?>
                <tr>
                    <td><?php echo $i+1; ?></td>
                    <td><?php echo $services[$i]['service_request_ref']; ?></td>
                    <td><ol>
                        <?php for($j=0;$j<count($services[$i]['service_list']);$j++) { ?>
                            <li><?php echo $services[$i]['service_list'][$j]['service_name']; ?></li>
                        <?php } ?>
                    </ol></td>
                    <td><?php echo $services[$i]['prefferd_date']; ?></td>
                    <td><?php if($services[$i]['prefferd_time']==0) echo 'Anytime'; else if($services[$i]['prefferd_time']==1) echo '10:00 AM - 01:00 PM'; else if($services[$i]['prefferd_time']==2) echo '01:00 PM - 04:00 PM';else if($services[$i]['prefferd_time']==3) echo '04:00 PM - 07:00 PM'; ?></td>
                    <td><?php if($services[$i]['status']==0) echo 'New'; else if($services[$i]['status']==1) echo 'Accepted By Admin'; else if($services[$i]['status']==2) echo 'Rejected By Admin';else if($services[$i]['status']==3) echo 'Assigned'; else if($services[$i]['status']==4) echo 'Inprogress'; else if($services[$i]['status']==5) echo 'Unpaid'; else if($services[$i]['status']==6) echo 'Completed'; else if($services[$i]['status']==7) echo 'Cancelled By you';?></td>
                </tr>
                <?php } ?>
            </table>
            </div>
        </div>
    </div>