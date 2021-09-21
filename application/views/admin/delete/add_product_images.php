<?php include('include/header.php'); include('include/ColorFound.php'); ?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">   
    <div class="row pt-2 pb-2">
    <div class="col-sm-12">
                <?php if($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger" id="msg"><?=$this->session->flashdata('error')?></div>
                <?php }
				else{
					?>
				<div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
					<?php
				} ?>
            </div>
        </div>
    <div class="row pt-2 pb-2">
            <div class="col-sm-9">
                <?php if($this->session->flashdata('message')) { ?>
                <div class="alert alert-success" id="msg"><?=$this->session->flashdata('message')?></div>
                <?php } ?>
            </div>
        </div>
        <div class="row">      
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">  
                        <form method="POST" action="" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Select Color :</label>
                        <!-- <div class="col-sm-3">                
                             <?php
                                $pro_col =  explode(',',$products_color->product_color);
                                //$colorFound = new ColorFound;
                                //echo $colorFound->getName("#66a85a");
                                foreach ($pro_col as $key => $value) {
                                ?>
                                <span class="dot" style="background-color:<?=$value?>" value="<?=$value?>"></span>
                                <?php   
                                }
                                ?>
                                
                                <input type="hidden" name="selected_color" id="selected_color">
                                </div>
                        </div> -->

                        <div class="col-sm-3">
                            <select class="form-control form-control-square" name="selected_color">
                                 <option value="">Select If Required*</option>
                                 <?php
                                    $pro_col =  explode(',',$products_color->product_color);
                                    foreach ($pro_col as $key => $value) {
                                    ?>
                                     <option value="<?=$value?>"><?=ucfirst($value)?></option>
                                    <?php   
                                    }
                                    ?>
                            </select>
                        </div>
                        </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add Thumb Image :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="image/*" class="form-control form-control-square" name="thumb_img">
                                    <?=form_error('thumb_img')?>

                        </div> 
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('thumb_alt')?>" name="thumb_alt">
                            <?=form_error('thumb_alt')?>
                        </div>        
                    </div>                
                     
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add 1st Images :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="image/*" class="form-control form-control-square" name="img[]">
                            <?=form_error('img[]')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square"  value="<?=set_value('alt[]')?>" name="alt[]">
                            <?=form_error('alt[]')?>
                        </div>                                          
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add 2nd Images :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="image/*" class="form-control form-control-square" name="img[]">
                            <?=form_error('img[]')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('alt[]')?>" name="alt[]">
                            <?=form_error('alt[]')?>
                        </div>                                          
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add 3rd Images :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="image/*" class="form-control form-control-square" name="img[]">
                            <?=form_error('img[]')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('alt[]')?>" name="alt[]">
                            <?=form_error('alt[]')?>
                        </div>                                          
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Add 4th Images :</label>
                        <div class="col-sm-3">
                            <input type="file" accept="image/*" class="form-control form-control-square" name="img[]">
                            <?=form_error('img[]')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('alt[]')?>" name="alt[]">
                            <?=form_error('alt[]')?>
                        </div>                                          
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Video :</label>
                        <div class="col-sm-3">
                            <input type="file" class="form-control form-control-square" name="video" accept="video/mp4,video/x-m4v,video/*">
                            <?=form_error('video')?>
                        </div>
                         <label class="col-sm-2 col-form-label">Alt Tag :</label>    
                         <div class="col-sm-3">
                            <input type="text" class="form-control form-control-square" value="<?=set_value('video_alt')?>" name="video_alt">
                            <?=form_error('video_alt')?>
                        </div>                                          
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"></label>
                       
                        <div class="col-sm-1">
                            <button type="submit" class="btn btn-primary shadow-primary btn-square">Submit</button>
                        </div>                   
                    </div>    
                        </form>                
                         </div>                                           
                        <hr>

                        <!-- <div class="row">
                        <?php
                        foreach($products_image as $k=>$v)
                        {
                        ?>      
                                <div class="col-md-3 mb-3 img_mod">
                                    <img class="pro_img" src="<?=base_url('assets/product_image/').$v->image?>"></br>
                                    <a class="btn-sm btn-danger mt-2 remove_button" onclick="return confirm('Are you sure want to delete')"
                                    href="<?=base_url('restaurant/delete_item_image/').base64_encode($v->id)?>">Remove</a>
                                </div> 
                           
                        <?php                           
                        }                        
                        ?>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
</div>
<style>
    .pro_img
    {
        vertical-align: middle;
        border-style: none;
        width: 100%;
        margin-bottom: -7px;
        height: 210px;
    }
    .btn-sm.btn-danger.mt-2.remove_button {
    display: block;
    text-align: center;
    font-size: 15px;
}
.img_mod
{
    box-shadow: 0 2px 5px;

}

.dot {
  height: 25px;
  width: 25px;
  border-radius: 50%;
  display: inline-block;
  margin-right: 25px;
}

.additional_css 
{
    border: 2px solid gray;
           box-shadow: 0px 4px;
}
/*__________________TEST_______________*/

</style>
<?php include('include/footer.php')?>
<script type="text/javascript">
  $('#my-btns .btn').on('click', function(event) {
  console.log($(this).find('input').val());
  var val = $(this).find('input').val();
  $('#output').html(val);
});

$('.dot').click(function() {
      var d = $(this).attr('value');    
      $('#selected_color').val(d);  
      $(this).addClass("additional_css");
});
</script>
