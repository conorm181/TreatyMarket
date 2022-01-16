<div class="CContainer">
<div class="Cart-Container">
<div class="Header">
<h3 class="Heading">Shopping Cart</h3>
<h5 class="Action">Remove all</h5>
</div>
    <div class="cart-Items" style="display:block">
    <?php if(count($cart) != 0){foreach ($productarr as $cartItem){?>
    <div class="cart-Item" style="display:block; width:100%">
    <h5 class="Action" style="width:3.5em">Remove</h5>
    <div class="image-box">
    <img src="<?php echo base_url(); ?>/Assets/Images/Products/full/<?php echo $cartItem[0]->photo ?>" style="height:120px"/>
    <!--<img src="<?php echo base_url(); ?>/Assets/Images/Products/full/brioche.jpg"/>-->
    </div>
    <div class="about"style="display:inline-block">
    <h1 class="title" style="margin:0.75em 0"><?php echo $cartItem[0]->description ?></h1>
    <h3 class="subtitle"><?php echo $cartItem[0]->supplier ?></h3>
    <h3 class="subtitle">€<?php echo number_format((float)$cartItem[0]->bulkSalePrice, 2, '.', '');?> * <?php echo $cart[$cartItem[0]->produceCode] ?> = €<?php echo number_format(($cartItem[0]->bulkSalePrice*$cart[$cartItem[0]->produceCode]), 2, '.', '') ?></h3>
    </div>
    <div class="counter"X></div>
    <div class="prices"X></div>
    </div>
    <?php }}else{echo "<h3> Cart is Empty</h3>";}?>
        

    </div>



</div>
</div>