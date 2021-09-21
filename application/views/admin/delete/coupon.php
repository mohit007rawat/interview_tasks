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
                    <a href="<?=base_url('admin/addCoupon')?>" class="btn btn-outline-primary waves-effect waves-light">
                        Add Coupon</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i> Coupon List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Name</th>
                                        <th>Minimum Cart Value</th>
                                        <th>Price</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($coupon as $key) { ?>
                                    <tr data-id="<?=$key->id?>">
                                        <td><?=$i++?></td>
                                        <td><?=$key->title?></td>
                                        <td><?=$key->name?></td>
                                        <td><?=$key->mini_cart_val?></td>
                                        <td><?=$key->price?></td>
                                        <td><?=$key->start_date?></td>                                     
                                        <td><?=$key->end_date?></td>                                                                           
                                        <td>
                                            <!-- <a href="<?=base_url('admin/editcoupon/').base64_encode($key->id)?>" class="btn-sm btn-success">Edit</a> -->
                                            <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('admin/couponstatus/').base64_encode($key->id)?>" class="btn-sm btn-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('admin/couponstatus/').base64_encode($key->id)?>" class="btn-sm btn-danger">In-active</a>
                                            <?php } ?>
                                            <a onclick="return confirm('Are you sure want to delete')" href="<?=base_url('admin/deletecoupon/').base64_encode($key->id)?>" class="btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- End Row-->

    </div>
    <!-- End container-fluid-->
    <?php include('include/footer.php')?>
<style> 
    .btn.btn-info.disablebu {
    pointer-events: none;
    cursor: default !important;
    background-color: #828080c2;
border: none;
}
</style>