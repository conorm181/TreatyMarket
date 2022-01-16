
<form action = "" method="post" style="margin: 5% 20% 20em 20%">
        <h1>Login</h1>
        <?php if(session()->get('success')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('success') ?>
        </div>
        <?php endif ?>
        
        <?php if(session()->get('fail')): ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->get('fail') ?>
        </div>
        <?php endif ?>
  <div class="form-group">
    <label for="iemail">Email address</label>
    <input type="text" class="form-control" id="iemail" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="<?= set_value('email') ?>">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="ipassword">Password</label>
    <input type="text" class="form-control" id="ipassword" placeholder="Password" name="password" value="<?= set_value('password') ?>">
  </div>
 
  
        <button type="submit" class="btn btn-primary" style="margin: 1em">Submit</button>
        <a href="Register">Not Registered?</a>
</form>  