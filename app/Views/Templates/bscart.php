<div class="shopping-cart">
<div class="px-4 px-lg-0">

  <div class="pb-5">
    <div class="container">
      <div class="row">
        
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          
          <div class="table-responsive">
            <table class="table">
            <?php if(count($cart) != 0){?>
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($productarr as $cartItem){?>
                <!-- Start of Item -->
                <tr>
                  <th scope="row" class="border-0">
                    <div class="p-2">
                      <img src="<?php echo base_url(); ?>/Assets/Images/Products/thumbs/<?php echo $cartItem[0]->photo?>" alt="" width="70" class="img-fluid rounded shadow-sm">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> <a href="#" class="text-dark d-inline-block align-middle"><?php echo $cartItem[0]->description ?></a></h5><span class="text-muted font-weight-normal font-italic d-block">Provided by <?php echo $cartItem[0]->supplier?></span>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>€<?php echo number_format((float)$cartItem[0]->bulkSalePrice, 2, '.', '')?></strong></td>
                  <td class="border-0 align-middle"><strong><?php echo $cart[$cartItem[0]->produceCode]?></strong></td>
                  <td class="border-0 align-middle"><a href="<?php echo base_url() ?>/RemoveFromCart/<?php echo $cartItem[0]->produceCode?>" class="text-dark"><i class="fa fa-trash"></i></a></td>
                </tr>
                <!-- End of Item -->
                <?php }}else{echo "<h3> Cart is Empty!</h3>";}?>
                
               
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
        
      </div>
                
      <div class="row py-5 p-4 bg-white rounded shadow-sm">
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Coupon code</div>
          <div class="p-4">
            <p class="font-italic mb-4">If you have a coupon code, please enter it in the box below</p>
            <div class="input-group mb-4 border rounded-pill p-2">
              <input type="text" placeholder="Apply coupon" aria-describedby="button-addon3" class="form-control border-0">
              <div class="input-group-append border-0">
                <button id="button-addon3" type="button" class="btn btn-dark px-4 rounded-pill"><i class="fa fa-gift mr-2"></i>Apply coupon</button>
              </div>
            </div>
          </div>
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Instructions for seller</div>
          <div class="p-4">
            <p class="font-italic mb-4">If you have some information for the seller you can leave them in the box below</p>
            <textarea name="" cols="30" rows="2" class="form-control"></textarea>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order summary </div>
          <div class="p-4">
            <p class="font-italic mb-4">Shipping and additional costs are calculated based on values you have entered.</p>
            <ul class="list-unstyled mb-4">
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Order Subtotal </strong><strong>
                  <?php
                        $subtot = 0;
                        foreach ($productarr as $cartItem)
                        {
                            $subtot+=($cartItem[0]->bulkSalePrice*$cart[$cartItem[0]->produceCode]);
                        }
                        echo "€".number_format($subtot,2,'.','');
                  ?>
                </strong></li>
                
              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Shipping and handling</strong><strong>$10.00</strong></li>

              <li class="d-flex justify-content-between py-3 border-bottom"><strong class="text-muted">Total</strong>
              <h5 class="font-weight-bold">€<?php echo  number_format((float)$subtot+10, 2, '.', '')?></h5>

            </li>
            </ul><a href="<?php echo base_url(); ?>/Pay" class="btn btn-dark rounded-pill py-2 btn-block">Procceed to checkout</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
</div>