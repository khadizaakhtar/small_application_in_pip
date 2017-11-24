<!DOCTYPE html>
<html lang="en">
<?php include('header_12.php'); ?>
<?php include('pdf_view.php'); ?>
    <style>
         #my-dialog{
        background: white none repeat scroll 0 0;
        margin: 40px auto;
        max-width: 400px;
        padding: 20px 30px;
        position: relative;
        text-align: left;
            }
    </style>
<body>
<div id="main" class="site-main">

        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                <ol class="menu-list">
                  <li class="home"><a href="<?php echo BASE_URL.'admin_controller/search_requirements'; ?>">Home</a></li>
                  <li class="active"> SEARCH</li>
                </ol>
                </div>
            </div>
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <form class="form-inline" method="get" action="<?php echo BASE_URL; ?>admin_controller/find_a_property/">
                        <div class="form-group full-width-borde">
                            <input type="text" name="search" class="form-control search-input" placeholder="Search" />
                            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
                           <!-- <div class="select">
                            <select id="nationWide" class="selectpicker" data-style="btn-select">
                                <option value="Adam">Property</option>
                            </select>
                            </div> -->
                        </div>
                    </form>
                </div>
            </div>
            </div>
<!--            <div id="my-dialog">
                khadiza
            </div>-->
            <div class="row">
            <div class="col-sm-12">
                <div class="main-content">
                    <h3 class="content-title">PROPERTY</h3>
                    <ul class="property-list property-stats">
                        <?php
                        if(isset($result) && !empty($result) ){
                            foreach ($result as $k=>$v_result) {
                              // echo '<pre>'; print_r($v_result);echo '</pre>';die();
                                ?>
                        <li>
                            <div class="property-image"><img src="<?php echo BASE_URL; ?>uploads/<?php echo $v_result['image'] ?>" alt="image" /></div>
                            <div class="property-details">
                                <span><i class="fa fa-map-marker"></i><?php echo $v_result['town']; ?>, <?php echo $v_result['country']; ?></span><span><i class="address-mark"><?php echo $v_result['use_class'] ?></i> Site: <?php echo $v_result['floor_area']; ?> sq ft | Ancillary: <?php echo $v_result['ancillary_area']; ?> sq ft</span>
                                <p><?php echo $v_result['address_line1']; ?>, <?php echo $v_result['address_line2']; ?>, <?php echo $v_result['address_line3']; ?>, <?php echo $v_result['town'];?>, <?php echo $v_result['postcode'];?></p>
                            </div>
                            <!-- <button type="button" name="history" class="history-btn">Send PDF </button> -->
                            <a data-toggle="modal" data-target="<?php echo '#'.$k ?>"  class="history-btn" href="#">Send PDF</a>
                                 <div class="modal fade" id="<?php echo $k ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">PDF Details</h4>
      </div>
      <div class="modal-body">
          <form action="<?php echo BASE_URL; ?>admin_controller/send_pdf_for_individual_property/<?php echo $v_result['property_id']; ?>" method="post">
          
        <div class="information">
                <div >
                    <h1>Property</h1>
                    
                        <p>Address Line1: <?php echo $v_result['address_line1'];?></p>
                        <p>Address Line2: <?php echo $v_result['address_line2'];?></p>
                        <p>Address Line3: <?php echo $v_result['address_line3'];?></p>
                        <p>Town: <?php echo $v_result['town'];?></p>
                        <p>County: <?php echo $v_result['country'];?></p>
                        <p>Postcode: <?php echo $v_result['postcode'];?></p>
                        <p>Use Class: <?php echo $v_result['use_class'];?></p>
                        
                    
                </div>
          <label>
                Email Message:
            </label> 
            
            <!-- <input type="text" name="data[emailbody]" value='Hi...' class="form-control"/> -->
            
            <textarea cols="40" rows="5" name="data[emailbody]" class="form-control">
Hi...
</textarea>
            
            
        
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
          </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
    
    
                        </li>
                            <?php } }?>
                    </ul><br style="clear:both"/>
                    <?php if(isset($total_pg) && $total_pg>1){?>
                    <div class="row">
                        <div class="col-sm-12">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <?php for ($i=1; $i<=$total_pg; $i++) {  ?>
                            <li><a href="<?php echo BASE_URL.'admin_controller/find_a_property/?search='.$_GET['search'].'&page='.$i; ?>"><?php echo $i; ?></a></li>
                            
                            <?php } ?>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>
                        </div>
                    </div>
                    <br style="clear:both"/>
                </div>
                <?php } ?>
            </div>  
             </div>
        </div>
    </div>
    
    
    
    
    
    
    
   


<?php include('footer_12.php'); ?>  
     <script>
//      $('.popup-with-zoom-anim').magnificPopup({
//           type: 'inline',
//           fixedContentPos: false,
//           fixedBgPos: true,
//           overflowY: 'auto',
//           closeBtnInside: true,
//           preloader: false,
//           midClick: true,
//           removalDelay: 300,
//           mainClass: 'my-mfp-zoom-in'
//        });

     </script>
</body>
</html>