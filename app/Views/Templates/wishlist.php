<div class="shopping-cart">
<div class="px-4 px-lg-0">

  <div class="pb-5">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">

          <!-- Shopping cart table -->
          <?php if(count($wishlist) != 0){?>
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Product</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Price</div>
                  </th>
                  <!--
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Quantity</div>
                  </th>
          -->
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Remove</div>
                  </th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($wishlist as $cartItem){?>
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
                  <td class="border-0 align-middle"><a href="<?php echo base_url() ?>/RemoveFromWishlist/<?php echo $cartItem[0]->produceCode?>" class="text-dark"><i class="fa fa-trash"></i></a></td>
                </tr>
                <!-- End of Item -->
                <?php }}else{echo "<h3> Wishlist is Empty!</h3>";}?>
                
               
              </tbody>
            </table>
          </div>
          <!-- End -->
        </div>
      </div>
