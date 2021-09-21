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
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i>Affiliate Request List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>User Name</th>
                                        <th>Email</th>                                   
                                        <th>Mobile</th>                                   
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($select_request as $key) { ?>
                                    <tr data-id="<?=$key->id?>">
                                        <td><?=$i++?></td>
                                      
                                        <td><?=ucfirst($key->name)?></td>
                                        <td><?=$key->email?></td>
                                        <td><?=$key->mobile?></td>
                                      
                                        <td>
                                            <a class="btn-sm btn-primary" href="<?=base_url('action_affiliate_request/'.base64_encode('1').'/').base64_encode($key->id)?>"><i class="fa fa-check"></i></a>
                                            <a class="btn-sm btn-warning" href="<?=base_url('action_affiliate_request/'.base64_encode('2').'/').base64_encode($key->id)?>"><i class="fa fa-times"></i></a>
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