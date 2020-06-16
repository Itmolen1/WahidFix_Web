<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard
        <small>Control panel</small>
      </h1>
    </section>
    
    <section class="content">
        <div class="row">

            <?php if(isset($data['new_task'])) { ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3><?php echo $data['new_task']; ?></h3>
                  <p>New Tasks</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="<?php echo base_url(); ?>service_request_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>


            <?php if(isset($data['completed_task'])) {  ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['completed_task']; ?><sup style="font-size: 20px"></sup></h3>
                  <p>Completed Tasks</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="<?php echo base_url(); ?>service_request_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <?php if(isset($data['total_employees'])) {  ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['total_employees']; ?></h3>
                  <p>Total Employees</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="<?php echo base_url(); ?>employee_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

            <?php if(isset($data['total_users'])) {  ?>
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3><?php echo $data['total_users']; ?></h3>
                  <p>Total Users</p>
                </div>
                <div class="icon">
                  <i class=""></i>
                </div>
                <a href="<?php echo base_url(); ?>r_user_listing" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <?php } ?>

          </div>
    </section>
</div>