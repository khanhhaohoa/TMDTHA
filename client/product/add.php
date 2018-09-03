 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    <div class="col-lg-12" id="reloadform">

                                    <div class="card-box">
                                        <h4 class="header-title m-t-0">Thêm sản phẩm</h4>

                                        <form action="#" novalidate="">
                                            <div class="form-group">
                                                <label for="userName">SKUS<span class="text-danger">*</span></label>
                                                <input type="text" id="sku" parsley-trigger="change" required="" placeholder="Enter SKUS" class="form-control" id="userName">
                                            </div>
                                            <div class="form-group">
                                                <label for="emailAddress">Tên sản phẩm<span class="text-danger">*</span></label>
                                                <input type="text" id="name" parsley-trigger="change" required="" placeholder="Enter Tên sản phẩm" class="form-control" id="emailAddress">
                                            </div>
                                            <div class="form-group">
                                                <label for="pass1">Giá bán<span class="text-danger">*</span></label>
                                                <input id="price" type="number" placeholder="Giá thành" required="" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="passWord2">Tồn Kho <span class="text-danger">*</span></label>
                                                <input id="inventory" type="number" required="" placeholder="Tồn Kho" class="form-control" id="passWord2">
                                            </div>

                                            <div class="form-group text-right m-b-0">
                                                <button id="nhapkho" class="btn btn-primary waves-effect waves-light" type="submit">
                                                    Duyệt
                                                </button>
                                            </div>

                                        </form>
                                    </div> <!-- end card-box -->
                                </div>



