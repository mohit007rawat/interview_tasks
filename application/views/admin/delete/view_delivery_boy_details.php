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
                                        <th width="20%">Profile Image</th>
                                        <td width="80%"><img width="150px" height="100px" src="<?=base_url('assets/deliverboy_profile/').$delivery_boy->profile_img?>"></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Full Name</th>
                                        <td width="80%"><?=ucfirst($delivery_boy->name)?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Email</th>
                                        <td width="80%"><?=$delivery_boy->email?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Mobile Number</th>
                                        <td width="80%"><?=$delivery_boy->mobile?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Driving License</th>
                                        <td width="80%"><?=$delivery_boy->driving_license?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">delivery_area</th>
                                        <td width="80%"><?=$delivery_boy->delivery_area?></td>
                                    </tr>                                                          
                        </table>
                        <hr>
                       
                        <div class="card-title">Bank Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <tr>
                                        <th width="20%">Bank Name</th>
                                        <td width="80%"><?=$delivery_boy->bank_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Branch Name</th>
                                        <td width="80%"><?=$delivery_boy->branch_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Account Holder Name</th>
                                        <td width="80%"><?=$delivery_boy->account_holder_name?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">IFSC Code</th>
                                        <td width="80%"><?=$delivery_boy->ifsc_code?></td>
                                    </tr>                                   
                                    <tr>
                                        <th width="20%">Account Number</th>
                                        <td width="80%"><?=$delivery_boy->account_number?></td>
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
