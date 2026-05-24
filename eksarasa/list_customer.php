

<div class="modal fade" id="listcus" tabindex="-1" role="dialog" aria-labelledby="listcus" aria-hidden="true"  style="z-index:77040 !important" >
<div class="modal-dialog" style="margin-top:40px">
        <div class="modal-content">
        
        <?php if(isset($_GET['tambah'])){
				include("tambah.customer.php");
			}else{?>
<section class="content">
			<div class="row">
                        <div class="col-xs-12" id="content2">
                          
                               </div>
                            </div><!-- /.box -->
                        </div>
</section><!-- /.content --><?php } ?>
</div>
</div>
</div>
<?php

?>
<script>

//<![CDATA[
$(window).load(function(){
	
	$(".listcust").click(function() {
	$('#content2').load('isi_list_customer.php');
	});
	
});//]]> 


</script>