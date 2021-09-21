
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>

<!-- <footer class="footer">
      <div class="container">
        <div class="text-center">
          Copyright © 2018 Rocker Admin
        </div>
      </div>
    </footer> -->
	<!--End footer-->
   
  </div><!--End wrapper-->

  <!-- Bootstrap core JavaScript-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <script src="<?=base_url()?>assets/js/popper.min.js"></script>
  <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>


   
	
  <!-- simplebar js -->
  <script src="<?=base_url()?>assets/plugins/simplebar/js/simplebar.js"></script>
  <!-- waves effect js -->
  <script src="<?=base_url()?>assets/js/waves.js"></script>
  <!-- sidebar-menu js -->
  <script src="<?=base_url()?>assets/js/sidebar-menu.js"></script>
  <!-- Custom scripts -->
  <script src="<?=base_url()?>assets/js/app-script.js"></script>
  
  <!-- Vector map JavaScript -->
  <script src="<?=base_url()?>assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
  <!-- Chart js -->
  <script src="<?=base_url()?>assets/plugins/Chart.js/Chart.min.js"></script>
  <!-- Index js -->
  <script src="<?=base_url()?>assets/js/index.js"></script>
  <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcyqDtmrobvX9IRFIbjbnEslaGPbwvA30&callback=initialize&libraries=places&v=weekly" defer></script>

<!--Data Tables js-->
	<script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/dataTables.buttons.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/buttons.bootstrap4.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/jszip.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/pdfmake.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/vfs_fonts.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/buttons.html5.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/buttons.print.min.js"></script>
  <script src="<?=base_url()?>assets/plugins/bootstrap-datatable/js/buttons.colVis.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	<script src="https://cdn.ckeditor.com/4.15.1/standard/ckeditor.js"></script>
  
</body>
<script>
  
  $('#malls').select2(
    { width: '100%', placeholder: "Select an Option", allowClear: true }
    );

$(document).ready(function(){
    $('#msg').delay(5000).slideUp(1000); 

     //CKEDITOR.replace( 'cat_description' );
});


     $(document).ready(function() {
      //Default data table
       $('#default-datatable').DataTable({
    responsive: true,
      "processing": true,
    "serverSide": true,
    "ajax": "<?=base_url('admin/datatable/')?>",
    dom: 'Bfrtip',
        buttons: [
           'csv'
        ]
});


      


      
 
   
      
      } );

    </script>
</html>
