
<script language="javascript">
   function setBrg(vkd){
     window.opener.document.getElementById('satuan').value = vkd;
     window.self.close();
   }
</script>
<script type = "text/javascript">

function addCommas(nStr) {
nStr = nStr.replace(/[^0-9\.]/g,"");
nStr = Number(nStr).toFixed(0);   // remove excess decimals
var rgx = /(\d+)(\d{3})/;
while (rgx.test(nStr)) {
nStr = nStr.replace(rgx, '$1,$2');
}
if (nStr.indexOf('.') == -1) {  // if whole number add .00
nStr = nStr + "";
}
nStr = nStr.replace(/(\.\d)$/,"$10");  // if only one DP add another 0
return nStr;
}

var x1;
var x2;

function show() {
var totalStr = (x1 + x2).toString();
totalStr = addCommas(totalStr);
document.form1.t.value = totalStr;
}


</script>
<section class="content-header">
	<h1>
		Gudang</h1>
</section>

<section class="content">
  <div class="row">
  					<div class="col-sm-3">
							<div class="box box-solid box-warning">
								<div class="box-header">
									<h3 class="box-title">Data</h3>
								</div>  <?php 
									if(isset($_GET['pesan'])){ ?>  
                                  <div class="small-box <?php if((@$_GET['pesan']=="success")){ echo "bg-green"; }else{  echo "bg-red"; }?>">
                                <div class="inner"><span style="font-weight:bold; font-size:18px"><?php echo $_GET['pesan'] ?> </span> 
                                </div>
                              </div><?php }?>
								<form action="simpan.gudang.php" method="post" enctype="multipart/form-data">
								<div class="box-body">		
								
									
                                     <div class="form-group" id="status">
										<label>Kode Gudang<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="bank"  required="required"  />
									</div>
                                    <div class="form-group" id="status">
										<label>Nama Gudang<b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="no_rek"   />
									</div>
                                    <div class="form-group" id="status">
										<label>Sort By <b style="color:red;">*</b></label>	
										    <input type="text" class="form-control" name="sort_by"    />
									</div>
                                     <div class="form-group" id="status">
										<label>Status<b style="color:red;">*</b></label>	
                                        
										    <select class="form-control form-control2" name="status"   />
                                            <option value="">Tidak</option>
                                             <option value="active">active</option>
                                                             
                                            </select>
									</div>
									
<button "submit" class="btn btn-primary btn-flat pull-right" name="submit"><i class="fa fa-save"></i> &nbsp;Simpan</button>
								</div>
								</form>
								<div class="clearfix"></div>
							</div>
						</div>
                        
                        <div class="col-sm-9">
                            <div class="box box-waring">
                                <div class="box-header">
                            </div><!-- /.box-header -->
                                <div class="box-body" style="padding-top:0px;">
									
                                        <form action="?page=<?php echo $page ?>" method="post">
										<div class="input-group">
                                            <input type="text" name="cari" class="form-control input-sm pull-right" style="width: 20%;" placeholder="Search" value="<?php echo @$_POST['cari']?>"/>
                                            <div class="input-group-btn">
                                                <button class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
										</form> <div class="table-responsive">
                                    <table class="table table-hover table-bordered" style="margin-top:10px;">
                                        <tr>
                                            <th width="10" style="text-align:center;">No</th>
											<th width="" style="text-align:center;">Kode </th>
                                            <th width="" style="text-align:center;">Nama </th>
                                            <th width="" style="text-align:center;">Status</th>
                                            <th width="" style="text-align:center;">Sort By</th>
                                       		  <th width="" style="text-align:center;">Aksi</th>
                                        </tr>
										<?php
										
										$i=1;
										$qry=mysql_query("select * from gudang where gudang like '%".@$_POST['cari']."%' order by sort_by");
										while($row=mysql_fetch_array($qry)){
										?>
                                        <tr  onclick="javascript:setBrg('<?php echo $row['1'] ?>')">
                                            <td align="center"><?php echo $i;?></td>
											 <td style="text-align:center;"><?php echo $row['0'] ?></td>
                                              <td style="text-align:center;"><?php echo $row['1'] ?></td>
                                               <td style="text-align:center;white-space:nowrap"><?php echo $row['2'] ?></td>
                                                <td style="text-align:center;"><?php echo $row['sort_by'] ?></td>
                                                            <td style="text-align:center;"><a href="?page=edit.gudang&id=<?php echo $row[0]?>"><span class="fa fa-edit"></span></a>  
											<a href="?page=hapus.gudang&id=<?php echo $row[0]?>" class="hapus"><span class="fa fa-trash-o"></span></a></td>
                                                 
                                        </tr>
                                        <?php
										$i++;
										}
										?>
                                    </table></div>
                                </div><!-- /.box-body -->
								
                                <div class="box-footer clearfix">
								<div class="row">
									
                               		  </div>
                                </div>
                            </div><!-- /.box -->
                        </div>
                    </div>
</section><!-- /.content -->

<script>
	
$(".form-control2 option").each(function() {


  $(this).css("background-color", $(this).text())
})	
	
$( ".hapus" ).click(function( event ) {

	 var setuju=confirm("Apakah Anda Yakin ?");
  if ( setuju ) {
   
    return;
  }
 

  event.preventDefault();
});
</script>