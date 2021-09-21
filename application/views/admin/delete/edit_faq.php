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
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Manage FAQ's</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/edit_faq/').$this->uri->segment('3')?>"> 
                        <div class="form-group row">
                                <label class="col-sm-1 col-form-label">Title</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control form-control-square" name="title" value="<?=$faq->title?>" placeholder="Title">
                                    <?=form_error('title')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label">Description</label>
                                 <div class="col-sm-5">
                                      <textarea name="description" rows='10' class="form-control"><?=set_value('description')?><?=@$faq->description?></textarea>
                                       <?=form_error('description')?>
                                 </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label"></label>
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
    <script>
        $(document).ready(function(){
            $('#cat_name').on('change',function(){

                var cat_name = $(this).val();
        	    var fd = new FormData();
                fd.append('cat_name',cat_name);

                $.ajax({
                    url : "<?=base_url('store/get_subcat')?>",
                    method : "POST",
                    dataType : 'json',
                    data : fd,
                    processData: false,
                    contentType: false,
                    success : function(status){
                        $("#subcat_name option:not(:first-child)").remove();
                        status.data.forEach(item => {
                            $("#subcat_name").append(`<option value="${item.id}">${item.name}</option>`);
                        })
                    }
                });
            });
        });
    </script>