<div style="width: 70%; margin:2em auto">
<h2 style="text-align: center;"></h2>
<?php
//print_r($results);
    foreach($results as $product)
    {
        //print_r($product);
        echo "<h2>".$product->description."</h2>";
        ?>
        
        <img class="col-md-4" src="<?php echo base_url()?>/Assets/Images/products/full/<?php echo $product->photo?>">
        <?php
        echo "<p><em>Category:</em> ".$product->category."</?>";
        echo "<p><em>Supplied by</em> ".$product->supplier."</p>";
        echo "<p><em>Bulk Buy Price at </em> ".$product->bulkBuyPrice."</p>";
    }



?>
<div>