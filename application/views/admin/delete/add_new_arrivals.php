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
                        <div class="card-title">Add New Arrivals</div>
                        <hr>
                        <form method="post" action="<?=base_url('add_new_arrivals')?>" id="" enctype="multipart/form-data">
                            
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">New Arrivals</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control form-control-square" name="img" id='img'>
                                    <?=form_error('img')?>
                                </div>                                 
                            </div> 
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Alt Tag</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" name="alt" value="<?=set_value('alt')?>" placeholder="Alt Tag">
                                    <?=form_error('alt')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Url</label>
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
<!-- <script>
        $(document).ready(function(){
            $('#cat_type').on('change',function(){

                var cat_type = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_type',cat_type);

                $.ajax({
                    url : "<?=base_url('get_cat')?>",
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
    </script> -->
      
 