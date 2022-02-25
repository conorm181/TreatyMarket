<div class="container py-5">
    <div class="row">
        <div class="col-lg-7 mx-auto">
            <div class="bg-white rounded-lg shadow-sm p-5">
                <ul class="nav bg-light nav-pills rounded-pill nav-fill mb-3" role="tablist">
                    <li class="nav-item"><a class="nav-link active rounded-pill" data-toggle="pill" href="#nav-tab-card"><i class="fa fa-credit-card"></i>
                            Credit Card
                        </a></li>
                    <li class="nav-item"><a class="nav-link rounded-pill" data-toggle="pill" href="#nav-tab-paypal"><i class="fa fa-paypal"></i>
                            Paypal
                        </a></li>
                   
                </ul>
                <div class="tab-content">
                    <div id="nav-tab-card" class="tab-pane fade show active">

                        <form action="<?php echo base_url(); ?>/Checkout/<?php echo $oid?>" method="POST" role="form">
                            <div class="form-group"><label for="username">Full name (on the card)</label><input class="form-control" type="text" name="username" placeholder="Jeff Doe" required /></div>
                            <div class="form-group"><label for="cardNumber">Card number</label>
                                <div class="input-group"><input class="form-control" type="text" name="cardNumber" placeholder="Your card number" required />
                                    <div class="input-group-append"><span class="input-group-text text-muted"><i class="fa fa-cc-visa mx-1"></i><i class="fa fa-cc-amex mx-1"></i><i class="fa fa-cc-mastercard mx-1"></i></span></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <div class="form-group"><label><span class="hidden-xs">Expiration</span></label>
                                        <div class="input-group"><input class="form-control" type="number" placeholder="MM" name="month" required /><input class="form-control" type="number" placeholder="YY" name="year" required /></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group mb-4"><label data-toggle="tooltip" title="Three-digits code on the back of your card">CVV
                                            <i class="fa fa-question-circle"></i></label><input class="form-control" type="text" name="cvv" required /></div>
                                </div>
                            </div><a href="<?php echo base_url();?>/Checkout/<?php echo $oid?>"><button class="subscribe btn btn-primary btn-block rounded-pill shadow-sm" type="submit"> Confirm </button></a>
                        </form>
                    </div>
                    <div id="nav-tab-paypal" class="tab-pane fade">
                        <p>Paypal is easiest way to pay online</p>
                        <p><button class="btn btn-primary rounded-pill" type="button"><i class="fa fa-paypal mr-2"></i> Log into my Paypal</button></p>
                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>