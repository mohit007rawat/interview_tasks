<?php include('include/header.php')?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">   
      
        <div class="row">      
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">Personal Detail's</div>                        
                        <hr>
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Full Name</th>
                                        <td width="80%"><?=ucfirst($store_details->username).' '.ucfirst($store_details->l_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Email</th>
                                        <td width="80%"><?=$store_details->email?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Mobile Number</th>
                                        <td width="80%"><?='+'.$store_details->country_code.' '.$store_details->mobile?></td>
                                    </tr>                                                                     
                        </table>
                        <hr>
                        <div class="card-title">Store Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Store Name</th>
                                        <td width="80%"><?=$store_details->store_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Estimated Delivery Time</th>
                                        <td width="80%"><?=$store_details->estimated_delivery_time?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Store Licence</th>
                                        <td width="80%"><img width="220px" height="140px" src="<?=base_url('assets/store_license/').$store_details->store_license?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Store Image</th>
                                        <td width="80%"><img width="220px" height="140px" src="<?=base_url('assets/store_images/').$store_details->store_image?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">ID Proof</th>
                                        <td width="80%"><img width="220px" height="140px" src="<?=base_url('assets/store_id_proof/').$store_details->id_proof?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Store Desc</th>
                                        <td width="80%"><?=$store_details->store_desc?></td>
                                    </tr>
                        </table>

                        <hr>
                        <div class="card-title">Bank Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Account Holder Name</th>
                                        <td width="80%"><?=$store_details->account_holder_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Bank Code</th>
                                        <td width="80%"><?=$store_details->bank_code?></td>
                                    </tr>                                   
                                    <tr>
                                        <th width="20%">Account Number</th>
                                        <td width="80%"><?=$store_details->account_number?></td>
                                    </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--End Row-->

    </div>
</div>
<?php include('include/footer.php')?>
