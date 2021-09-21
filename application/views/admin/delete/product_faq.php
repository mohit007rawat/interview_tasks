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
              <a href="<?=base_url('add_product_faq/').$this->uri->segment('2')?>" class="btn btn-outline-primary waves-effect waves-light">
                        Add Product FAQ</a>
            </div>
            
            </div>


        </div>
        <!-- End Breadcrumb-->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="background-color: #c8c9eebd;"><i class="fa fa-table"></i> FAQ's List</div>
                    <div class="card-body" style="background-color: #f8ffc63d;">
                        <div class="table-responsive">
                            <table id="default-datatable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sl No.</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>	                                                                        
                                        <th>Action</th>                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; foreach($product_faq as $key) { ?>
                                    <tr data-id="<?=$key->id?>">
                                        <td><?=$i++?></td>                                     
                                        <td><?=$key->title?></td>
                                        <td><?=substr($key->description, 0, 50);?>...</td>      
                                        <td>
                                 
                                            <?php if($key->status=='1'){ ?>
                                            <a href="<?=base_url('product_faq_status/').base64_encode($key->id).'/'.$this->uri->segment('2')?>" class="btn-sm btn-success">Active</a>
                                            <?php } else {?>
                                            <a href="<?=base_url('product_faq_status/').base64_encode($key->id).'/'.$this->uri->segment('2')?>" class="btn-sm btn-danger">Inactive</a>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <a class="btn-sm btn-success" href="<?=base_url('edit_product_faq/').base64_encode($key->id).'/'.$this->uri->segment('2')?>">Edit</a>
                                           
                                            <a class="btn-sm btn-danger" onclick="return confirm('Are you sure want to delete')" href="<?=base_url('delete_product_faq/').base64_encode($key->id).'/'.$this->uri->segment('2')?>">Delete</a>

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
#popular
{
    position: absolute;
left: 160px;
opacity: 1;
}
</style>

<script type="text/javascript">
      $(document).ready(function() {
       
        $("#popular").change(function() {
            var status = $(this).is(":checked");
            if(status == true)
            {
                var status = '1';
            }
            else
            {
                var status = '0';                
            }
                     
            var row_id = $(this).parents("tr").attr("data-id");
            var fd = new FormData();
            fd.append('is_popular',status);
            fd.append('row_id',row_id);

            $.ajax({
              url : "<?=base_url('admin/is_popular')?>",
              method : "POST",
              dataType : 'json',
              data : fd,
              processData: false,
              contentType: false,
              success : function(status){      
              if(status.status == true)
              {                
                  alert("Change Successfully");                
              }
              else
              {
                alert("Something Wrong Please Contact to Admin!!  ");
              }
              } 
            });
          
        });
      });   
    </script>