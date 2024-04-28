<?= $this->extend('admin/header'); ?>
<?= $this->section('main_content'); ?>
<?php
	$photos = $documents = $certifications = [];
	if($ngo) {
		$header_title = "Edit NGO";
		$header_title_url = base_url("ngos/".$ngo['id'].'/edit');
		$action = base_url("ngos/".$ngo['id']);
		$btn_title = "Save";

		$id = $ngo['id'];
		$ngo_id = $ngo["ngo_id"];
		$name = $ngo["name"];
		$phone = $ngo["phone"];
		$email = $ngo["email"];
		$state_id = $ngo["state"];
		$city_id = $ngo["city"];
		$address = $ngo["address"];
		$note = $ngo["note"];
		if($ngo["photos"] != "") {
			$photos = json_decode($ngo["photos"],true);
		}
		if($ngo["documents"] != "") {
			$documents = json_decode($ngo["documents"],true);
		}
		if($ngo["certifications"] != "") {
			$certifications = json_decode($ngo["certifications"],true);
		}
		$banner = $ngo["banner"];
	} else {
		$header_title = "New NGO";
		$header_title_url = base_url("ngos");
		$action = base_url("ngos");
		$btn_title = "Add";

		$id = 0;
		$ngo_id = md5(time());
		$name = "";
		$phone = "";
		$email = "";
		$state_id = "";
		$city_id = "";
		$address = "";
		$note = "";
		$banner = "";
	}
