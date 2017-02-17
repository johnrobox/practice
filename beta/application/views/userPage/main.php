<br><br>
<div class="main-bg">
	 <div class="container"> 
	 	<div class="row"><br> 
						<h1 class="text-center banner"><strong>Choose location near you!</strong></h1><br> 
			<?php 
				$ctr = 0;
				foreach ($query_seminar as $row) { 
				if($row->seminar_is_active == 1){
					$ctr += $row->seminar_is_active;
				}}
				if($ctr == 0){
					echo ' <br> <br> <br> 
						<div class="jumbotron">
						  <h1>Konnichiwa minna-san,</h1>
						  <p>We will be conducting Free Orientation Seminar about Study, Live and Experience Japan near you soon.</p>
						  <p> For the meantime, please go our website for updates and more information </p>
						  <p><a class="btn btn-primary btn-lg" href="#" role="button">About us</a></p>
						</div>
					';
				}else{
					foreach ($query_seminar as $row){
						if($row->seminar_is_active == 1){?>
						  <div class="col-sm-6 col-md-4">
						    <div class="thumbnail">
						      <img src="<?php  
				                if($row->seminar_pic == ''){
				                  echo base_url().'/images/default-image.jpg';}
				                  else{
				                  echo base_url().$row->seminar_pic;}
				                ?>" 
				                class="img-responsive img-main">
						      <div class="caption text-center">
								<h3><strong><?php echo $row->seminar_name;?></strong></h3> 
								<h4><strong><?php echo $row->seminar_location;?></strong></h4> 
								<h4><small><?php echo date('F d, Y',strtotime($row->seminar_date));?></small> <br>
								<small><?php echo  $row->seminar_time;?></small></h4> 
						        <p>
						        <?php $seminar_name = str_replace(' ','-',strtolower($row->seminar_name));
						        	if(date('F d, Y') == date('F d, Y',strtotime($row->seminar_ends))){
						        		echo '<button type="button" class="btn btn-danger btn-block btn-md" disabled>Registration Closed</button>';
						        	}else{
						        ?>
						        <a href="<?php echo base_url()?>registration-form/<?php echo $seminar_name?>/<?=$row->seminar_location_url?>"  role="button" class="btn btn-primary btn-block btn-md">Register</a>  
						        <?php }?>
						        </p><br>
						      </div>
						    </div>
						  </div> 
			<?php }}}?>
		</div> 	
	</div>	
</div>