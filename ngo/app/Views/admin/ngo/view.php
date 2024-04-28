<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-house"></i> NGO</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo base_url('pending-ngos'); ?>">NGO</a></li>
	</ul>
</div>
<?php
	$state_name = "";
	$city_name = "";
	if($states) {
		foreach($states as $state) {
			if($state["id"] == $ngo["state"]) {
				$state_name = $state["name"];
			}
		}
	}
	if($cities) {
		foreach($cities as $city) {
			if($city["id"] == $ngo["city"]) {
				$city_name = $city["name"];
			}
		}
	} 
?>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<div class="tile-body">
				<h4><?php echo $ngo['name']; ?></h4><hr>
				<table class="table table-default table-bordered">
					<tbody>
						<tr>
							<td width="20%">NGO Name</td>
							<td width="80%"><?php echo $ngo['name']; ?></td>
						</tr>
						<tr>
							<td width="20%">NGO Email</td>
							<td width="80%"><?php echo $ngo['email']; ?></td>
						</tr>
						<tr>
							<td width="20%">NGO Mobile No.</td>
							<td width="80%"><?php echo $ngo['phone']; ?></td>
						</tr>
						<tr>
							<td width="20%">NGO Location</td>
							<td width="80%"><?php echo $city_name.", ".$state_name; ?></td>
						</tr>
						<tr>
							<td width="20%">PG Address</td>
							<td width="80%"><?php echo $ngo['address']; ?></td>
						</tr>
						<tr>
							<td width="20%">Note</td>
							<td width="80%"><?php echo $ngo['note']; ?></td>
						</tr>
						<tr>
							<td width="20%">Banner</td>
							<td width="80%"><img src="<?php echo base_url('public/uploads/ngo/'.$ngo['banner']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /></td>
						</tr>
					</tbody>
				</table>
				<?php
					$photos = [];
					if($ngo["photos"] != "") {
						$photos = json_decode($ngo["photos"],true);
					}
					if(!empty($photos)) {
						echo "<h4><u>Photos</u></h4>";
						echo '<div class="row">';
						foreach($photos as $photo) {
				?>
							<div class="col-lg-4">
								<center>
									<img src="<?php echo base_url('public/uploads/ngo/'.$photo['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br><br>
								</center>
							</div>
				<?php
						}
						echo '</div>';
					} 
				?>
				<?php
					$documents = [];
					if($ngo["documents"] != "") {
						$documents = json_decode($ngo["documents"],true);
					}
					if(!empty($documents)) {
						echo "<h4><u>Documents</u></h4>";
						echo '<div class="row">';
						foreach($documents as $photo) {
				?>
							<div class="col-lg-4">
								<center>
									<img src="<?php echo base_url('public/uploads/ngo/'.$photo['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br><br>
								</center>
							</div>
				<?php
						}
						echo '</div>';
					} 
				?>
				<?php
					$certifications = [];
					if($ngo["certifications"] != "") {
						$certifications = json_decode($ngo["certifications"],true);
					}
					if(!empty($certifications)) {
						echo "<h4><u>Certifications</u></h4>";
						echo '<div class="row">';
						foreach($certifications as $photo) {
				?>
							<div class="col-lg-4">
								<center>
									<img src="<?php echo base_url('public/uploads/ngo/'.$photo['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br><br>
								</center>
							</div>
				<?php
						}
						echo '</div>';
					} 
				?>
				<center>
					<?php
						$session = session();
						if($session->get('userdata')['role'] == 3) {
					?>
							<a class="btn btn-success btn-sm" href="<?php echo base_url('approve-ngo/'.$ngo['id']); ?>">
								<i class="bi bi-check"></i>
							</a>
							<a class="btn btn-danger btn-sm" href="<?php echo base_url('reject-ngo/'.$ngo['id']); ?>">
								<i class="bi bi-trash"></i>
							</a>
					<?php
						} else {
							if($is_applied == 0) {
					?>
								<a class="btn btn-success btn-sm" href="javascript:upload_document(<?php echo $ngo['id']; ?>);">Donate</a>
					<?php
							} else if($is_applied == 1) {
					?>
								<a class="btn btn-success btn-sm" href="javascript:give_feedback(<?php echo $ngo['id']; ?>);">Give Feedback</a>
					<?php
							} else {
					?>
								<br>
								<div class="alert alert-info">Documents uploaded Please wait your confirmation.</div><br><br>
					<?php
							}
						} 
					?>
				</center>
			</div>
		</div>
	</div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="feedback-modal">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
    		<form class="form-control" method="post" action="<?php echo base_url('pg-feedback'); ?>" enctype="multipart/form-data">
    			<input type="hidden" name="pg_feedback_id" id="pg_feedback_id" />
	      		<div class="modal-header">
	        		<h5 class="modal-title"><?php echo $ngo['name']; ?></h5>
	      		</div>
	      		<div class="modal-body">
	        		<div class="row">
						<div class="col-lg-12" id="star">
							<div class="mb-3">
								<label class="form-label">Rate*</label>
								<select class="form-control" name="rate" required>
									<option value="">Option</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
							</div>
							<!-- <center>
								<i class="bi bi-star"></i>&nbsp;&nbsp;
								<i class="bi bi-star"></i>&nbsp;&nbsp;
								<i class="bi bi-star"></i>&nbsp;&nbsp;
								<i class="bi bi-star"></i>&nbsp;&nbsp;
								<i class="bi bi-star"></i>
							</center> -->
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Comment*</label>
								<textarea class="form-control" name="comment" required></textarea>
							</div>
						</div>
					</div>
	      		</div>
	      		<div class="modal-footer">
	        		<button type="submit" class="btn btn-primary">Submit</button>
	        		<a href="javascript:window.location.reload();" class="btn btn-secondary">Close</a>
	      		</div>
	      	</form>
    	</div>
  	</div>
</div>
<script type="text/javascript">
	var page_title = "PGs";
	$(document).ready(function(){
		// $("#star i").click(function(){
		// 	if($(this).hasClass("bi-star")) {
		// 		$(this).removeClass("bi-star");
		// 		$(this).addClass("bi-star-fill");
		// 	} else {
		// 		$(this).removeClass("bi-star-fill");
		// 		$(this).addeClass("bi-star");
		// 	}
		// 	alert($("#star i[class=bi-star-fill]").length);
		// });
	});
	function upload_document(pg_id)
	{
		$("#pg_id").val(pg_id);
		$("#upload-document-modal").modal('show');	
	}
	function give_feedback(pg_id)
	{
		$("#pg_feedback_id").val(pg_id);
		$("#feedback-modal").modal('show');
	}
</script>
<?= $this->endSection(); ?>