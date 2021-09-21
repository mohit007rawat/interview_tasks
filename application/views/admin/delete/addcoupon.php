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
                    <a href="<?=base_url('admin/coupan')?>" class="btn btn-outline-primary waves-effect waves-light">Coupon List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Coupon Details</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/addCoupon')?>" id="" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="title" value="<?=set_value('title')?>" placeholder="Title">
                                    <?=form_error('title')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Coupon Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="name" value="<?=set_value('name')?>" placeholder="Name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Minimum Cart Value</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="mini_cart_val" value="<?=set_value('mini_cart_val')?>" placeholder="Minimum Cart Value">
                                    <?=form_error('mini_cart_val')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Coupon Price</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="price" value="<?=set_value('price')?>" placeholder="Price">
                                    <?=form_error('price')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Start Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control form-control-square" name="start_date">
                                    <?=form_error('start_date')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">End Date</label>
                                <div class="col-sm-3">
                                    <input type="date" class="form-control form-control-square" name="end_date">
                                    <?=form_error('end_date')?>
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
      
 