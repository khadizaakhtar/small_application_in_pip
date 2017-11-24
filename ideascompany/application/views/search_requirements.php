<!DOCTYPE html>
<html lang="en">   
    <?php include('header_12.php'); ?>
    <style>
        .rs_content{
            background: white none repeat scroll 0 0;
            margin: 40px auto;
            max-width: 580px;
            padding: 20px 30px;
            position: relative;
            text-align: left;
        }
        .rs_left {
            float: left;
            padding: 5px;
        }
     .left-align p{
      color:black !important;
      padding-left:20px !important; 
}
    </style>
    <body>
        <div id="main" class="site-main">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                            <li class="active">Search Location</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content">
                            <form action="<?php echo BASE_URL; ?>/admin_controller/search_requirements/" method="GET" >
                                <div class="form-group full-width-borde">
                                    <input type="text" name="search" class="form-control" placeholder="Enter your location" />
                                    <button type="submit"  class="search-btn"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <?php
                if (isset($result) && !empty($result)) {
                    ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="main-content">
                                <h3 class="content-title">Location</h3>
                                <div style="color:green; text-align: center">
                                    <?php
                                    if (isset($errormessage) && !empty($errormessage)) {
                                        echo $errormessage;
                                    }
                                    ?>
                                </div>

                                <form action="<?php echo BASE_URL; ?>admin_controller/show_requirements" method="post" >
                                    <ul class="user-list">
                                        <?php
                                        if (isset($result) && !empty($result)) {
                                            ?>
                                            <?php
                                            
                                            foreach ($result as $key => $req) { 
                                                ?>
                                                <li>
                                                    <div class="left-align<?php echo $result[$key]['0']['requirement_id']; ?> left-align">
                                                    <div>
                                                        <input  type="checkbox" class="rreq new_selected_<?php echo $result[$key]['0']['requirement_id']; ?>" name="data[requirement_id][]" check-attr="<?php echo $result[$key]['0']['requirement_id']; ?>" value="<?php echo $result[$key]['0']['requirement_id']; ?>"></div>
                                                        <input  type="hidden" name="data[staff_id][]" value="<?php echo $result[$key]['0']['staff_id']; ?>">
                                                        <strong><?php echo $result[$key]['0']['tenant_name']; ?></strong>
                                                        <span class="address-1"><i class="fa fa-map-marker"></i> <?php
                                                            if(!empty($result[$key]['0']['town'])){
                                                            $tt = unserialize($result[$key]['0']['town']);
                                                            $comma_separated = implode(" , ", $tt);
                                                            echo $comma_separated;
                                                                   }
                                                            ?></span>
                                                        <span class="address-mark"><?php echo $result[$key]['0']['use_class']; ?></span>
                                                        <span class="floor-area"><?php echo $result[$key]['0']['floor_area_from']; ?> - <?php echo $result[$key]['0']['floor_area_to']; ?></span>
                                                        <br/>
                                                        <p id="agent_list_<?php echo $result[$key]['0']['requirement_id']; ?>"></p>
                                                    </div>
                                                    <div class="right-align">
                                                        <a class="popup-with-zoom-anim" href="#my-dialog<?php echo $result[$key]['0']['requirement_id']; ?>"><button type="button" name="data[requirement_id][]" value="<?php echo $result[$key]['0']['requirement_id']; ?>" class="select-user">SELECT</button></a>
                                                        <br style="clear:both"/>
                                                    </div>
                                                    <div id="my-dialog<?php echo $result[$key]['0']['requirement_id']; ?>" class="zoom-anim-dialog mfp-hide rs_content">              
                                                        <?php
                                                        foreach ($req as $k => $require) {
                                                            
                                                            ?>
                                                            <div>
                                                                <div class="left-align rs_left">
                                                                    
                                     <p id="agent_container_<?php echo $result[$key]['0']['requirement_id']; ?>">
                                     <input type="checkbox"  name="data[agent_id][<?php echo $result[$key]['0']['requirement_id']; ?>][]" value="<?php echo $require['agent_id']; ?>"/>
  										<span class="agent-name"><?php echo $require['agent_name']; ?> - </span> 
                                          <span class="telephone-no"> Tel: <?php echo $require['agent_phone_number']; ?> - </span>
                                                                        <span class="emalil-address"> Email: <?php echo $require['agent_email']; ?></span>
                                                                    </p>
                                                                      </div>
                                                                <div class="right-align rs_right">

                                                                    <button type="button" class="rs_tottgle_select new_select rm_select" data-attr="<?php echo $result[$key]['0']['requirement_id']; ?>" name="data[agent_id][<?php echo $result[$key]['0']['requirement_id']; ?>][]" value="<?php echo $require['agent_id']; ?>">SELECT</button>

                                                                    <br style="clear:both"/>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                        <p>
                                                        <a href="javascript:void(0);" style="text-decoration:none; color:black; padding-left:25px;" onclick="return show_agents('<?php echo $result[$key]['0']['requirement_id']; ?>');">
                                                            Save
                                                        </a>
                                                            </p>
                                                    </div>
                                                </li>  
                                                <!--                                                 user list  -->
                                                <?php
                                            }
                                        }
                                        ?>

                                    </ul>

                                    <div class="row">
                                        <div class="col-sm-10">
                                            <nav>
                                                <?php if (isset($total_pg) && $total_pg > 1) { ?>
                                                    <ul class="pagination">
                                                        <li>
                                                            <a href="#" aria-label="Previous">
                                                                <span aria-hidden="true">&laquo;</span>
                                                            </a>
                                                        </li>
                                                        <?php for ($i = 1; $i <= $total_pg; $i++) { ?>
                                                            <li><a href="<?php echo BASE_URL . 'admin_controller/search_requirements/?search=' . $_GET['search'] . '&page=' . $i; ?>"><?php echo $i; ?></a></li>
                                                        <?php } ?>
                                                        <li>
                                                            <a href="#" aria-label="Next">
                                                                <span aria-hidden="true">&raquo;</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                
                                                <?php } ?>
                                            </nav>
                                        </div>
                                        <?php
                                        if (isset($result) && !empty($result)) {
                                            ?>
                                            <div class="col-sm-2">
                                                <button type="submit" name="next" class="next-btn">NEXT <i class="fa fa-arrow-right"></i></button>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </form>


                                <br style="clear:both"/>
                            </div>
                        </div>
                    </div>
                <?php } ?>

            </div>
        </div>
        <script>
         $('.rs_tottgle_select').click(function(e) {
            var req=$(this).attr('data-attr');             
                    alert(req);
               $(".rreq").each(function(){
                 var rreq=$(this).val();
                 //var rregg=$(this).attr('check-attr');
                     alert(rreq);
                     
                     console.log(rreq);
                      // alert(rreq);
                       
                         if((rreq == req)  && ($(".new_selected_"+rreq).prop("checked", false))){
                             alert('check');
                             $(".new_selected_"+rreq).prop("checked", true);
                           }
                           
                           else if((rreq == req)  && ($(".new_selected_"+rreq).prop("checked", true))){
                               alert('uncheck');
                              $(".new_selected_"+rreq).prop("checked", false); 
                           }
                      });                    
                  });     
        
        </script>
      
         <script>
            $(document).ready(function() {
                $('.rs_tottgle_select').click(function(e) {                   
                     e.preventDefault();
                    var ele = $(this).parent().parent().find(':checkbox');
                         if (ele.is(':checked')) {
                         $(this).text('SELECT');
                  $(".rs_select").prop("checked", false);
                        ele.prop('checked', false);

                        $(this).removeClass('admin_checked');
                    } else {
                        $(this).text('SELECTED');

                        ele.prop('checked', true);
                  $(".rs_select").prop("checked", true); 
                        $(this).addClass('admin_checked');
                    }
                });             
                });
            
            function show_agents(req_id)
            {
                jQuery('p[id=agent_list_'+req_id+']').html("");
                
                $(jQuery('p[id=agent_container_'+req_id+']')).each(function( index ) {
                        if($( this ).find('input').is(":checked"))
                        {
                            jQuery('p[id=agent_list_'+req_id+']').append($( this ).text()+'<br/>');
                        }
                  });

                  $.magnificPopup.close();
                return false;
            }
        </script>

        <script>
            $('.popup-with-zoom-anim').magnificPopup({
                type: 'inline',
                fixedContentPos: false,
                fixedBgPos: true,
                overflowY: 'auto',
                closeBtnInside: true,
                preloader: false,
                midClick: true,
                removalDelay: 300,
                mainClass: 'my-mfp-zoom-in'
            });

            $('.rs_btn').click(function() {
                $('.rs_content').hide();
            });
        </script>

        <?php include('footer_12.php'); ?>  
    </body>
</html>