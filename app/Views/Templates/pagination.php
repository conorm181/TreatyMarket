
<div class="d-flex justify-content-end" style="margin : 0 50%;">
<?php if($type == ""):if ($pager) :?>
  <?php $lh = substr(base_url(),-(count(str_split(base_url())))+17)."/BrowseProducts" ; //  http://localhost/    http://localhost/Repos/TreatyMarket/public  ?>
        <?php $pagi_path= $lh;?>
        <?php $pager->setPath($pagi_path); ?>
        <?= $pager->links();?>
        <?php endif; endif?>
      </div>