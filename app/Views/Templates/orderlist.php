

    <div class="container">

        <h1 class="my-4">My Orders</h1>
        <?php  if(count($orders)>0){foreach ($orders as $order){?>
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">Order Placed On <?php echo $order->orderDate ?></h4>
                        <h6 class="text-muted card-subtitle mb-2"></h6>
                        <p class="card-text">Quantity on Order: <?php echo $order->orderCount ?></p>
                        <p class="card-text">Cost: €<?php echo round($order->priceTot,2) ?></p>
                        <p class="card-text">Status: <?php echo $order->status ?></p>
                            <form action="<?php echo base_url();?>/Order/<?php echo $order->orderNumber?>" method = "post" class="form-inline my-2 my-lg-0" style="margin: 1em 0">
                            <button class="btn btn-primary" type="submit">View Order Details<br/></button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
        <?php  }}else{echo "<h3>No orders have been created yet...</h3>";}?>
    </div>
