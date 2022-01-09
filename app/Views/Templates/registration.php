
<form action="Register" method="post" style="width:40%;margin:3em auto">
<h3>Registration</h3>
    <div class="form-group">
      <label for="cn">Customer Name</label>
      <input type="text" name="customerName" class="form-control" id="cn">
    </div>
    <div class="form-row">
<div class="form-group col-md-6">
      <label for="fn">First Name</label>
      <input type="text" name="contactFirstName" class="form-control" id="fn">
    </div>
    <div class="form-group col-md-6">
      <label for="ln">Last Name</label>
      <input type="text" name="contactLastName" class="form-control" id="ln">
    </div>
</div>

  <div class="form-group">
    <label for="phone">Phone</label>
    <input type="text" name="phone" class="form-control" id="phone">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" class="form-control" id="email">
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="pw1">Password</label>
    <input type="text" name="password" class="form-control" id="pw1">
  </div>
  <div class="form-group col-md-6">
    <label for="pw2">Confirm Password</label>
    <input type="text" name="password_confirm" class="form-control" id="pw2">
  </div>
  </div>

  <div class="form-row">
  <div class="form-group col-md-6">
    <label for="a1">Address Line 1</label>
    <input type="text" name="addressLine1" class="form-control" id="a1">
  </div>
  <div class="form-group col-md-6">
    <label for="a2">Address Line 2</label>
    <input type="text" name="addressLine2" class="form-control" id="a2">
  </div>
  <div class="form-row">
  </div>
    <div class="form-group col-md-4">
      <label for="city">City</label>
      <input type="text" name="city" class="form-control" id="city">
    </div>
    <div class="form-group col-md-3">
      <label for="country">Country</label>
      <input type="text" name="country" class="form-control" id="country">
    </div>
    <div class="form-group col-md-3">
      <label for="postal">Postal Code</label>
      <input type="text" name="postalCode" class="form-control" id="postal">
    </div>
    <div class="form-group col-md-2">
      <label for="cl">Credit Limit</label>
      <input type="number" name="creditLimit" class="form-control" id="cl">
    </div>
  </div>
  <?php if(isset($validation)): ?>
    <div class ="col-12">
        <div class="alert alert-danger" role ="alert">
            <?= $validation->listErrors() ?>
        </div>
    </div>
   <?php endif; ?>
  
  <button type="submit" class="btn btn-primary" style="margin-right:3em">Submit</button>
        <a href="/">Already have an account?</a>
</form>