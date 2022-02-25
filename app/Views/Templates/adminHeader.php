<nav class="navbar navbar-expand-lg navbar-light" style="background-color : #8BC45C; border: 1px solid #484538;">
  <a class="navbar-brand" href="<?php echo base_url();?>/Admin"><img src="<?php echo base_url('Assets/Images/site/logotiny.png'); ?>"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>/BrowseProducts">Browse Products<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url();?>/ManageOrders">Orders<span class="sr-only">(current)</span></a>
      </li>

      
      
    </ul>
    <div class="dropdown d-inline-block">
    <li style="list-style-type: none;" class="nav-item dropdown">
        <a class="nav-link fas fa-user-circle" style="font-family: FontAwesome; font-size:2em; margin-right: 3em; color: inherit;" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
        <div class="dropdown-menu w-100" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="<?php echo base_url();?>/CMember/Logout">Logout</a>
        </div>
      </li>
    </div>
  </div>
</nav>
