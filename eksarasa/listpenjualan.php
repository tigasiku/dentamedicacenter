

	
<style>
	@media screen and (min-width: 768px){
.modal-dialog {
    width: 1100px !important;
}}
</style>
<div class="modal fade" id="basicModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true"  style="z-index:77040 !important" >
<div class="modal-dialog" style="margin-top:40px">
        <div class="modal-content">
<section class="content">
			<div class="row">
                        <div class="col-xs-12" id="content">
                          
                            </div><!-- /.box -->
                        </div>
</section><!-- /.content -->
</div>
</div>
</div>
<script>

//<![CDATA[
$(window).load(function(){
	
	$(".listpenjualan").click(function() {
		
		  var tanggalnya = $("#dp2").val();
		$('#content').load('isi_listpenjualan.php?tanggal='+tanggalnya);
			
	});
	
});//]]> 


</script>