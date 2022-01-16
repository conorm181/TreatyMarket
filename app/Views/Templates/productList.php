<div style="width: 70%; margin:2em auto">
<h2 style="text-align: center;">Our Products</h2>
<form action="<?php echo base_url();?>/BrowseProducts" method = "post" class="form-inline my-2 my-lg-0" style="margin:1em">
      <input name="search" class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
<?php $counter = 0; 
echo "<div class=\"card-group\">";
 foreach ($results as $row){ 
    
    $counter++; 
    
    ?>
        <div class="card" style="margin: 1em;">
            <div class="card-body mx-auto" style="width: 100%">
            <a href="<?php echo base_url();?>/Product/<?php echo $row['produceCode']?>">
            <h5 class="card-title"><?php echo $row['description']; ?></h5>
            <img style="width:100%; margin:auto" src="Assets/Images/products/full/<?php echo $row['photo'] ?>">
            <p class="card-text"><small class="text-muted">Supplied by <?php echo $row['supplier'] ?></small></p>
            </a>
            <?php if($userType=="Customer"){ ?>
                <form action="<?php echo base_url();?>/AddToCart/<?php echo $row['produceCode']?>" method = "post" class="form-inline my-2 my-lg-0" style="margin:1em">
                    <input name="quantity" class="form-control mr-sm-1" style="width:6em" type="number">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Add To Cart</button>
                </form>
                <div class="buto"><a href="#">Add To WishList</a></div>
            <?php }?>
            </div>
        </div>  
    

<?php if($counter%3==0&&$counter!=0){
        echo "</div><div class=\"card-group\">";
    }
    } ?>
</div>
</div>

    
