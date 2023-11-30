<template>
    <div>
        		<div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<h3 class="page-title mt-5">Add Room</h3> </div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<form @submit.prevent="save">
							<div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>Room Number</label>
										<input class="form-control" type="text" v-model="roomName"> 
										</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Room Type</label>
										<select class="form-control" id="sel1" name="sellist1" v-model="roomType">
											<option>Select</option>
											<option>Single</option>
											<option>Double</option>
											<option>Quad</option>
											<option>King</option>
											<option>Suite</option>
											<option>Villa</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>AC/NON-AC</label>
										<select class="form-control" id="sel2" name="sellist1" v-model="ac">
											<option>Select</option>
											<option>AC</option>
											<option>NON-AC</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Food</label>
										<select class="form-control" id="sel3" name="sellist1" v-model="food">
											<option>Select</option>
											<option>Free Breakfast</option>
											<option>Free Lunch</option>
											<option>Free Dinner</option>
											<option>Free Breakfast & Dinner</option>
											<option>Free Welcome Drink</option>
											<option>No Free Food</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Bed Count</label>
										<select class="form-control" id="sel" name="sellist1" v-model="numGuest">
											<option>Select</option>
											<option>1</option>
											<option>2</option>
											<option>3</option>
											<option>4</option>
											<option>5</option>
											<option>6</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Charges For cancellation</label>
										<select class="form-control" id="sel4" name="sellist1" v-model="cancelCharge">
											<option>Select</option>
											<option>Free</option>
											<option>5% Before 24Hours</option>
											<option>No Cancellation Allow</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Rent</label>
										<input type="text" class="form-control" id="usr" v-model="rent"> </div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="5" id="comment" name="text" v-model="description"></textarea>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="towelCheckbox" v-model="amenities.towel">
											<label class="form-check-label" for="towelCheckbox">Towel</label>
										</div>
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="toothbrush" v-model="amenities.toothbrush">
											<label class="form-check-label" for="toothbrush">Toothbrush</label>
										</div>
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="facetowel" v-model="amenities.faceTowel">
											<label class="form-check-label" for="facetowel">Face Towel</label>
										</div>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary buttonedit ml-2">Save</button>
							<button type="button" class="btn btn-primary buttonedit">Cancel</button>
						</form>
					</div>
				</div>
				
			</div>
		</div>
    </div>
</template>
<script>
import axios from "axios"
export default {
    name:'addRoom',
	data() {
		return {
			roomName:'',
			roomType:'',
			ac:'',
			food:'',
			cancelCharge:'',
			numGuest:'',
			rent:'',
			description:'',
			amenities:{
				towel:false,
				toothbrush:false,
				faceTowel:false,
				handTowel:false,
			}
		}
	},
	methods: {
		async save(){
			try {
				const ins=await axios.post('save',{
					roomName:this.roomName,
					roomType:this.roomType,
					ac:this.ac,
					food:this.food,
					cancelCharge:this.cancelCharge,
					numGuest:this.numGuest,
					rent:this.rent,
					description:this.description,
					amenities:this.amenities
				});
				this.roomName="";
				this.roomType="";
				this.ac="";
				this.food="";
				this.cancelCharge="";
				this.numGuest="";
				this.rent="";
				this.description="";
			} catch (error) {
				
			}
		}
	},
}
</script>