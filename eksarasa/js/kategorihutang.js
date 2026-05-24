$(function() {
     $("#cmbKategoriPusat").change(function(){
          $("img#imgLoad").show();
          var idProvinsi = $(this).val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getKathutang.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                     $("select#cmbKategori").html('<option value="">--Semua--</option>');
					
                         
                 }else{
					 		
                           $("select#cmbKategori").html(msg);  
					   
					 
                 }
                 $("img#imgLoad").hide();
 
                 getAjaxAlamat();                                                        
             }
          });                    
     });
 });	 
 

 

$(function() {
     $("#cmbKategori").change(function(){
          $("img#imgLoad").show();
          var idProvinsi = $(this).val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getSubKat2filter.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                     $("select#subKategori").html('<option value="">--Semua--</option>');
					
                         
                 }else{
					 		
                           $("select#subKategori").html(msg);  
					
					 
                 }
                 $("img#imgLoad").hide();
 
                 getAjaxAlamat();                                                        
             }
          });                    
     });
 });	 
 

 