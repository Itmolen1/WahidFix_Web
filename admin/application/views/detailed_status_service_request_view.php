<style type="text/css">
    ol.progtrckr {
    margin: 0;
    padding: 0;
    list-style-type none;
}

ol.progtrckr li {
    display: inline-block;
    text-align: center;
    line-height: 3.5em;
}

ol.progtrckr[data-progtrckr-steps="2"] li { width: 49%; }
ol.progtrckr[data-progtrckr-steps="3"] li { width: 33%; }
ol.progtrckr[data-progtrckr-steps="4"] li { width: 24%; }
/*ol.progtrckr[data-progtrckr-steps="5"] li { width: 19%; }*/
ol.progtrckr[data-progtrckr-steps="6"] li { width: 16%; }
ol.progtrckr[data-progtrckr-steps="7"] li { width: 14%; }
ol.progtrckr[data-progtrckr-steps="8"] li { width: 12%; }
ol.progtrckr[data-progtrckr-steps="9"] li { width: 11%; }

ol.progtrckr li.progtrckr-done {
    color: black;
    border-bottom: 4px solid yellowgreen;
}
ol.progtrckr li.progtrckr-todo {
    color: silver; 
    border-bottom: 4px solid silver;
}

ol.progtrckr li:after {
    content: "\00a0\00a0";
}
ol.progtrckr li:before {
    position: relative;
    bottom: -2.5em;
    float: left;
    left: 50%;
    line-height: 1em;
}
ol.progtrckr li.progtrckr-done:before {
    content: "\2713";
    color: white;
    background-color: yellowgreen;
    height: 2.2em;
    width: 2.2em;
    line-height: 2.2em;
    border: none;
    border-radius: 2.2em;
}
ol.progtrckr li.progtrckr-todo:before {
    content: "\039F";
    color: silver;
    background-color: white;
    font-size: 2.2em;
    bottom: -1.2em;
}


</style>
<div class="content-wrapper">
    <section class="content-header">
    <h1>
        <i class="fa fa-binoculars"></i> Service Request Detailed Status
    </h1>
    </section>
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
              <!-- general form elements -->
                
                <div class="box box-primary">
                    <div><?php 
                        $res=json_decode($sr_details['status_history'],true);
                        $status_name=array_column($res,'status_name');
                        $status_time=array_column($res,'status_time');
                        //echo "<pre>";print_r($res);die;
                        //$st=explode(',',$sr_details['status_history']);
                        //echo "<pre>";print_r($st);
                        ?>
                    </div>
                        <div class="box-body">
                            <ol class="progtrckr" data-progtrckr-steps="5">
                                <?php for($i=0;$i<count($status_name);$i++) { ?>
                                    <li class="progtrckr-done"><?php echo $status_name[$i].' : '.$status_time[$i]; ?></li>
                                <?php } ?>
                                <?php /*<li <?php if(isset($st[0])){ echo 'class="progtrckr-done"'; } else { echo 'class="progtrckr-todo"';} ?>>New Order - <?php if(isset($st[0])) echo $st[0]; ?></li>
                                <li <?php if(isset($st[1])){ echo 'class="progtrckr-done"'; } else { echo 'class="progtrckr-todo"';} ?>>Assigned - <?php if(isset($st[1])) echo $st[1]; ?></li>
                                <li <?php if(isset($st[2])){ echo 'class="progtrckr-done"'; } else { echo 'class="progtrckr-todo"';} ?>>In Progress - <?php if(isset($st[2])) echo $st[2]; ?></li>
                                <li <?php if(isset($st[3])){ echo 'class="progtrckr-done"'; } else { echo 'class="progtrckr-todo"';} ?>>Unpaid - <?php if(isset($st[3])) echo $st[3]; ?></li>
                                <li <?php if(isset($st[4])){ echo 'class="progtrckr-done"'; } else { echo 'class="progtrckr-todo"';} ?>>Completed - <?php if(isset($st[4])) echo $st[4]; ?></li>*/?>
                            </ol>
                        </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <a href="<?php echo base_url().'service_request_listing'; ?>"><input type="Button" class="btn btn-default" value="Back" /></a>
                </div>
                    
            </div>
        </div>
    </section>
</div>