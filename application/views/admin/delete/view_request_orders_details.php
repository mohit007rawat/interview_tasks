<?php 
include('include/header.php');
?>
<div class="clearfix"></div>
<div class="content-wrapper">
    <div class="container-fluid">   
    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header" style="display: flex;align-items: center; background-color: #c8eaeebd;"><i class="fa fa-table"></i>Order's Details
                          <div style="font-size: 17px;margin-left: auto;">Order ID : 
                        <span class="colorred" style="margin-right: 17px;"><?=@$orders->order_id?></span>
                        <button class="btn btn-info" onclick="goBack()">Go Back</button>
                    </div>
                    </div>
                  
                    <div class="card-body" style="background-color: #eaf2f9;">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Sl No.</th>            
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Product Qty</th>         
                                        <th scope="col">Status</th>         
                                    </tr>
                                </thead>
                                <tbody>

                                <?php 
                                      
                                      $i=1; 
                                      foreach($order_summery as $k=>$v) 
                                      { 
                                        $product_details = json_decode($v->product_details);
                                        // pr($product_details);
                                       
                                    ?>
                                     <tr data-id="<?=$v->id?>">
                                        <th scope="row"><?=$i++?></th>                                      
                                        <td><?=$product_details->name?></td>
                                        <td><?=$v->qty?></td> 
                                        <td><?=$orders->is_approved == 0 ? "Waiting for Approval" : 'Order Complete'?></td> 
                                          <!--  <td>
                                                    <select class="order_detail_status form-control" row_id="<?= base64_encode($v->id) ?>">
                                                        <option disabled>Select Status</option>
                                                        <option  disabled value="1" <?php if($v->status == 1){ ?> selected="" <?php } ?>>Dispatched</option>
                                                        <option disabled value="2" <?php if($v->status == 2){ ?> selected="" <?php } ?>>On the Way</option>
                                                        <option disabled value="3" <?php if($v->status == 3){ ?> selected="" <?php } ?>>Order Complete</option>
                                                    </select>
                                                </td>   -->                                    
                                        
                                    </tr>
                                    <?php 
                                    } 
                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">      
            <div class="col-lg-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                    <hr>
                        <div class="card-title">Order Detail's</div>   
                        
                        <table class="table table-bordered table-striped">
                                <tbody>                                    
                                    <tr>
                                        <th width="20%">Order Id</th>
                                        <td width="80%"><?=$orders->order_id?></td>
                                    </tr>
                                    <tr>
                                        <th width="20%">Total Amount</th>
                                        <td width="80%"><?=$orders->total_amount?> Rs.</td>
                                    </tr>  
                                    <tr>
                                        <th width="20%">Discount/Coupon Amount</th>
                                        <td width="80%"><?=$orders->discount_amount?> Rs.</td>
                                    </tr>  
                                     <tr>
                                        <th width="20%">Total Payble Amount</th>
                                        <td width="80%"><?=$orders->payable_amount?> Rs.</td>
                                    </tr>   
                                     <tr>
                                        <th width="20%">Amani Payment</th>
                                        <td width="80%"><?=@!empty($orders->amani_payment)?$orders->amani_payment:'0'?> Rs.</td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Amani Payment</th>
                                        <td width="80%"><?=@$orders->online_payment?> Rs.</td>
                                    </tr>    
                                    <tr>
                                        <th width="20%">Payment Method</th>
                                        <td width="80%"><?=$orders->payment_method == 0 ? "Cash on Delivery" : "Online Payment"?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Transaction Id</th>
                                        <td width="80%"><?=@$orders->transaction_id?></td>
                                    </tr>  
                                    <tr>
                                        <th width="20%">Payment Status</th>
                                        <td width="80%"><?=@$orders->payment_status?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Used Coupon</th>
                                        <td width="80%"><?=@$orders->coupon_code?></td>
                                    </tr>                                
                                   
                                      
                                              
                        </table>
                        <div class="card-title">Customer Detail's</div>     
                                           
                        <hr>
                        <table class="table table-bordered table-striped">
                                <tbody>
                                    <?php
                                    $customer_details = json_decode($orders->shipping_add);
                                    ?>
                                    <tr>
                                        <th width="20%">Full Name</th>
                                        <td width="80%"><?=ucfirst($customer_details->name)?></td>
                                    </tr>                                   
                                    <tr>
                                        <th width="20%">Mobile Number</th>
                                        <td width="80%"><?=$customer_details->mobile?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Shipping Address</th>
                                        <td width="80%"><?=$customer_details->address?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">City</th>
                                        <td width="80%"><?=$customer_details->city?></td>
                                    </tr> 
                                    <tr>
                                        <th width="20%">Zipcode</th>
                                        <td width="80%"><?=$customer_details->zipcode?></td>
                                    </tr> 
                                     <tr>
                                        <th width="20%">Country Address</th>
                                        <td width="80%"><?=$customer_details->country?></td>
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
