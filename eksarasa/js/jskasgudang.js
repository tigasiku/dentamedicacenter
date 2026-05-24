$(function() {
     $("#kas_utama").change(function(){
          $("img#imgLoad").show();
          var idProvinsi = $(this).val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getKas.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                     $("select#kas_tujuan").html('<option value="">--Semua--</option>');
					
                         
                 }else{
					 		
                           $("select#kas_tujuan").html(msg);  
					   
                 }
                 $("img#imgLoad").hide();
 
                 getAjaxAlamat();                                                        
             }
          });                    
     });
 });	 
 

 $(function() {
     $("#gudang").change(function(){
          $("img#imgLoad").show();
          var idProvinsi = $(this).val();
 
          $.ajax({
             type: "POST",
             dataType: "html",
             url: "getGudang.php",
             data: "idProvinsi="+idProvinsi,
             success: function(msg){
                 if(msg == ''){
                     $("select#gudang_tujuan").html('<option value="">--Semua--</option>');
					
                         
                 }else{
					 		
                           $("select#gudang_tujuan").html(msg);  
					   
                 }
                 $("img#imgLoad").hide();
 
                 getAjaxAlamat();                                                        
             }
          });                    
     });
 });	 
 

 