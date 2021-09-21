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
                    <a href="<?=base_url('restaurant/product')?>" class="btn btn-outline-primary waves-effect waves-light">Item List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Product</div>
                        <hr>
                        <form method="post" action="<?=base_url('restaurant/edit_item/').$this->uri->segment('3')?>"> 
                        <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-square"  name="cat_name" id="cat_name">
                                        <option value="">Select Category</option>
                                        <?php                                        
                                        foreach($category as $v)
                                        {
                                        ?>
                                            <option value="<?=$v->id?>" <?=$products->cat_id == $v->id ? 'selected' : ''?>><?=ucfirst($v->name)?></option>
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
                                                <option value="<?=$v->id?>" <?=$products->subcat_id == $v->id ? 'selected' : ''?>><?=ucfirst($v->name)?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>                                 
                                    </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?=$products->name?>" placeholder="Enter item Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Price</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="price" value="<?=$products->price?>" placeholder="Enter item Price">
                                    <?=form_error('price')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Item Descriptions</label>
                                <div class="col-sm-3">
                                    <textarea class="form-control form-control-square" name="item_description"><?=set_value('item_description')?><?=$products->item_description?></textarea>
                                    <?=form_error('item_description')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Other Details</label>
                                <div class="col-sm-3">
                                    <textarea class="form-control form-control-square" name="other_details"><?=set_value('name')?><?=$products->other_details?></textarea>
                                    <?=form_error('other_details')?>
                                </div>
                            </div>
                                                    
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
                                    <button type="submit"
                                        class="btn btn-primary shadow-primary btn-square">
                                        Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
 
<?php include('include/footer.php')?>
<script>
        $(document).ready(function(){
            $('#cat_name').on('change',function(){

                var cat_name = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_name',cat_name);

                $.ajax({
                    url : "<?=base_url('vender/restaurant/get_subcat')?>",
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
    </script>