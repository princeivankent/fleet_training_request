<div class="card" style="height: 480px;">
	<h5 class="card-header">I. Fleet Customer Information</h5>
	<div class="card-body">
		<div class="form-row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="company_name">
						Company Name
						<span class="text-danger">*</span>
					</label>
					<input v-model="form.company_name" type="text" class="form-control" id="company_name" aria-describedby="textHelp">
				</div>

				<div class="form-group">
					<label for="office_address">
						Office Address
						<span class="text-danger">*</span>
					</label>
					<input v-model="form.office_address" type="text" class="form-control" id="office_address" aria-describedby="textHelp">
				</div>

				<div class="form-row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="contact_person">
								Contact Person
								<span class="text-danger">*</span>
							</label>
							<input v-model="form.contact_person" type="text" class="form-control" id="contact_person" aria-describedby="textHelp">
						</div>
						<div class="form-group">
							<label for="email">
								Email Address
								<span class="text-danger">*</span>
							</label>
							<input v-model="form.email" type="email" class="form-control" id="email" aria-describedby="textHelp">
						</div>
						
						<div class="form-group">
							<label for="selling_dealer">Selling Dealer</label>
							<v-select
								v-model="form.selling_dealer"
								:items="dealers"
								item-text="dealer"
          						item-value="dealer_id"
								chips
								label="Selling Dealers"
								deletable-chips
								multiple
								solo
								single-line
							>
								<template
								slot="selection"
								slot-scope="{ item, index }"
								>
								<v-chip v-if="index === 0">
									<span>@{{ item.dealer }}</span>
								</v-chip>
								<span
									v-if="index === 1"
									class="grey--text caption"
								>(+@{{ form.selling_dealer.length - 1 }} others)</span>
								</template>
							</v-select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="position">Position</label>
							<input v-model="form.position" type="text" class="form-control" id="position" aria-describedby="textHelp">
						</div>
						<div class="form-group">
							<label for="contact_number">
								Contact Number
								<span class="text-danger">*</span>
							</label>
							<input v-model="form.contact_number" type="text" class="form-control" id="contact_number" aria-describedby="textHelp">
						</div>
						<div class="form-group">
							<label for="unit_models">Isuzu Specific Unit Model</label>
							<v-select
								v-model="form.unit_models"
								:items="unit_models"
								item-text="model_name"
          						item-value="model_name"
								chips
								label="Models"
								deletable-chips
								multiple
								solo
							>
								<template
								slot="selection"
								slot-scope="{ item, index }"
								>
								<v-chip v-if="index === 0">
									<span>@{{ item.model_name }}</span>
								</v-chip>
								<span
									v-if="index === 1"
									class="grey--text caption"
								>(+@{{ form.unit_models.length - 1 }} others)</span>
								</template>
							</v-select>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
</div>