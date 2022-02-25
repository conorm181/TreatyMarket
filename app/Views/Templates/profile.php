

<form action="<?php echo base_url()?>/Profile" method="post" style="width:40%;margin:3em auto">
<?php if(isset($_SESSION["Edit"])&& $_SESSION["Edit"]=='Failed to Edit Profile'){
    echo "<div class=\"alert alert-danger\" role=\"alert\">Failed to Edit Profile</div>";
}else if(isset($_SESSION["Edit"])&& $_SESSION["Edit"]=='Profile Edit Successful')
{
    echo "<div class=\"alert alert-success\" role=\"alert\">Profile Edit Successful</div>";
}?>
<h3>Profile</h3>
    <div class="form-group">
      <label for="cn">Customer Name</label>
      <input type="text" required value="<?php echo $user[0]->customerName ?>" name="customerName" class="form-control" id="cn">
    </div>
    <div class="form-row">
<div class="form-group col-md-6">
      <label for="fn">First Name</label>
      <input type="text" required name="contactFirstName" value="<?php echo $user[0]->contactFirstName ?>"class="form-control" id="fn">
    </div>
    <div class="form-group col-md-6">
      <label for="ln">Last Name</label>
      <input type="text" required name="contactLastName" value="<?php echo $user[0]->contactLastName ?>"class="form-control" id="ln">
    </div>
</div>

  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" required name="phone" value="<?php echo $user[0]->phone ?>"class="form-control" id="phone">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" required name="email" disabled value="<?php echo $user[0]->email ?>"class="form-control" id="email">
  </div>

  <div class="form-row">
  <div class="form-group col-md-12">
    <label for="pw1">Password</label>
    <input type="text" name="password" class="form-control" id="pw1">
    <small id="passwordHelpBlock" class="form-text text-muted">
  New Password? Type it in!
</small>
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="a1">Address Line 1</label>
    <input type="text" required name="addressLine1" value="<?php echo $user[0]->addressLine1 ?>"class="form-control" id="a1">
  </div>
  <div class="form-group col-md-6">
    <label for="a2">Address Line 2</label>
    <input type="text" required name="addressLine2" value="<?php echo $user[0]->addressLine2 ?>"class="form-control" id="a2">
  </div>
  <div class="form-row">
  </div>
    <div class="form-group col-md-4">
      <label for="city">City</label>
      <input type="text" required name="city" value="<?php echo $user[0]->city ?>"class="form-control" id="city">
    </div>
    <div class="form-group col-md-3">
      <label for="country">Country</label>
      <input type="text" required name="country" value="<?php echo $user[0]->country ?>"class="form-control" id="country">
    </div>
    <div class="form-group col-md-3">
      <label for="postal">Postal Code</label>
      <input type="text" required name="postalCode" value="<?php echo $user[0]->postalCode ?>"class="form-control" id="postal">
    </div>
    <div class="form-group col-md-2">
      <label for="cl">Credit Limit</label>
      <input type="number" required name="creditLimit" value="<?php echo $user[0]->creditLimit ?>"class="form-control" id="cl">
    </div>
    
  </div>
  <div class="form-group justify-content-center d-flex">
                <div id="submit-btn">
                    <div class="form-row"><button class="btn btn-primary btn-light m-0 rounded-pill px-4" type="submit" style="min-width: 500px; background-color:lightblue"  target="hidden_iframe">Submit</button></div>
                </div>
            </div>
</form>
