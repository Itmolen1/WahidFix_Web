
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <img src="<?=base_url()?>assets/images/logos/logo.png" alt="wahidfix" height="51" width="180" />
                        </div>
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                        <p>Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>Pages</h3>
                        </div>

                        <ul class="footer-links hov">
                            <li><a href="<?php echo base_url(); ?>">Home <span class="icon icon-arrow-right2"></span></a></li>
                            <li><a href="<?=base_url();?>About">About <span class="icon icon-arrow-right2"></span></a></li>
                            <li><a href="<?=base_url();?>Services">Our Services <span class="icon icon-arrow-right2"></span></a></li>
                            <li><a href="<?=base_url();?>Booknow">Book Now <span class="icon icon-arrow-right2"></span></a></li>
                            <li><a href="<?=base_url();?>Contact">Contact Us <span class="icon icon-arrow-right2"></span></a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
                
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="footer-distributed widget clearfix">
                        <div class="widget-title">
                            <h3>Subscribe</h3>
                            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which one know this tricks.</p>
                        </div>
                        
                        <div class="footer-right">
                            <form method="get" action="#">
                                <input placeholder="Subscribe our newsletter.." name="search">
                                <i class="fa fa-envelope-o"></i>
                            </form>
                        </div>                        
                    </div><!-- end clearfix -->
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </footer><!-- end footer -->

    <div class="copyrights">
        <div class="container">
            <div class="footer-distributed">
                <div class="footer-left">                   
                    <p class="footer-company-name">All Rights Reserved. &copy; 2019 <a href="#"><?php echo APP_NAME; ?></a> Design By : 
                    <a href="https://html.design/"><?php echo APP_NAME; ?></a></p>
                    <?php /*<div id="sfc4agfju1w3dsraaftuaeerj3mqs6le86m"></div>
					<script type="text/javascript" src="https://counter10.wheredoyoucomefrom.ovh/private/counter.js?c=4agfju1w3dsraaftuaeerj3mqs6le86m&down=async" async></script>
					<noscript><a href="https://www.freecounterstat.com" title="hit counter"><img src="https://counter10.wheredoyoucomefrom.ovh/private/freecounterstat.php?c=4agfju1w3dsraaftuaeerj3mqs6le86m" border="0" title="hit counter" alt="hit counter"></a></noscript> */ ?>                
            	</div>
        </div><!-- end container -->
    </div><!-- end copyrights -->
    <?php if(!isset($this->session->userdata['user']['tbl_user_email'])) { ?>
    <div class="fixed_button" style="cursor: pointer;" data-toggle="modal" data-target="#contact-modal">Schedule a service</div>
    <?php } ?>
    <a href="#" id="scroll-to-top" class="dmtop global-radius"><i class="fa fa-angle-up"></i></a>

    <!-- ALL JS FILES -->
    
    <script defer src="<?=base_url()?>assets/js/all.js"></script>

    <script defer src="<?php echo base_url(); ?>admin/assets/js/jquery.validate.js"></script>
    <script defer src="<?php echo base_url(); ?>admin/assets/js/validation.js"></script>

    <!-- ALL PLUGINS -->
    <script defer src="<?=base_url()?>assets/js/custom.js"></script>
    <script defer src="<?=base_url()?>assets/js/portfolio.js"></script>
    <script defer src="<?=base_url()?>assets/js/hoverdir.js"></script>

    <script>
         $(".readmore").click(function() {
        $('html, body').animate({
            scrollTop: $(".section-title").offset().top
        }, 3000);
    });   
    </script>  

    <script>
    	window.document.onkeydown = function(e) {
  if (!e) {
    e = event;
  }
  if (e.keyCode == 27) {
    lightbox_close();
  }
}

function lightbox_open() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  window.scrollTo(0, 0);
  document.getElementById('light').style.display = 'block';
  document.getElementById('fade').style.display = 'block';
  lightBoxVideo.play();
}

function lightbox_close() {
  var lightBoxVideo = document.getElementById("VisaChipCardVideo");
  document.getElementById('light').style.display = 'none';
  document.getElementById('fade').style.display = 'none';
  lightBoxVideo.pause();
}
    </script>  


<!-- The core Firebase JS SDK is always required and must be listed first -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use
     https://firebase.google.com/docs/web/setup#available-libraries -->
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-analytics.js"></script>
<script src="<?php echo base_url(); ?>firebase-messaging-sw.js"></script>
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDL9mqjFLadYl97hoDGTGRdobQ-JAPzTR8",
    authDomain: "wahidfix-b2fda.firebaseapp.com",
    databaseURL: "https://wahidfix-b2fda.firebaseio.com",
    projectId: "wahidfix-b2fda",
    storageBucket: "wahidfix-b2fda.appspot.com",
    messagingSenderId: "837877987622",
    appId: "1:837877987622:web:0cc51d2a850fcdeaa8e9e7",
    measurementId: "G-0Q09515LCW"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
  firebase.analytics();

  const messaging=firebase.messaging();
  messaging.requestPermission()
  .then(function(){
    console.log('have permission.');
  })
  .catch(function(err){
    console.log('error oucurred.');
  })
</script>
</body>
</html>