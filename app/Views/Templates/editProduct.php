<section>
    <h1 class="text-center text-capitalize"></h1>
    <div class="container">
         <form method="post" action="<?php echo base_url(); ?>/EditProduct/<?php echo $product[0]->produceCode ?>" id="application-form" enctype="multipart/form-data">
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <p><strong>Product Code</strong><span class="text-danger">*</span></p><input disabled value="<?php echo $product[0]->produceCode ?>" class="form-control" type="text" required name="code"/>
                    </div>
                    <div class="col">
                        <p><strong>Category</strong></p><input value="<?php echo $product[0]->category ?>" class="form-control" type="text" required name="category"/>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="col">
                        <p><strong>Description</strong><span class="text-danger">*</span></p><input value="<?php echo $product[0]->description ?>"class="form-control" type="text" required name="description" />
                    </div>
                </div>
            </div>
            <div class="form-group">
                <p><strong>Supplier </strong><span class="text-danger">*</span></p><input value="<?php echo $product[0]->supplier ?>"class="form-control" type="text" name="supplier" />
            </div>
            <div class="form-group">
                <p><strong>Bulk Buy Price </strong><span class="text-danger">*</span></p><input value="<?php echo $product[0]->bulkBuyPrice ?>"class="form-control" type="number" name="buy" />
            </div>
            <div class="form-group">
                <p><strong>Bulk Sale Price </strong><span class="text-danger">*</span></p><input value="<?php echo $product[0]->bulkSalePrice ?>"class="form-control" type="number" required name="sale" />
            </div>
            <div class="form-group">
                <div>
                    <p><strong>Your Picture </strong><span class="text-danger">*</span></p>
                    <div class="file">
                        <div class="input-group mb-3 px-2 py-2 rounded-pill bg-white shadow-sm "><input id="upload" class="form-control border-0" type="file" name="file"/><label id="upload-label" class="font-weight-light text-muted" for="upload">Choose file</label>
                            <div class="input-group-append"><label class="btn btn-light m-0 rounded-pill px-4" for="upload"><i class="fa fa-cloud-upload mr-2 text-muted"></i><small class="text-uppercase font-weight-bold text-muted">Choose file</small></label></div>
                        </div>
                        <!--
                        <p class="font-italic text-dark text-center">The image uploaded will be rendered inside the box below.</p>
                        <div class="image-area mt-4 text-dark"><img id="imageResult" class="img-fluid rounded shadow-sm mx-auto d-block" src="#" alt width="200" /></div>
                        <div class="col d-none">
                            <p><strong>URL</strong><span class="text-danger">*</span></p><input id="urllink" class="form-control" name="url" type="url" readonly />
                        </div>
-->
                    </div>
                </div>
            </div>
            <div class="form-group justify-content-center d-flex">
                <div id="submit-btn">
                    <div class="form-row"><button class="btn btn-primary btn-light m-0 rounded-pill px-4" type="submit" style="min-width: 500px;"  target="hidden_iframe">Submit</button></div>
                </div>
            </div>
        </form>
    </div>
    <div class="col">
        <h3 id="fail" class="text-center text-danger d-none"><br />Form not Submitted <a href="contact.html">Try Again</a><br /><br /></h3>
        <h3 id="success-1" class="text-center text-success d-none"><br />Form Submitted Successfully <a href="contact.html">Send Another Response</a><br /><br /></h3>
    </div>
</section>