<?php
include "koneksi.php";
koneksi_buka();
?>
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>
<link rel="stylesheet" href="css/jQueryUI/jquery-ui-1.10.3.custom.min.css">
<script src="js/jquery-ui-1.10.3.min.js"></script>
 <script>
  $(document).ready(function(){
    $("#load").hide();
    $('.autocomplete').each(function() {
      var $al = $(this);
        $al.autocomplete({
          source: function( request, response ) {
            window.globalVar = $al.attr('id');
            $.ajax({
              type: "POST",
              url: "execute.php?city=true",
              dataType: "json",
              data: {term: request.term},
              success: function(data) {
                response($.map(data, function(item) {
                  return {
                    label: item.city_name+' ('+item.type+')',
                    city_id: item.city_id
                  };
                }));
              }
            });
          },
          minLength: 2,
            select: function(event, ui) {
              $('#'+window.globalVar+'_id').val(ui.item.city_id);
            }
        });
    });

    $("#calculate").click(function(){

      var origin_id      = $("#origin_id").val();
      var destination_id = $("#destination_id").val();
      var weight         = $("#weight").val();

      if(!origin_id || !destination_id || !weight){
        alert('Please fill all form');
        return false;
      }

      if(parseInt(weight) < 1){
        alert('Weight min 1');
        return false;
      }

      if($.isNumeric( weight ) == true){

      } else {
        alert('Weight must number');
        return false;
      }
      
      $("#load").show();
      $.ajax({
        type: "POST",
        url: "execute.php?cost=true",
        dataType: "json",
        data: {origin: $("#origin_id").val(),destination: $("#destination_id").val(),weight: $("#weight").val()},
        cache : false,
        success: function(data) {
          $("#load").hide();
          $("#show-cost").html('');
          $.each(data, function(index, item) {
            $.each(item.costs, function(index, subitem) {
			   if(subitem.service=="REG"){
              $("#show-cost").append(subitem.service+' : '+subitem.cost[0].value+' ( '+subitem.cost[0].etd+' days )'+'<br />');
			   }
            });
          });
        }
      });
    });

    $(".autocomplete").keyup(function(){
      var x = event.keyCode;
      if(x != 13){
        $('#'+$(this).attr("id")+'_id').val("");
      }
    });

  });
  </script>
  <style>
  #load { height: 100%; width: 100%; }
  #load {
    position    : fixed;
    z-index     : 99; /* or higher if necessary */
    top         : 0;
    left        : 0;
    overflow    : hidden;
    text-indent : 100%;
    font-size   : 0;
    opacity     : 0.6;
    background  : #E0E0E0  url('loading.gif') center no-repeat;
  }
  </style>
<section class="content-header">
	<h1>
		Zona</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-xs-3">
							 <div class="box box-primary">
								<div class="box-header">
									
								</div>  
								<form action="simpan.distributor.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                    
                                    
                                     <div class="form-group" id="status">
										<label>Kode<b style="color:red;">*</b></label>	
                                       <input id="origin_id" type="text" class="form-control" readonly="readonly" name="kode">
                                         
									</div>
                                    <div class="form-group" id="status">
										<label>Kota<b style="color:red;">*</b></label>	
                                        <input name="kota" id="origin" class="autocomplete form-control"  required placeholder="Cari Kota">
									</div>
                                   
                                   
                                    
                                    
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-xs-9">
                            <div class="box box-primary">
                                <div class="box-header">
                                    
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=cabang" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form>
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
											<th width="" style="text-align:center;">Kode</th>
                                            <th width="" style="text-align:center;">Kota</th>
                                            
                                        </tr>
										<?php
										$limit = 30;
										if(isset($_GET['hal'])){
											$hal = $_GET['hal'];
										}
										else{
											$hal = 1;
										}

										$offset = ($hal - 1) * $limit;
										$i=1;
										$qry=mysql_query("select * from distributor LIMIT $offset, $limit");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;"><?php 
									echo		 $row['kode']
											 ?>
											 </td>
                                              <td style="text-align:center;"><?php 
											
											 echo $row['namakota']; 
											 
											   ?></td>
                                               
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<?php 
									$query  = "SELECT COUNT(kode) AS jumData from distributor";
									$hasil  = mysql_query($query);
									$data  = mysql_fetch_array($hasil);
									$jumData = $data['jumData'];
									$jumPage = ceil($jumData/$limit);
								?>
								<label style="float:left;margin-top:6px;">
								<?php
								if ($jumData==0){
									echo "Showing 0 to 0 of 0 Entries";
								}else{
								
								?>
								Showing <?php echo $offset+1;?> to 
								<?php 
								if ($jumPage==$hal){
								echo $jumData;
								}else{
								echo $limit*$hal;
								}
								?> 
								of <?php echo $jumData;?> Entries &nbsp;&nbsp;
								<?php } ?>
								</label>
								<ul class="pagination pagination-sm no-margin pull-right">
								<?php
								for($i = 1; $i <= $jumPage; $i++){
										 if ((($i >= $hal - 3) && ($i <= $hal + 3)) || ($i == 1) || ($i == $jumPage))
										 {
											if ($i == $hal) echo "<li><a href=''><b>".$i."</b></a></li>";
											else echo "<li><a href='".$_SERVER['PHP_SELF']."?page=distributor&hal=".$i."'>".$i."</a></li>";
										 }
								}
								?>
                                </ul>
								<label style="float:right;margin-top:5px;">
									Page :&nbsp;&nbsp;
								</label>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->
<?php
koneksi_tutup();
?>