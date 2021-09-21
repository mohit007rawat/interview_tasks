<?php include('include/header.php')?>
<div class="clearfix"></div>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumb-->
        <div class="row pt-2 pb-2">
            <div class="col-sm-9">
            <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
            <div class="col-sm-3">
            
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Manage Specification</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/manage_specification/').$this->uri->segment('2')?>"> 
                          
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Features</label>
                                 <div class="col-sm-10">
                                      <textarea name="product_features" rows='10' class="form-control"><?=set_value('product_features')?><?=@$specification->product_features?></textarea>
                                       <?=form_error('product_features')?>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Key Specs</label>
                                 <div class="col-sm-10">
                                      <textarea name="key_specs" rows='10' class="form-control"><?=set_value('key_specs')?><?=@$specification->key_specs?></textarea>
                                       <?=form_error('key_specs')?>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Warranty</label>
                                 <div class="col-sm-10">
                                      <textarea name="warranty" rows='10' class="form-control"><?=set_value('warranty')?><?=@$specification->warranty?></textarea>
                                       <?=form_error('warranty')?>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Performance</label>
                                 <div class="col-sm-10">
                                      <textarea name="performance" rows='10' class="form-control"><?=set_value('performance')?><?=@$specification->performance?></textarea>
                                       <?=form_error('performance')?>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Other</label>
                                 <div class="col-sm-10">
                                      <textarea name="other" rows='10' class="form-control"><?=set_value('other')?><?=@$specification->other?></textarea>
                                       <?=form_error('other')?>
                                 </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
</div>
    <?php include('include/footer.php')?>
    <script>
        $(document).ready(function(){
          CKEDITOR.replace( 'product_features' );
          CKEDITOR.replace( 'key_specs' );
          CKEDITOR.replace( 'warranty' );
          CKEDITOR.replace( 'performance' );
          CKEDITOR.replace( 'other' );
        });
    </script>