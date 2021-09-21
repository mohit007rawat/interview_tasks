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
                <div class="btn-group float-sm-right">
                    <a href="<?=base_url('product')?>" class="btn btn-outline-primary waves-effect waves-light">Product List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Product Details</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/edit_product/').$this->uri->segment('2')?>" id="all_mall" enctype="multipart/form-data"> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-square"  name="cat_name" id="cat_name">
                                        <option value="">Select Category</option>
                                        <?php                                   
                                        foreach(@$category as $v)
                                        {
                                        ?>
                                            <option value="<?=$v->id?>" <?= ($v->id == $product->cat_id) ? 'selected' : '' ?>><?=ucfirst($v->name)?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <?=form_error('cat_name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Sub-Category </label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="subcat_name" id="subcat_name">
                                            <option value="">Select Sub-Category</option>
                                             <?php                                   
                                        foreach($sub_category as $v)
                                        {
                                        ?>
                                            <option value="<?=$v->id?>" <?= ($v->id == $product->subcat_id) ? 'selected' : '' ?>><?=ucfirst($v->name)?></option>
                                        <?php
                                        }
                                        ?>
                                        </select>      
                                    <?=form_error('subcat_name')?>

                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Name</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?=@$product->name?>" placeholder="Enter item Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Model Number</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="model_no" value="<?=@$product->model_no?>" placeholder="Model Number">
                                    <?=form_error('model_no')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">SKU Number</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-square" name="sku_no" value="<?=@$product->sku_no?>" placeholder="SKU Number">
                                    <?=form_error('sku_no')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-square" name="price" value="<?=@$product->price?>" placeholder="Enter Product Price">
                                    <?=form_error('price')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Discount Price</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-square" name="dis_price" value="<?=@$product->dis_price?>" placeholder="Enter Product Discount Price">
                                    <?=form_error('dis_price')?>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Image</label>
                                <div class="col-sm-8">
                                    <input type="file" class="form-control form-control-square" name="item_image[]" multiple>
                                    <?=form_error('item_image')?>
                                </div>
                            </div> -->
                             <!-- <div class="form-group row multi_color">
                                <label class="col-sm-2 col-form-label">Product Color</label>
                                <?php 
                                        $listing = explode(',',$product->product_color);
                                        $count = 5-count($listing);
                                       
                                        foreach ($listing as  $key => $value) {
                                ?>
                                         <div class="col-sm-2">
                                    <input type="text" value="<?=ucfirst($value)?>" class="form-control form-control-square" placeholder="Color Name" name="product_color[]">
                                    <?=form_error('product_color')?>
                                </div>
                                <?php
                                        }
                                ?>
                               
                            </div> -->
                            <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Product's Color :</label>
                        <div class="col-sm-5">
                            <select name="product_color[]" multiple="multiple" class="js-example-basic-multiple form-control form-control-square">
                                <option value="">Select Color's</option>
                                 <?php
                                $listing = explode(',',$product->product_color);
                        foreach($product_color as $k=>$v)
                        {
                        ?> 
                             <option value="<?=$v->name?>" <?=in_array($v->name, $listing) ? 'selected' : ''?>><?=$v->name?></option>
                        <?php                           
                        }                        
                        ?>
                            </select>
                             <?=form_error('product_color[]')?>
                        </div>                   
                    </div>  
                          <!--   <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>                             
                                <div class="col-sm-3">
                                    <p><button id="Array_name" class="add_fields btn btn-outline-dark">Add More Color</button></p>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Quantity</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control form-control-square" value="<?=@$product->qty?>" placeholder="Enter Product Quantity" name="qty">
                                    <?=form_error('qty')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Filter by Features</label>
                                <div class="col-sm-8">
                                    <select class="form-control form-control-square" name="filter_by_features" >
                                        <option value="">Select If Required*</option>

                                        <option value="wireless" 
                                        <?=($product->filter_by_features == 'wireless') ? 'selected' : '' ?>>Wireless
                                        </option>

                                        <option value="wired" 
                                        <?=($product->filter_by_features == 'wired') ? 'selected' : '' ?>>Wired
                                        </option>

                                        <option value="bluetooth_wireless" 
                                        <?=($product->filter_by_features == 'bluetooth_wireless') ? 'selected' : '' ?>>Bluetooth- Wireless
                                        </option>

                                        <option value="truly_wireless" 
                                        <?=($product->filter_by_features == 'truly_wireless') ? 'selected' : '' ?>>Truly Wireless
                                        </option>
                                    </select>
                                    <?=form_error('filter_by_features')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="short_desc"><?=set_value('short_desc')?><?=@$product->short_desc?></textarea>
                                    <?=form_error('short_desc')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Features</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="item_description"><?=@$product->item_description?></textarea>
                                    <?=form_error('item_description')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Listing Category</label>
                                <div class="col-sm-5">
                                    <select class="form-control form-control-square" name="pro_listing_category" >
                                        <?php $listing = explode(',',$product->listing);?>
                                        <option value="">Select If Required*</option>
                                        <option value="1" <?=in_array("1", $listing)?'selected':''?>>Deal of the Day</option>
                                        <option value="2" <?=in_array("2", $listing)?'selected':''?>>New Products</option>
                                        <option value="3" <?=in_array("3", $listing)?'selected':''?>>Featured Products</option>
                                        <option value="4" <?=in_array("4", $listing)?'selected':''?>>Best Seller</option>
                                    </select>
                                    <?=form_error('pro_listing_category')?>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Deal of the Day -- Large</label>
                                 <div class="col-sm-5">
                                    <select class="form-control form-control-square" name="large" >
                                        <option value="">Select</option>
                                        <option value="1"  <?=($product->large == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0"  <?= ($product->large == 0) ? 'selected' : '' ?>>Deactive</option>
                                    </select>
                                    <?=form_error('large')?>
                                </div>
                            </div>       
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Cash On Delivery</label>
                                <div class="col-sm-5">
                                    <select class="form-control form-control-square" name="cod_status" >
                                        <option value="">Select</option>
                                        <option value="1"  <?=($product->cod == 1) ? 'selected' : '' ?>>Available</option>
                                        <option value="0"  <?= ($product->cod == 0) ? 'selected' : '' ?>>Not Available</option>
                                    </select>
                                    <?=form_error('cod_status')?>
                                </div>
                            </div>  
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Warrenty Extend</label>
                                <div class="col-sm-5">
                                    <select class="form-control form-control-square" name="warrenty_ext" >
                                        <option value="">Select</option>
                                        <option value="1"  <?=($product->warrenty_ext == 1) ? 'selected' : '' ?>>Available</option>
                                        <option value="0"  <?= ($product->warrenty_ext == 0) ? 'selected' : '' ?>>Not Available</option>
                                    </select>
                                    <?=form_error('warrenty_ext')?>
                                </div>
                            </div>    
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Warrenty Extend Price</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-square" name="warrenty_ext_price" value="<?=$product->warrenty_ext_price?>" placeholder="If Warrenty Extend Available*">
                                    <?=form_error('warrenty_ext_price')?>
                                </div>
                            </div>  
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-square" name="url" value="<?=$product->url?>" placeholder="URL">
                                    <?=form_error('url')?>
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
            CKEDITOR.replace( 'item_description' );
            $('#cat_name').on('change',function(){

                var cat_name = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_name',cat_name);

                $.ajax({
                    url : "<?=base_url('admin/get_subcat')?>",
                    method : "POST",
                    dataType : 'json',
                    data : fd,
                    processData: false,
                    contentType: false,
                    success : function(status){
                        
                        $("#subcat_name option:not(:first-child)").remove();
                        status.data.forEach(item => {
                            $("#subcat_name").append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    }
                });
            });
        });



//Add Input Fields
$(document).ready(function() {
    var max_fields = "<?=$count?>"; //Maximum allowed input fields 
    var wrapper    = $(".multi_color"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
    var x = 1; //Initial input field is set to 1

//- Using an anonymous function:
//document.getElementById("Array_name").onclick = function () { alert('hello!'); };
  
 //When user click on add input button
 $(add_button).click(function(e){
        e.preventDefault();
 //Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
 //add input    
            $(wrapper).append('<div class="col-sm-2"><input class="form-control form-control-square" placeholder="Color Name" type="text" name="product_color[]" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
 
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
 $(this).parent('div').remove(); //remove inout field
 x--; //inout field decrement
    })
});
    </script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('.js-example-basic-multiple').select2({
    placeholder: "Select Product Colors",
    allowClear: true
});
});
</script>