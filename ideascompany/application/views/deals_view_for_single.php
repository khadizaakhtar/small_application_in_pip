               <div class="row">
                    <div class="col-sm-12">
                        <div class="main-content border-zero">
                            <h3 class="content-title">Deals</h3>
                               <form method="post" >
                                <ul class="user-list">
                                     <li>
                                          <div data-example-id="contextual-table" class="bs-example">
                                              <table class="table deals-table" style="margin-top: 0;">
                                                      <?php
                                              //echo '<pre>';
                                              //  print_r($result);
                                              //  echo '</pre>';
                                               //  exit;
                                                  
                                    foreach ($result as $v_info) {
                                                    $t=$v_info[12];          
                                                   $town=unserialize($t);
                                        ?>
                                                  <tr class="danger">
                                                      <td>Company Name</td>
                                                      <td><?php echo $v_info[9] ?></td>
                                                  </tr>
                                                  <tr>
                                                      <td>Full Address</td>
                                                       <td><?php foreach($town as $k=>$v_town){ echo $v_town.","; } ?></td>
                                                  </tr> 
                                                     <tr>
                                                      <td>Rent</td>
                                                        <td><?php echo $v_info[2] ?></td>
                                                      </tr>
                                                      <tr>
                                                      <td>Lease Length</td>
                                                      <td><?php echo $v_info[3] ?></td>
                                                      </tr>
                                                      <tr>
                                                      <td>Rent free</td>
                                                        <td><?php echo $v_info[4] ?></td>
                                                      </tr>
                                                      <tr>
                                                      <td>Tenant fit out or LL fit out</td>
                                                       <td><?php echo $v_info[5] ?></td>
                                                      </tr>
                                                      <tr>
                                                      <td>Agents Name</td>
                                                       <td><?php echo $v_info[10] ?></td>
                                                      </tr>
                                                      <tr>
                                                      <td>Agents Phone number</td>
                                                         <td><?php echo $v_info[17] ?></td>
                                                     </tr>
                                              <?php } ?>
                                              </table>      
                                           </div>
                                           <div class="right-align">
                                                   
                                           </div>
                                       </li><!-- user list --> 
                                </ul>
                            </form>
                            <br style="clear:both"/>
                        </div>
                    </div>
                </div>