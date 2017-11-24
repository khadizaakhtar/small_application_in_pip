<?php include('admin_header1.php'); ?>
<?php include('admin_header.php'); ?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                    <div class="col-sm-12">
                        <ol class="menu-list">
                            <li class="home"><a href="<?php echo BASE_URL . 'admin_controller/search_requirements'; ?>">Home</a></li>
                        </ol>
                    </div>
                </div>
            <div class="row">
                <div class="panel-heading"></div>
                <div class="col-sm-12">
                    <div class="main-content">
                          <?php 
                            foreach($result as $v_info){
                               $t= $v_info[2];
                               $town=unserialize($t);
                            }
                            ?>
                        <h3 align='center' class='active'>Edit Requirement</h3>
                        <form action="<?php echo BASE_URL; ?>/admin_controller/update_admin_requirements" method="post">
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Tenant Name</label>
                                <input type="text" name="tenant_name" value="<?php echo $result[0][1]; ?>" class="form-control" placeholder=""/> 
                                <input type="hidden" name="requirement_id" value="<?php echo $result[0][0]; ?>" class="form-control" placeholder=""/> 
                                <input type="hidden" id="townvalue" name="townvalue"  class="form-control" placeholder=""/>
                            </div> 
                            
                            <div class="form-group full-width" id="to">
                                <label for="tenantName" class="label-1">Town</label>
                                <input type="text" value="<?php foreach($town as $k=>$v_town){ echo $v_town.","; }?>" name="town" id="tenantName" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Nationwide</label>
                                <input type="text" value="<?php echo $result[0][3]; ?>" name="rccheck" id="tenantName" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Floor Area From</label>
                                <input type="text" name="floor_area_from" value="<?php echo $result[0][4]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Floor Area To</label>
                                <input type="text" name="floor_area_to" value="<?php echo $result[0][8]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                             <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Re-Site</label>
                                <input type="text" name="resite" id="tenantName"  value="<?php echo $result[0][12]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                           <div class="form-group full-width">
                                <label for="tenantName" class="label-1">Use Class</label>
                                <input type="text" name="use_class" value="<?php echo $result[0][5]; ?>" class="form-control" placeholder=""/> 
                            </div>
                            
                            <div class="form-group full-width">
                                <button type="submit" id="publish"><i class="fa fa-floppy-o"></i> Update</button>
                                <br style="clear:both" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div> 
    </div> 
</div>
<script  type="text/javascript">
                     $(function () {
                     $txtval = [];
                     $('#to input').on('focusout', function () {
                     
                     var txt = this.value;//.replace(/[^a-zA-Z0-9\+\-\.\#]/g, ''); // allowed characters list
                     
                     $txtval.push(txt);
                     $('#townvalue').val($txtval);
                     console.log($txtval);
                     if (txt)
                     $(this).before('<span class="tag">' + txt + '</span>');
                     this.value = "";
                     this.focus();
                     }).on('keyup', function (e) {
                     // comma|enter (add more keyCodes delimited with | pipe)
                     if (/(188|13)/.test(e.which))
                     $(this).focusout();
                     });
                     $('#tags').on('click', '.tag', function () {
                     var tt = $(this).html();
                     $txtval.pop(tt);
                     
                     $('#townvalue').val($txtval);
                     console.log($txtval);
                     $(this).remove();
                     });
                     
                     });
                </script>
<?php include('admin_footer.php'); ?>