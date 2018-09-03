<div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0">Chuẩn bị hàng</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>#SKUs</th>
                                                <th>Số lượng</th>
                                                <th>Tồn kho</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
													$sku = array();
													$c = $mysql->get('account');
													for($j=0;$j<count($c);$j++){
														$token = $c[$j]['access_token'];
														//$a = get_orderid_laz($token, 'pending');
														$a = get_order_laz($token, $status);
															for($i=0;$i<count($a);$i++){
																$b = get_item($token, $a[$i]);
																//get_invoid_laz($token, $a[$i]);
																	foreach ($b['quantity'] as $key => $value){
																		$sku[$key] = $sku[$key] + (int) $value;
                                                                        foreach ($sku as $key => $value){
                                                                       
												?>
                                            <tr>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo $value; ?></td>
                                                <td><?php echo 0; ?></td>
                                                <td><span class="badge badge-info">Released</span></td>
                                                <td></td>
                                                
                                                <td></td>
                                            </tr>
	    										<?php
                                                                 }
	    													}
														}
													}
												?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
