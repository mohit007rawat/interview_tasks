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
                                        <td width="80%"><?=ucfirst($restaurant_details[0]->username).' '.ucfirst($restaurant_details[0]->l_name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Email</th>
                                        <td width="80%"><?=$restaurant_details[0]->email?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Mobile Number</th>
                                        <td width="80%"><?='+'.$restaurant_details[0]->country_code.' '.$restaurant_details[0]->mobile?></td>
                                    </tr>    
                                    <tr>
                                        <th width="20%">Street1</th>
                                        <td width="80%"><?=$restaurant_details[0]->street1?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Street2</th>
                                        <td width="80%"><?=$restaurant_details[0]->street2?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">City</th>
                                        <td width="80%"><?=$restaurant_details[0]->city?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Country</th>
                                        <td width="80%"><?=$restaurant_details[0]->country?></td>
                                    </tr>                                                                   
                        </table>
                        <hr>
                        <div class="card-title">Restaurant Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Restaurant Name</th>
                                        <td width="80%"><?=$restaurant_details[0]->store_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Estimated Delivery Time</th>
                                        <td width="80%"><?=$restaurant_details[0]->estimated_delivery_time?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Restaurant Licence</th>
                                        <td width="80%"><img width="220px" height="140px" src="<?=base_url('assets/restaurant_license/').$restaurant_details[0]->store_license?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">ID Proof</th>
                                        <td width="80%"><img width="220px" height="140px" src="<?=base_url('assets/restaurant_id_proof/').$restaurant_details[0]->id_proof?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Open Time</th>
                                        <td width="80%">
                                        <?php
                                            $d = new DateTime($restaurant_details[0]->open_time); 
                                            echo $d->format( 'g:i A' );
                                        ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Close Time</th>
                                        <td width="80%">
                                        <?php
                                            $d = new DateTime($restaurant_details[0]->close_time); 
                                            echo $d->format( 'g:i A' );
                                        ?>
                                        </td>
                                    </tr>
                        </table>

                        <hr>
                        <div class="card-title">Bank Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Account Holder Name</th>
                                        <td width="80%"><?=$restaurant_details[0]->account_holder_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Bank Code</th>
                                        <td width="80%"><?=$restaurant_details[0]->bank_code?></td>
                                    </tr>                                   
                                    <tr>
                                        <th width="20%">Account Number</th>
                                        <td width="80%"><?=$restaurant_details[0]->account_number?></td>
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
