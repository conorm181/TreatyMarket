<div style="width: 70%; margin:2em auto">
<h2 style="text-align: center;">Our Products</h2>
<?php if(isset($_SESSION["Deletion"])&& $_SESSION["Deletion"]=='Failed to delete product'){
    echo "<div class=\"alert alert-danger\" role=\"alert\">Failed to Delete Product</div>";
}else if(isset($_SESSION["Deletion"])&& $_SESSION["Deletion"]=='Successful delete product')
{
    echo "<div class=\"alert alert-success\" role=\"alert\">Product Successfully deleted</div>";
}
if(isset($_SESSION["Insertion"])&& $_SESSION["Insertion"]=='Fail'){
    echo "<div class=\"alert alert-danger\" role=\"alert\">Failed to Insert Product</div>";
}else if(isset($_SESSION["Insertion"])&& $_SESSION["Insertion"]=='Success')
{
    echo "<div class=\"alert alert-success\" role=\"alert\">Product Successfully Added</div>";
}else if(isset($_SESSION["Edit"])&& $_SESSION["Edit"]=='Success')
{
    echo "<div class=\"alert alert-success\" role=\"alert\">Product Successfully Edited</div>";
}else if(isset($_SESSION["Edit"])&& $_SESSION["Edit"]=='Fail')
{
    echo "<div class=\"alert alert-danger\" role=\"alert\">Product Failed to be Edited</div>";
}
?>
<form action="<?php echo base_url();?>/BrowseProducts" method = "post" class="form-inline my-2 my-lg-0" style="margin:1em">
      <input name="search" class="form-control mr-sm-4" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <?php if($userType=="Admin"){ ?>
                <div class="buto" style="margin:0 0 0 1em;"><a href="<?php echo base_url();?>/AddProduct">Add New Product</a></div>
            <?php }?>
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
                <div class="buto"><a href="<?php echo base_url();?>/AddToWishlist/<?php echo $row['produceCode']?>">Add To WishList</a></div>
            <?php }?>
            <?php if($userType=="Admin"){ ?>
                <div class="buto"><a style="background-color:green;" href="<?php echo base_url();?>/EditProduct/<?php echo $row['produceCode']?>">Edit Product</a></div>
                <div class="buto"><a style="background-color:red" href="<?php echo base_url();?>/DeleteProduct/<?php echo $row['produceCode']?>">Delete Product</a></div>

            <?php }?>
            </div>
        </div>  
    

<?php if($counter%3==0&&$counter!=0){
        echo "</div><div class=\"card-group\">";
    }
    } ?>
</div>
</div>

    
