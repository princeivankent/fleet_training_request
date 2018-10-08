<div class="row">
	<div class="col-md-12">
		<h3 class="raleway">Choose your Isuzu specific model to be the focus of training:</h3>
	</div>
</div>
<br><br>
<div class="form-row raleway" id="images">
	<div 
	v-for="(item, index) in unit_models"
	v-bind:key="item.unit_model_id"
	
	v-on:click="unitModelPicked(item.unit_model_id)"
	class="col-md-3 image-thumb-container menu">
		
		<span v-if="form.unit_model_id == item.unit_model_id ? true : false" class="badge badge-pill badge-success menu_label">
			<i class="fa fa-check"></i>&nbsp;
			Selected
		</span>
		<img v-bind:src="`{{ url('public/images/unit_models') }}/${item.image}`" 
		v-bind:alt="item.image">
		<p class="text-center">@{{ item.model_name }}</p>
	</div>
</div>