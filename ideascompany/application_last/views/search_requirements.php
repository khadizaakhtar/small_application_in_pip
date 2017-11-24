<!DOCTYPE html>
<html lang="en">   
    <?php include('header_12.php'); ?>
    <style>
        .rs_content{
            background: white none repeat scroll 0 0;
            margin: 40px auto;
            max-width: 500px;
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
                                                        <input  type="checkbox" class="rs_tottgle_select rs_select" name="data[requirement_id][]" value="<?php echo $result[$key]['0']['requirement_id']; ?>">
                                                        <strong><?php echo $result[$key]['0']['tenant_name']; ?></strong>
                                                        <span class="address-1"><i class="fa fa-map-marker"></i> <?php
                                                            $tt = unserialize($result[$key]['0']['town']);
                                                            $comma_separated = implode(" , ", $tt);
                                                            echo $comma_separated;
                                                            ?></span>
                                                        <span class="address-mark"><?php echo $result[$key]['0']['use_class']; ?></span>
                                                        <span class="floor-area"><?php echo $result[$key]['0']['floor_area_from']; ?> ft</span>
                                                        <br/>
                                                        <p id="agent_list_<?php echo $result[$key]['0']['requirement_id']; ?>"></p>
                                                    </div>
                                                    <div class="right-align">
                                                        <a class="popup-with-zoom-anim" href="#my-dialog<?php echo $result[$key]['0']['requirement_id']; ?>"><button type="button" name="data[requirement_id][]" value="<?php echo $result[$key]['0']['requirement_id']; ?>" class="select-user">SELECT</button></a>
                                                        <br style="clear:both"/>
                                                    </div>
                                                    <div id="my-dialog<?php echo $result[$key]['0']['requirement_id']; ?>" class="zoom-anim-dialog mfp-hide rs_content">              
                                                        <?php
//                                          echo '<pre>';
//                                          print_r($req);
//                                          echo '</pre>';
//                                          exit;

                                                        foreach ($req as $k => $require) {
                                                            
                                                            ?>
                                                            <div>
                                                                <div class="left-align rs_left">
                                                                    
                                     <p id="agent_container_<?php echo $result[$key]['0']['requirement_id']; ?>">
  <input type="checkbox"  name="data[agent_id][<?php echo $result[$key]['0']['requirement_id']; ?>][]" value="<?php echo $require['agent_id']; ?>"/>
                                          <span class="telephone-no"> Tel: <?php echo $require['agent_phone_number']; ?></span>
                                                                        <span class="emalil-address"> Email: <?php echo $require['agent_email']; ?></span>
                                                                    </p>

                                                <!--                                                                <input type="hidden" name="data[agent_id][]" value="<?php //echo $require['agent_id'];    ?>">
                                                 <input type="hidden" name="data[requirement_id][]" value="<?php //echo $require['requirement_id'];    ?>">-->
                                                                </div>
                                                                <div class="right-align rs_right">
                    <!--                                                     <button type="button" class="rs_tottgle_select" name="data[agent_id][]" value="<?php //echo $require['agent_id'];     ?>" class="select-user">SELECT</button>--> 
                                                                    <button type="button" class="rs_tottgle_select new_select" name="data[agent_id][<?php echo $result[$key]['0']['requirement_id']; ?>][]" value="<?php echo $require['agent_id']; ?>">SELECT</button>

                                                                    <br style="clear:both"/>
                                                                </div>
                                                            </div>
                                                        <?php }
                                                        ?>
                                                        <p>
<!--                                                        <button type="button" class="rs_btn" onclick="return show_agents('<?php echo $result[$key]['0']['requirement_id']; ?>');">save</button>-->
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
           $(document).ready(function() {
               /* $('.new_select').click(function(e) {
                      alert('fdds');
                 
               if ($('.new_select').prop('checked', true)) {
                         alert('a');
                   
                    $(".rs_select").prop("checked", true);                   
               }else{
               //  if ($('.new_select').prop('checked', false)){
                  alert('b');
                     $(".rs_select").prop("checked", false);
                  // }
                }    

                  });*/
             });

        </script>



        <script>
            $(document).ready(function() {
                $('.rs_tottgle_select').click(function(e) {

                    e.preventDefault();
                    var ele = $(this).parent().parent().find(':checkbox');
                    //alert(ele);

                    if (ele.is(':checked')) {

                        $(this).text('SELECT');
                          alert('khaDIZA1');
 $(".rs_select").prop("checked", false);
                        ele.prop('checked', false);

                        $(this).removeClass('admin_checked');
                    } else {
                        $(this).text('SELECTED');

                        ele.prop('checked', true);
                        
                      alert('khaDIZA2');
 $(".rs_select").prop("checked", true); 
                        $(this).addClass('admin_checked');
                    }
                });
            });
            
            function show_agents(req_id)
            {
                //alert("Hellow World");
                //jQuery('p[id=agent_list_'+req_id+']').html("test");
                jQuery('p[id=agent_list_'+req_id+']').html("");
                
                $(jQuery('p[id=agent_container_'+req_id+']')).each(function( index ) {
                        //console.log( index + ": " + $( this ).text() );
                        //jQuery('p[id=agent_list_'+req_id+']').append($( this ).text()+'<br/>');
                        
                        //console.log($( this ).find('input:checked').val());
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