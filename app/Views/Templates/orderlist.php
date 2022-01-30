

    <div class="container">

        <h1 class="my-4">My Orders</h1>
        <?php  if(count($orders)>0){foreach ($orders as $order){?>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Order Placed On <?php echo $order->orderDate ?></h4>
                        <h6 class="text-muted card-subtitle mb-2"></h6>
                        <p class="card-text">Num</p>
                        <p class="card-text">Cost</p
                        <p class="card-text">Status</p>
                            <form action="<?php echo base_url();?>/ViewOrder/<?php echo $order->orderDate?>" method = "post" class="form-inline my-2 my-lg-0" style="margin: 1em 0">
                                <button class="btn btn-primary" type="button">View Order Details<br/></button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <?php  }}else{echo "<h3>No orders have been created yet...</h3>";}?>
    </div>

