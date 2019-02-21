<div class="alert alert-info" role="alert">
	<h6>
		<i class="fa fa-bell"></i>
		Important Reminders
	</h6>
	<ul>
		<li>Make sure all date given is correct, for this will serve as our guide for your trining request.</li>
		<li>Please check your email regularly for the final notification and training reminders</li>
	</ul>

	<div class="row">
		<div class="col-md-12">
			<p>
				In case you need an update on your request you may contact <strong>Isuzu Training Department</strong><br>
				at <strong>(049) 541-0224 local 346</strong> , Monday to Friday, 7:30 A.M - 5:45 P.M and look for <strong>Ms. Clarissa Manimtim</strong>.
			</p>
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
			<button class="btn btn-sm btn-outline-info" v-on:click="didNotReadYet = false">
				<i class="fa fa-check"></i>&nbsp;
				Please click if you read the above statement
			</button>
			<button v-on:click="submitDummyRequestData()" class="btn btn-sm btn-outline-success" v-bind:disabled="didNotReadYet">
				Submit Request
				<i class="fa fa-arrow-circle-right"></i>&nbsp;
			</button>
		</div>
	</div>
</div>

<br>
<div class="row">
	<div class="col-md-12">
		<h3 class="grey--text ml-2">Special Trainings</h3>
	</div>
</div>

<div class="form-row">
	<div 
	v-for="(item, index) in special_trainings" v-bind:key="item.special_training_id"
	class="col-md-4">
		<div class="card">
			<h6 class="card-header">@{{ item.program_title }}</h6>
			<div class="card-body">
				<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li 
					v-for="(item, index) in item.special_training_images" 
					v-bind:key="index" 
					data-target="#carouselExampleIndicators" :data-slide-to="index" :class="index == 0 ? 'active' : ''"></li>
				</ol>
				<div class="carousel-inner">
					<div 
					v-for="(item, index) in item.special_training_images" 
					v-bind:key="item.special_training_image_id"
					:class="`carousel-item ${index == 0 ? 'active' : ''}`"
					>
						<img class="d-block w-100" :src="`{{url('public/images/photo_gallery')}}/${item.image}`" height="300" alt="First slide">
					</div>
				</div>
					<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
						<span class="carousel-control-prev-icon" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
						<span class="carousel-control-next-icon" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>