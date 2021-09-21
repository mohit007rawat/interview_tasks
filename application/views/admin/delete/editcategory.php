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
                    <a href="<?=base_url('category')?>" class="btn btn-outline-primary waves-effect waves-light">Category List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit Category Name</div>
                        <hr>
                        <form method="post" action="<?=base_url('edit_category/').$this->uri->segment('2')?>" id="" enctype="multipart/form-data">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?=!empty($category_details) ? $category_details->name : set_value('name')?>" placeholder="Category Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="title" value="<?=$category_details->title?>" placeholder="Category Title">
                                    <?=form_error('title')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Short Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="cat_description" placeholder="Category Description"><?=$category_details->short_desc?></textarea>
                                    <?=form_error('description')?>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Navbar Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img" id='img'>
                                    <?=form_error('img')?>
                                </div> 
                                <div class="col-sm-3">
                                    <img width="140px" height="120px" src="<?=base_url('assets/category_img/').$category_details->img?>">
                                </div>                                
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="img_alt" value="<?=!empty($category_details) ? $category_details->img_alt : set_value('img_alt')?>" placeholder="Image alt">
                                    <?=form_error('img_alt')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Orange Thumb Image </label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img2" id='img2'>
                                    <?=form_error('img2')?>
                                </div> 
                                <div class="col-sm-3">
                                    <img width="140px" height="120px" src="<?=base_url('assets/category_img/').$category_details->thumb_img?>">
                                </div>                                
                            </div> 
                            
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thumb Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="thumb_img_alt" value="<?=!empty($category_details) ? $category_details->thumb_img_alt : set_value('thumb_img_alt')?>" placeholder="Thumb Image Alt Tag">
                                    <?=form_error('thumb_img_alt')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category White Thumb Image </label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img3" id='img3'>
                                    <?=form_error('img3')?>
                                </div> 
                                <div class="col-sm-3">
                                    <img width="140px" height="120px" src="<?=base_url('assets/category_img/').$category_details->thumb_img_2?>">
                                </div>                                
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thumb Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="thumb_img_alt2" value="<?=!empty($category_details) ? $category_details->thumb_img_alt2 : set_value('thumb_img_alt2')?>" placeholder="Thumb Image Alt Tag">
                                    <?=form_error('thumb_img_alt2')?>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Priority</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-square" name="priority" value="<?=$category_details->priority?>" placeholder="Category Priority">
                                    <?=form_error('priority')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="url" value="<?=$category_details->url?>" placeholder="URL">
                                    <?=form_error('url')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-1">
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
    <style>
.ch_type
{
    
    color: #6b6b6b;
    font-size: .75rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-weight: 600;
    margin-bottom: 10px;
    padding-left: 5px;
    margin-left: 12px;

}

#che_type
{
    
    left: -10px;
  
    top: 2px;

}
    </style>
    <?php include('include/footer.php')?>

