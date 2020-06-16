<div class="banner-area banner-bg-1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="banner">
                    <h2>Our Services</h2>
                    <ul class="page-title-link">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Our Services</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

        <!--services section-->
     <div id="about" class="section wb">
        <div class="container">
           <div class="section-title text-center">
            <h3>Our Service</h3>
            <?php
                for($i=0;$i<count($services);$i++) 
                {
            ?>
                <a href="<?php echo base_url().'Detail_page/view/'.$services[$i]['detail_page']; ?>"><div class="col-md-3 col-sm-6">
                    <div class="about-item">
                        <div class="about-icon">
                            <span class="icon"><img height="128" width="128" src="<?php echo $services[$i]['service_logo']; ?>" alt="wahidfix"></span>
                        </div>
                        <div class="about-text">
                            <h3> <a href="#"><?php echo $services[$i]['service_name']; ?></a></h3>
                            <p><?php echo mb_strimwidth($services[$i]['service_desc'], 0, 84, "..."); ?> </p>
                        </div>
                    </div>
                </div>
                </a>
            <?php } ?>   
            </div>
        </div>
    </div>