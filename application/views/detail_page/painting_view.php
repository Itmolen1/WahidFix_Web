 <div id="about" class="section wb">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="message-box">
                        <h4><?php echo $service['service_name']; ?></h4>
                        <h2><?php echo 'Welcome to '.APP_NAME.$service['service_name'];?></h2>
                        <p class="lead"><?php echo $service['service_desc']; ?></p>
                        <ul>
                            <?php for($i=0;$i<count($sub_services);$i++) { ?>
                            <li style="list-style: square;"><?php echo $sub_services[$i]['sub_service_name']; ?></li>
                        <?php } ?>
                        </ul>
                        <a href="<?php echo base_url().'Scedule_service/'.$service['detail_page']; ?>" class="btn btn-light btn-radius btn-brd grd1">Schedule Service</a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->

                <div class="col-md-6">
                    <div class="post-media wow fadeIn">
                        <img src="<?php echo $service['service_logo']; ?>" alt="" class="img-responsive img-rounded">
                    </div><!-- end media -->
                </div>
            </div><!-- end row -->
            <hr class="hr1"> 
        </div><!-- end container -->
    </div><!-- end section -->