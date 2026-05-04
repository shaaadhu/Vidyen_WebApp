
  	<div class="row mt-3">
        		<div class="col-md-6">
        			<label class="form-label"><b>Name</b></label>
        			<input type="text" class="form-control bg-white"  value="<?php echo $data['name'];?>" readonly>
        		</div>
        		<div class="col-md-6">
        			<label class="form-label"><b>Type</b></label>
        			<input type="text" class="form-control bg-white"  value="<?php echo $data['type'];?>" readonly>
        		</div>
        	</div>

        	<div class="row mt-3">
        		<div class="col-md-12">
        			<label class="form-label"><b>Links</b></label>
        			<textarea class="form-control bg-white" rows="4" readonly><?php echo $data['links'];?></textarea>
        		</div>
        	</div>