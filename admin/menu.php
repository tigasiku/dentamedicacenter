<?php
if(!isset($_GET['page'])){
	$page="home";
}else{
	$page=$_GET['page'];
}
?>
<ul class="sidebar-menu">
<li class="<?php if($page=="home"){echo "active";}?>">
 		 <a href="?page=home"><i class="fa fa-dashboard"></i>Dashboard</a> </li>
<?php 
if($_SESSION["loglevel_graha"]=="Administrator"){ ?>
<li  class="treeview <?php if( $page=="management.slide"  or $page=="tambah.management.user" or $page=="waktu_slip" or $page=="dasar_penilaian" or $page=="hirarki" or $page=="management.user" or $page=="informasi" or $page=="post.informasi"  or $page=="store.location" or $page=="sosial.media" or $page=="sosial.media" or $page=="alasan" or $page=="post.alasan" or $page=="visi.misi" or $page=="post.visi.misi"  or $page=="testimoni" or $page=="post.testimoni" or $page=="tambah.testimoni"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-cog"></i><span>Configuration</span><i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
       
       		<li <?php if($page=="store.location" ){echo "class='active'";}?>>
				<a href="?page=store.location">
					<i class="fa fa-angle-double-right"></i><span>Store Locations</span>
			</a></li>
        <li <?php if($page=="management.user" or $page=="tambah.management.user"){echo "class='active'";}?>>
				<a href="?page=management.user">
					<i class="fa fa-angle-double-right"></i><span>Management User</span>
			</a></li>
         
          
        	 
               <li <?php if($page=="testimoni" or $page=="post.testimoni" or $page=="tambah.testimoni"){echo "class='active'";}?>>
				<a href="?page=testimoni">
					<i class="fa fa-angle-double-right"></i><span>Testimoni</span>
			</a></li>
              <li <?php if($page=="sosial.media" or $page=="sosial.media"){echo "class='active'";}?>>
				<a href="?page=sosial.media">
					<i class="fa fa-angle-double-right"></i><span>Sosial Media</span>
			</a></li>
             
           
           
    </ul> 
    </li>
      <li <?php if($page=="tambah.divisi" or $page=="divisi" or $page=="post.divisi"){echo "class='active'";}?>>
				<a href="?page=divisi">
					<i class="fa fa-institution"></i><span>Divisi</span>
			</a></li>
                <li <?php if($page=="dokter" or $page=="post.dokter"  or $page=="tambah.dokter"){echo "class='active'";}?>>
				<a href="?page=dokter">
					<i class="fa fa-user"></i><span>Team </span>
			</a></li>
              <li <?php if($page=="tambah.treatments" or $page=="treatments" or $page=="post.treatments"){echo "class='active'";}?>>
				<a href="?page=treatments">
					<i class="fa fa-ambulance"></i><span>Treatments</span>
			</a></li>
              <li <?php if($page=="tambah.facilities" or $page=="facilities" or $page=="post.facilities"){echo "class='active'";}?>>
				<a href="?page=facilities">
					<i class="fa fa-industry"></i><span>Facilities</span>
			</a></li>
<li  class="treeview <?php if( $page=="management.slide"  or $page=="galeri_form" or $page=="post" or $page=="gallery" or $page=="artikel" or $page=="tambah.slide" or $page=="client" or $page=="tambah.client" or $page=="contact-user" or $page=="news" or $page=="post.news" or $page=="pengunjung" or $page=="ebook" or $page=="tambah.artikel"  or $page=="post.ebook" or $page=="ilmu" or $page=="edit.artikel" or $page=="post.ilmu"){echo "active";}?>">
		<a href="#">
			<i class="fa fa-globe"></i><span>Website </span><i class="fa fa-angle-left pull-right"></i>
        </a>
     <ul class="treeview-menu">
        	 <li <?php if($page=="management.slide"){echo "class='active'";}?>>
				<a href="?page=management.slide">
					<i class="fa fa-globe"></i><span>Management Slide Web</span>
			</a></li>
            
            <li <?php if($page=="artikel" or $page=="tambah.artikel"  or $page=="edit.artikel"  or $page=="post"){echo "class='active'";}?>>
		<a href="?page=artikel">
			<i class="fa fa-newspaper-o"></i><span>Artikel</span>
        </a>
    </li>
   
 
	

        <li <?php if($page=="contact-user" ){echo "class='active'";}?>>
		<a href="?page=contact-user">
			<i class="fa fa-phone"></i>Contact User
        </a>
    </li>
     <li <?php if($page=="pengunjung" ){echo "class='active'";}?>>
		<a href="?page=pengunjung">
			<i class="fa fa-bar-chart"></i>Pengunjung
        </a>
    </li>
    </ul> 
</li>

 <?php } 
 ?>
	<li >
		<a href="logout.php">
			<i class="fa fa-sign-out"></i><span>Logout</span>
        </a>
    </li>
    
</ul>
