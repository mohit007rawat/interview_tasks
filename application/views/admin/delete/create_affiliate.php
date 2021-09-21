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
                    <a href="<?=base_url('affiliate_request')?>" class="btn btn-outline-primary waves-effect waves-light">Affiliate List</a>
                </div>
            </div>
        </div>
        <!-- End Breadcrumb-->

        <div class="row">
            <div class="col-lg-12 mx-auto">

                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Add Details</div>
                        <hr>
                        <form method="post" action="<?=base_url('admin/create_affiliate/').$this->uri->segment('2')?>" id="" enctype="multipart/form-data"> 
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Random Affilite Token</label>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-square" id="string" name="token" value="<?=set_value('token')?>" placeholder="Affilite Token">
                                    <?=form_error('token')?>
                                </div>
                                 <div class="col-sm-2">
                                    <input type="button" value="Generate String" class="btn btn-success" onClick="randomString();">
                                </div>
                               <!--  <div class="col-sm-2">
                                <h4 id="randomfield" style="color: green"> </h4>                                    
                                </div> -->
                            </div>
                            <!-- <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Discount Percentage</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control form-control-square" name="percentage" value="<?=set_value('percentage')?>" placeholder="Discount Percentage">
                                    <?=form_error('percentage')?>
                                </div>
                            </div> -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"></label>
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
function randomString() {
            //initialize a variable having alpha-numeric characters
    var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";

            //specify the length for the new string to be generated
    var string_length = 20;
    var randomstring = '';

            //put a loop to select a character randomly in each iteration
    for (var i=0; i<string_length; i++) {
        var rnum = Math.floor(Math.random() * chars.length);
        randomstring += chars.substring(rnum,rnum+1);
    }
             //display the generated string 
             $('#string').val(randomstring);
    document.getElementById("randomfield").innerHTML = randomstring;
}
</script>