<div class="col-12" id="reload">
                                <div class="card-box table-responsive">
                                    <h4 class="m-t-0 header-title">Danh sách sản phẩm</h4>
                                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                        <thead>
                                        <tr>
                                            <th>#CODE</th>
                                            <th>SKU</th>
                                            <th>NAME</th>
                                            <th>PRICE</th>
                                            <th>INVENTORY</th>
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>


                                        <tbody>
                                            <?php
                                                $data = $mysql->order_by('id', 'DESC')->get('product_main');
                                                for($i=0;$i<count($data);$i++){
                                            ?>
                                        <tr>
                                            <td><?php echo $data[$i]['id']; ?></td>
                                            <td><?php echo $data[$i]['sku']; ?></td>
                                            <td><?php echo $data[$i]['name']; ?></td>
                                            <td><?php echo $data[$i]['price']; ?></td>
                                            <td><?php echo $data[$i]['inventory']; ?></td>
                                            <td>
                                                <a href="#custom-modal" id="modaldata" class="btn btn-sm btn-primary waves-effect waves-light" data-animation="superscaled" data-plugin="custommodal" data-overlayspeed="100" data-overlaycolor="#36404a" data-id="<?php echo $data[$i]['sku']; ?>">Upload</a>
                                                <a href="#con-close-modal" id="modaledit" class="btn btn-sm btn-warning waves-effect waves-light" data-toggle="modal" data-target="#con-close-modal" data-todo='{"sku":"<?php echo $data[$i]['sku']; ?>","name":"<?php echo $data[$i]['name']; ?>","price":<?php echo $data[$i]['price']; ?>,"inventory":<?php echo $data[$i]['inventory']; ?>}' >EDIT</a>
                                                <a href="#accordion-modal" class="btn btn-sm btn-success waves-effect waves-light" data-toggle="modal" data-target="#accordion-modal">VIEW</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>








                <!-- Custom Modal -->
                        <div id="custom-modal" class="modal-demo">
                            <button type="button" class="close" onclick="Custombox.close();">
                                <span>&times;</span><span class="sr-only">Close</span>
                            </button>
                            <h4 class="custom-modal-title">Upload IMG <span id="madon"></span></h4>
                            <div class="custom-modal-text">
                               <div class="col-md-12 portlets">
                                <!-- Your awesome content goes here -->
                                <div class="m-b-30">
                                <span id="form_upload"></span>                                    
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                <!-- Form modal -->
                <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Sửa mã hàng <span id="madon"></span></h4>
                                                </div>
                                                <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="userName">SKUS<span class="text-danger">*</span></label>
                                                            <input type="text" id="skum" parsley-trigger="change" required="" class="form-control" id="userName" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="emailAddress">Tên sản phẩm<span class="text-danger">*</span></label>
                                                            <input type="text" id="namem" parsley-trigger="change" required="" placeholder="Enter Tên sản phẩm" class="form-control" disabled>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="pass1">Giá bán<span class="text-danger">*</span></label>
                                                            <input id="pricem" type="number" placeholder="Giá thành" required="" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="passWord2">Tồn Kho <span class="text-danger">*</span></label>
                                                            <input id="inventorym" type="number" required="" placeholder="Tồn Kho" class="form-control">
                                                        </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                                                     <button id="nhapkhom" class="btn btn-primary waves-effect waves-light" type="submit">
                                                                Duyệt
                                                            </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <!-- /.accordion-modal -->
<div id="accordion-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <div class="modal-dialog">
                                            <div class="modal-content p-0">
                                                <div id="accordion" role="tablist" aria-multiselectable="true">
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingOne">
                                                            <h5 class="mb-0 mt-0">
                                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    Thông tin sản phẩm
                                                                </a>
                                                            </h5>
                                                        </div>

                                                        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
                                                            <div class="card-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingTwo">
                                                            <h5 class="mb-0 mt-0">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                    Hình Ảnh
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
                                                            <div class="card-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header" role="tab" id="headingThree">
                                                            <h5 class="mb-0 mt-0">
                                                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                                    Lịch sử bán hàng
                                                                </a>
                                                            </h5>
                                                        </div>
                                                        <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
                                                            <div class="card-body">
                                                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->


<script>
    var resizefunc = [];
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#nhapkho').click(function(){
    var sku = document.getElementById('sku').value;
    var name = document.getElementById('name').value;
    var price = document.getElementById('price').value;
    var inventory = document.getElementById('inventory').value;
    if (sku.length < 3) {
        alert('SKU phải lớn hơn 3 kí tự');
        return;    
    }
    if (name.length < 3) {
        alert('Name phải lớn hơn 3 kí tự');
        return;    
    }
    if (price < 0) {
        alert('Giá sản phẩm không đúng');
        return;    
    }
    if (inventory < 0) {
        alert('Tồn kho không hợp lệ');
        return;    
    }
 
        $.ajax({type: "GET",
            url: "http://sys.dongphuchaianh.vn:8888/laz/server/product/add_item.php?action=add&sku=" + sku + "&name=" + name + "&price=" + price + "&inventory=" + inventory,
            contentType: "json",
             success: function(data){
                json = JSON.parse(data);
                alert(json.mess);
                location.reload();
            },
             error: function (error) {
                alert('error; ' + eval(error));
            }
 
        });
    });
 
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
    $('#nhapkhom').click(function(){
    var sku = document.getElementById('skum').value;
    var name = document.getElementById('namem').value;
    var price = document.getElementById('pricem').value;
    var inventory = document.getElementById('inventorym').value;
    if (sku.length < 3) {
        alert('SKU phải lớn hơn 3 kí tự');
        return;    
    }
    if (name.length < 3) {
        alert('Name phải lớn hơn 3 kí tự');
        return;    
    }
    if (price < 0) {
        alert('Giá sản phẩm không đúng');
        return;    
    }
    if (inventory < 0) {
        alert('Tồn kho không hợp lệ');
        return;    
    }
 
        $.ajax({type: "GET",
            url: "http://sys.dongphuchaianh.vn:8888/laz/server/product/add_item.php?action=update&sku=" + sku + "&name=" + name + "&price=" + price + "&inventory=" + inventory,
            contentType: "json",
             success: function(data){
                json = JSON.parse(data);
                alert(json.mess);
                location.reload();
            },
             error: function (error) {
                alert('error; ' + eval(error));
            }
 
        });
    });
 
});
</script>
<script type="text/javascript">
    $(document).on("click", "#modaldata", function () {
     var Id = $(this).data('id'); 
     $(".custom-modal-title #madon").html( Id );
     var formAction = $('#upload_img').attr('action');
     $('#upload_img').attr('action', formAction + Id);
     $(".custom-modal-text #form_upload").html('<form action="http://sys.dongphuchaianh.vn:8888/laz/client/upload.php?product=' + Id + '" id="upload_img" class="dropzone"><div class="fallback"></div></form>');
});
</script>

<script type="text/javascript">
    $(document).on("click", "#modaledit", function () {
     var sku = $(this).data('todo').sku;
     var name = $(this).data('todo').name;
     var price = $(this).data('todo').price;
     var inventory = $(this).data('todo').inventory;
     $(".modal-title #madon").html( sku );
     $(".form-group #skum").val( sku );
     $(".form-group #namem").val( name );
     $(".form-group #pricem").val( price );
     $(".form-group #inventorym").val( inventory );
});
</script>

<script type="text/javascript">
    $(document).on("click", ".close", function () {
        setTimeout(function(){ 
            location.reload();
        }, 1000);
     //location.reload();
});
</script>