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
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i>Product List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Product Qty.</th>                                        
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($selected_product as $key) { ?>
                                    <tr data-id="<?=$key->id?>">
                                        <td><?=$i++?></td>
                                        <td><?=ucfirst($key->name)?></td>
                                        <td><?=$key->price.'Rs.'?></td>
                                        <td><?=$key->qty?></td>                                        
                                        <td>
                                            <a class="btn-sm btn-info" href="<?=base_url('admin/view_product_images/').base64_encode($key->id)?>">View Image</a>
                                             <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('admin/productstatus/').base64_encode($key->id).'/'.$this->uri->segment('3')?>" class="btn-sm btn-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('admin/productstatus/').base64_encode($key->id).'/'.$this->uri->segment('3')?>" class="btn-sm btn-danger">Inactive</a>
                                            <?php } ?>
                                            <!-- <a class="btn-sm btn-primary" href="<?=base_url('admin/action_product_request/'.base64_encode('1').'/').base64_encode($key->id)?>"><i class="fa fa-check"></i></a>
                                            <a class="btn-sm btn-danger" href="<?=base_url('admin/action_product_request/'.base64_encode('2').'/').base64_encode($key->id)?>"><i class="fa fa-times"></i></a> -->
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