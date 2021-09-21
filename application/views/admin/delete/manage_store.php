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
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i> Stores List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Store Name</th>
                                        <th>Person Name</th>
                                        <th>Email Id</th>
                                        <th>Mobile Number</th>
                                        <th>Total Number of Orders</th>
                                        <th>Date of Joining</th>
                                        <th>View Order's Details</th>
                                        <th>View Product</th>
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($store as $key) { ?>
                                    <tr data-id="<?=$key->id?>">
                                        <td><?=$i++?></td>
                                        <td><?=ucfirst($key->store_name)?></td>
                                        <td><?=ucfirst($key->username).' '.ucfirst($key->l_name)?></td>
                                        <td><?=$key->email?></td>
                                        <td><?=$key->country_code.' '.$key->mobile?></td>                                     
                                        <td>0-Demo</td>                                        
                                        <td><?=date("d-m-Y",strtotime($key->created))?></td>                                        
                                        <td><a href="#">View Order's Details</a></td>                                        
                                        <td><a href="<?=base_url('admin/selected_product/').base64_encode($key->id)?>">View Product</a></td>                                        
                                        <td>
                                        <a class="btn-sm btn-info" href="<?=base_url('admin/view_details/').base64_encode($key->id)?>">More Details</a>
                                            <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('admin/storestatus/').base64_encode($key->id)?>" class="btn-sm btn-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('admin/storestatus/').base64_encode($key->id)?>" class="btn-sm btn-danger">Block</a>
                                            <?php } ?>
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