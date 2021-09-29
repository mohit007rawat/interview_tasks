<?php include('include/header.php');?>
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
                        <div class="card-title">Edit Form</div>
                        <hr>
                        <form method="post" enctype="multipart/form-data"  action="<?=base_url('admin/edit_product/').$this->uri->segment('3')?>"> 
                       
                         <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" value="<?=$users->name?>" name="name">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Description</label>
                                <div class="col-sm-3">
                                    <textarea class="form-control form-control-square"  name="description"><?=$users->description?></textarea>
                                    <?=form_error('description')?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Country</label>
                                <div class="col-sm-3">
                                    <select name="country" id="country" class="form-control form-control-square">
                                        <option value="">Select Country</option>
                                        <?php
                                          foreach ($country->data as $key => $value) 
                                          {
                                            // echo "<option value=".$value->name." data-currency=".$value->currency." >".$value->name."</option>";
                                            echo '<option '.($value->name == $users->country ? 'selected':'').' value="'.$value->name.'" data-currency="'.$value->currency.'" >'.$value->name.'</option>';
                                          }
                                        ?>
                                      </select>
                                    <?=form_error('country')?>
                                </div>
                            </div>
                             <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Product Name</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control form-control-square" readonly value="<?=$users->currency?>" id="currency" name="currency">
                                    <?=form_error('name')?>
                                </div>
                            </div>
                             </div>
                          <div class="form-group row">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-3">
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
 
<?php include('include/footer.php')?>
<script>

   $(document).ready(function(){
    $("#country").change(function(){
        var element = $(this).find('option:selected');
        var myTag = element.attr("data-currency");
        $('#currency').val(myTag);
    });
});
</script>