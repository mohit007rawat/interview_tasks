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
                    <a href="<?=base_url('add_product_image/').$this->uri->segment('2')?>" class="btn btn-outline-primary waves-effect waves-light">
                        Add Images</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header"><i class="fa fa-table"></i>Product Image List</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Product Name</th>
                                        <th>Product Thumb Image</th>                                   
                                        <th>Status</th>										
										<th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach(@$image_collection as $key) {
                                    
                                     ?>
                                    <tr>

                                        <td><?=$i++?></td>
                                        <td><?=ucfirst($key->name)?></td>
                                        <td><img width='180px' height='120px' src='<?=base_url('assets/product_image/').$key->image?>'>                                           
                                        </td>
                                        <td>
                                            <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('admin/product_image_status/').$this->uri->segment('2')?>" class="badge badge-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('admin/product_image_status/').$this->uri->segment('2')?>" class="badge badge-danger">Inactive</a>
                                            <?php } ?>
                                        </td>
                                        
                                        <td>
                                            <a class="btn-sm btn-success" href="<?=base_url('update_product_video/').$this->uri->segment('2')?>">Update Video</a>
                                            <a class="btn-sm btn-success" href="<?=base_url('update_product_thumb_image/').$this->uri->segment('2')?>">Update Thumb Images</a>
                                            <a class="btn-sm btn-success" href="<?=base_url('update_product_gallery/').ltrim($key->img_color, '#').'/'.$this->uri->segment('2')?>">Update Galary Images</a>
                                            <a class="btn-sm btn-danger" onclick="return confirm('Are you sure want to delete')" href="<?=base_url('admin/delete_product_image/').$this->uri->segment('2')?>">Delete</a>

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