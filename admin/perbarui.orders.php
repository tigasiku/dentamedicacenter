<?php
set_time_limit(0);
session_start();
include "koneksi.php";
koneksi_buka();

	date_default_timezone_set("Asia/Makassar");
	
	$id=$_POST['id'];
	$inv=$_POST['id'];
	$subtotal=$_POST['subtotal'];					
	$grandtotal=$_POST['grandtotal'];
	
	$username=$_POST['username'];
	$status=$_POST['status'];
	$wallet=$_POST['wallet'];	
	
	
$cek_referral=	mysql_num_rows(mysql_query("select username,affiliate from referral where kd_penjualan ='".$id."'"));
if($cek_referral == 0 ){
	
$cek_user_buyer=mysql_fetch_array(mysql_query("select username,affiliate,referral from customer where username ='".$username."'"));
	
	if(!empty($cek_user_buyer['referral']) and $status=="V" or !empty($cek_user_buyer['referral']) and $status=="Y"){
		//persen_affiliate
		$qry_persen_affiliate=mysql_fetch_array(mysql_query("select * from persen_affiliate"));
		
		$persen_affiliate=($qry_persen_affiliate['persen_affiliate']*$subtotal)/100;	
		
		
		$cek_user_referral=mysql_fetch_array(mysql_query("select username,affiliate from customer where affiliate ='".$cek_user_buyer['referral']."'"));
		
		$referral=mysql_query("INSERT INTO referral VALUES ('','".$id."','".$cek_user_referral['username']."','".$cek_user_referral['affiliate']."','".$cek_user_buyer['affiliate']."','".$qry_persen_affiliate['persen_affiliate']."','".$persen_affiliate."','".date("Y-m-d H:i:s")."')");		
		
		$qry_wallet=mysql_fetch_array(mysql_query("select * from wallet where username='".$cek_user_referral['username']."'"));
		$wallet=$qry_wallet['wallet']+$persen_affiliate;
		
		
		$update_wallet=mysql_query("update wallet set wallet='".$wallet."'  where username='".$cek_user_referral['username']."'");
	}
}


		
		
		
        $update= mysql_query("UPDATE penjualan SET  
		subtotal='".$subtotal."',
		total='".$grandtotal."',
		status='".$status."'
		 where kd_penjualan='$id'");

	
		if(	$update) {
			
			if($status=="V" or $status =="Y"){
				
					include("../email.pembayaran.success.php");
					include("../email.logistik.php");
					
			}else{
				header('location:index.php?page=edit.orders&id='.$id.'&next=order.details&pesan=success'); 
			}
		}
		
koneksi_tutup();		
?>