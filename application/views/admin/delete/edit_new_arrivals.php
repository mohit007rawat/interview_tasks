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
                    <a href="<?=base_url('new_arrivals')?>" class="btn btn-outline-primary waves-effect waves-light">New Arrivals List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Edit New Arrivals</div>
                        <hr>
                        <form method="post" action="<?=base_url('edit_new_arrivals/').$this->uri->segment('2')?>" id="" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">New Arrivals Image</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img" id='img'>
                                    <?=form_error('img')?>
                                </div>
                                <?php
                                    if(!empty($new_arrivals->image))
                                    {
                                ?>
                                <div class="col-sm-3">
                                    <img width="140px" height="120px" src="<?=base_url('assets/new_arrivals_img/').$new_arrivals->image?>">
                                </div>    
                                <?php
                                    }
                                ?>
                                                          
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="alt" value="<?=$new_arrivals->alt?>" placeholder="Alt Tag">
                                    <?=form_error('alt')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">URL</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="url" value="<?=$new_arrivals->url?>" placeholder="URL">
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

    <script>
        $(document).ready(function(){
            $('#cat_type').on('change',function(){

                var cat_type = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_type',cat_type);

                $.ajax({
                    url : "<?=base_url('admin/get_cat')?>",
                    method : "POST",
                    dataType : 'json',
                    data : fd,
                    processData: false,
                    contentType: false,
                    success : function(status){
                        $("#cat_name option:not(:first-child)").remove();
                        status.data.forEach(item => {
                            $("#cat_name").append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    }
                });
            });
        });
    </script>