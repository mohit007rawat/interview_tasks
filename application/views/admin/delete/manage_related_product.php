<?php 
include('include/header.php');
 $related_productId = explode(',',$related_products);

?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">   
    <div class="row pt-2 pb-2">
    <div class="col-sm-12">
               <div class="col-sm-9">
                <?php if($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
            </div>
        </div>
    <!--<div class="row pt-2 pb-2">-->
    <!--        <div class="col-sm-9">-->
    <!--            <?php if($this->session->flashdata('message')) { ?>-->
    <!--            <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>-->
    <!--            <?php } ?>-->
    <!--        </div>-->
    <!--    </div>-->
        <div class="row">      
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">  
                        <form method="POST" action="<?=base_url('manage_related_product/').$this->uri->segment('2')?>" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Assign Product's :</label>
                        <div class="col-sm-4">
                            <select name="product[]" multiple="multiple" class="js-example-basic-multiple form-control form-control-square">
                                <option value="">Select Product's</option>
                                 <?php

                        foreach($related_product as $k=>$v)
                        {
                        ?> 
                             <option value="<?=$v->id?>" <?=in_array($v->id, $related_productId) ? 'selected' : ''?>><?=$v->name?></option>
                        <?php                           
                        }                        
                        ?>
                            </select>
                             <?=form_error('product[]')?>
                        </div>  
                        <div class="col-sm-1">
                            <button type="submit" name='submit' class="btn btn-primary shadow-primary btn-square">Submit</button>
                        </div>                   
                    </div>  
                        </form>                
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i> Product List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Description</th>            
                                        <th>Status</th>                                     
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($product as $key) { ?>
                                    <tr>
                                        <td><?=$i++?></td>
                                        <td><?=ucfirst($key->name)?></td>
                                        <td><?=$key->price?>Rs.</td>
                                        <td><?=$key->item_description?></td>                                      
                                        <td>
                                            <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('admin/product_status/').base64_encode($key->id)?>" class="badge badge-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('admin/product_status/').base64_encode($key->id)?>" class="badge badge-danger">Inactive</a>
                                            <?php } ?>
                                        </td>
                                        
                                        <td>  
                                            <a class="btn-sm btn-success" href="<?=base_url('manage_related_product/').base64_encode($key->id)?>">Related Products</a>
                                            <a class="btn-sm btn-success" href="<?=base_url('manage_product_images/').base64_encode($key->id)?>">Manage Product's Image</a>
                                            <a class="btn-sm btn-success" href="<?=base_url('edit_item/').base64_encode($key->id)?>">Edit</a>
                                            <a class="btn-sm btn-danger" onclick="return confirm('Are you sure want to delete')" href="<?=base_url('admin/delete_product/').base64_encode($key->id)?>">Delete</a>

                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!--End Row-->

    </div>
</div>
<?php include('include/footer.php')?>
<script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
    placeholder: "Select Related Products",
    allowClear: true
});
});
</script>