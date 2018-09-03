<div class="col-lg-12">
                                <div class="card-box">
                                    <h4 class="header-title m-t-0">Đơn hàng</h4>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Mã đơn</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            	<?php
                                                $a = $mysql->get('orderid');
                                                for($i=0;$i<count($a);$i++){

                                                ?>
                                            <tr>
                                                <td><?php echo $a[$i]['source']; ?></td>
                                                <td><?php echo $a[$i]['order_id']; ?></td>
                                                <?php if($a[$i]['status'] == 'pending'){ ?>
                                                <td><span class="badge badge-warning">Chờ xử lí</span></td>
                                                <?php }elseif($a[$i]['status'] == 'canceled'){ ?>
                                                <td><span class="badge badge-danger">Đã Hủy</span></td>
                                                <?php }elseif($a[$i]['status'] == 'failed'){ ?>
                                                <td><span class="badge badge-danger">Đã Hủy</span></td>
                                                <?php }elseif($a[$i]['status'] == 'delivered'){ ?>
                                                <td><span class="badge badge-success">Hoàn Thành</span></td>
                                                <?php }elseif($a[$i]['status'] == 'shipped'){ ?>
                                                <td><span class="badge badge-info">Đang trong kho</span></td>
                                                <?php }elseif($a[$i]['status'] == 'returned'){ ?>
                                                <td><span class="badge badge-danger">Bị hoàn</span></td>
                                                <?php }elseif($a[$i]['status'] == 'ready_to_ship'){ ?>
                                                <td><span class="badge badge-info">Đang vận chuyển</span></td>
                                                <?php } ?>
                                                <td></td>
                                                
                                                <td></td>
                                            </tr>
	    										<?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
