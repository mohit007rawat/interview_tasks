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
                        <div class="card-title">Add Category Details</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/addCategory')?>" id="" enctype="multipart/form-data"> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?=set_value('name')?>" placeholder="Category Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                           <!--  <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Title</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="title" value="<?=set_value('title')?>" placeholder="Category Title">
                                    <?=form_error('title')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Short Description</label>
                                <div class="col-sm-8">
                                    <textarea class="form-control form-control-square" name="cat_description" placeholder="Category Description"><?=set_value('cat_description')?></textarea>
                                    <?=form_error('description')?>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Navbar Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img" id='img'>
                                    <?=form_error('img')?>
                                </div>                                 
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="img_alt" value="<?=set_value('img_alt')?>" placeholder="Image alt">
                                    <?=form_error('img_alt')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Orange Thumb Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img2" id='img2'>
                                    <?=form_error('img2')?>
                                </div>                                 
                            </div> 
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thumb Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="thumb_img_alt" value="<?=set_value('thumb_img_alt')?>" placeholder="Thumb Image Alt Tag">
                                    <?=form_error('thumb_img_alt')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category White Thumb Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img3" id='img3'>
                                    <?=form_error('img3')?>
                                </div>                                 
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Thumb Image Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="thumb_img_alt2" value="<?=set_value('thumb_img_alt2')?>" placeholder="Thumb Image Alt Tag">
                                    <?=form_error('thumb_img_alt2')?>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Category Priority</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-square" name="priority" value="<?=set_value('priority')?>" placeholder="Category Priority">
                                    <?=form_error('priority')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="url" value="<?=set_value('url')?>" placeholder="URL">
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
      
 <script type="text/javascript">
    $(document).ready(function(){

     CKEDITOR.replace( 'cat_description' );
});
</script>