?>
<div class="app-title">
	<div>
		<h1><i class="bi bi-house"></i> NGOs</h1>
		<p></p>
	</div>
	<ul class="app-breadcrumb breadcrumb">
		<li class="breadcrumb-item"><i class="bi bi-house-door fs-6"></i></li>
		<li class="breadcrumb-item"><a href="<?php echo $header_title_url; ?>"><?php echo $header_title; ?></a></li>
	</ul>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="tile">
			<form method="post" action="<?php echo $action; ?>" enctype="multipart/form-data">
				<input type="hidden" name="ngo_id" value="<?php echo $id; ?>" />
				<input type="hidden" name="old_banner" value="<?php echo $banner; ?>" />
				<?php
					if($name != "") {
						echo '<input type="hidden" name="_method" value="put" />';
					} 
				?>
				<div class="tile-body">
					<div class="row">
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO Name*</label>
								<input class="form-control" type="text" name="name" value="<?php echo $name; ?>" required autofocus />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO Email*</label>
								<input class="form-control" type="email" name="email" value="<?php echo $email; ?>" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO Phone*</label>
								<input class="form-control" type="number" name="phone" value="<?php echo $phone; ?>" required />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO Country*</label>
								<input class="form-control" type="text" value="India" disabled />
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO State *</label>
								<select class="form-control" name="state" id="state" required>
									<option value="">Please select</option>
									<?php
										if($states) {
											foreach($states as $state) {
									?>
												<option value="<?php echo $state['id']; ?>" <?php echo $state['id'] == $state_id ? "selected" : ""; ?>>
													<?php echo $state['name']; ?>
												</option>
									<?php
											}
										} 
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="mb-3">
								<label class="form-label">NGO City*</label>
								<select class="form-control" name="city" id="city" required>
									<option value="">Please select</option>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">NGO Address*</label>
								<input class="form-control" type="text" name="address" value="<?php echo $address; ?>" required />
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Note</label>
								<textarea class="form-control" name="note"><?php echo $note; ?></textarea>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Banner</label>
								<input type="file" name="banner" class="form-control" />
								<?php 
									if($banner != "") {
								?>
										<br><img src="<?php echo base_url('public/uploads/ngo/'.$banner); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" />
								<?php
									}
								?>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Photos</label>
								<input type="file" name="photos[]" class="form-control" multiple />
								<!-- <img src="" class="img img-thumbnail img-responsive" /> -->
							</div>
						</div>
						<?php
							if(!empty($photos)) {
								echo '<div class="row">';
								$count = 0;
								foreach($photos as $photo) {
									$count++;
						?>
									<div class="col-lg-4" id="photo-<?php echo $count; ?>">
										<center>
											<img src="<?php echo base_url('public/uploads/ngo/'.$photo['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br>
											<a href="javascript:;" onclick="remove_photo(<?php echo $id; ?>,'<?php echo $photo['item_id']; ?>',<?php echo $count; ?>,'photo')"><i class="bi bi-trash"></i></a>
										</center>
									</div>
						<?php
								}
								echo '</div>';
							} 
						?>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Documents</label>
								<input type="file" name="documents[]" class="form-control" multiple />
								<!-- <img src="" class="img img-thumbnail img-responsive" /> -->
							</div>
						</div>
						<?php
							if(!empty($documents)) {
								echo '<div class="row">';
								$count = 0;
								foreach($documents as $document) {
									$count++;
						?>
									<div class="col-lg-4" id="document-<?php echo $count; ?>">
										<center>
											<img src="<?php echo base_url('public/uploads/ngo/'.$document['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br>
											<a href="javascript:;" onclick="remove_photo(<?php echo $id; ?>,'<?php echo $document['item_id']; ?>',<?php echo $count; ?>,'document')"><i class="bi bi-trash"></i></a>
										</center>
									</div>
						<?php
								}
								echo '</div>';
							} 
						?>
						<div class="col-lg-12">
							<div class="mb-3">
								<label class="form-label">Certifications</label>
								<input type="file" name="certifications[]" class="form-control" multiple />
								<!-- <img src="" class="img img-thumbnail img-responsive" /> -->
							</div>
						</div>
						<?php
							if(!empty($certifications)) {
								echo '<div class="row">';
								$count = 0;
								foreach($certifications as $certification) {
									$count++;
						?>
									<div class="col-lg-4" id="certification-<?php echo $count; ?>">
										<center>
											<img src="<?php echo base_url('public/uploads/ngo/'.$certification['avatar']); ?>" style="width: 175px;height: 175px;" class="img img-thumbnail img-responsive" /><br>
											<a href="javascript:;" onclick="remove_photo(<?php echo $id; ?>,'<?php echo $certification['item_id']; ?>',<?php echo $count; ?>,'certification')"><i class="bi bi-trash"></i></a>
										</center>
									</div>
						<?php
								}
								echo '</div>';
							} 
						?>
					</div>
				</div>
				<div class="tile-footer">
					<button class="btn btn-primary" type="submit"><?php echo $btn_title; ?></button>&nbsp;
					<a href="<?php echo base_url('ngos'); ?>" class="btn btn-sm btn-info">Back</a>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	var page_title = "NGOs";
	var city_id = "<?php echo $city_id; ?>";
	$(document).ready(function(){
		get_city($("#state").val(),city_id);
		$(document).on("change","#state",function(){
			get_city($(this).val());
		});
	});
	function get_city(state_id,city_id = 0)
	{
		$.ajax({
			url: "<?php echo base_url('get-state-wise-city'); ?>",
			type: "get",
			data:{
				state_id: state_id
			},
			dataType: "json",
			success:function(response){
				var option = "<option value=''>Please select</option>";
				if(response.status == 200) {
					for(var i = 0; i < response.data.length; i ++) {
						option += '<option value="'+response.data[i].id+'">'+response.data[i].name+'</option>';
					}
				}
				$("#city").html(option);
				if(city_id != 0) {
					$("#city").val(city_id).trigger("change");
				}
			}
		});
	}
	function remove_photo(ngo_id,id,no,field)
	{
		if(confirm("Are you sure to remove this row?")) {
			$.ajax({
				url: "<?php echo base_url('remove-ngo-photo'); ?>",
				type: "post",
				data:{
					ngo_id: ngo_id,
					id: id,
					field: field
				},
				dataType: "json",
				success:function(response){
					if(response.status == 200)
						$("#"+field+"-"+no).remove();
				}
			});
		}
	}
</script>
<?= $this->endSection(); ?>