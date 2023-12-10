<template>
    <div>
    <div v-if="show" title="Modal title" @hidden="closeModal">
		<div class="modal-overlay">
			<div class="modal-container">
				<div class="modal-header">
				<div class="modal-body">
      <form @submit.prevent="update(data.id)">
              <div class="row formtype">
								<div class="col-md-4">
									<div class="form-group">
										<label>Room Number</label>
										<input class="form-control" type="text" v-model="data.roomName"> 
										</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Room Type</label>
										<select class="form-control" id="sel1" name="sellist1" v-model="data.roomType">
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
										<select class="form-control" id="sel2" name="sellist1" v-model="data.ac">
											<option>Select</option>
											<option>AC</option>
											<option>NON-AC</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label>Food</label>
										<select class="form-control" id="sel3" name="sellist1" v-model="data.food">
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
										<select class="form-control" id="sel" name="sellist1" v-model="data.numGuest">
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
										<select class="form-control" id="sel4" name="sellist1" v-model="data.cancelCharge">
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
										<input type="text" class="form-control" id="usr" v-model="data.rent"> </div>
								</div>
						
								<div class="col-md-4">
									<div class="form-group">
										<label>Description</label>
										<textarea class="form-control" rows="5" id="comment" name="text" v-model="data.description"></textarea>
									</div>
								</div>
							</div>
							<button type="submit" class="btn btn-primary buttonedit ml-2" >Save</button>
							<button class="btn btn-primary buttonedit" @click="cancel" >Cancel</button>
						</form>
				</div>
				</div>
			</div>
	</div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
   data() {
        return {
            data:{
                ...this.modalData
            },
        }
    },
	props: {
    modalData: Object,
    show:Boolean,
  },
    watch: {
    modalData(newModalData) {
      this.data = { ...newModalData };
    }
	},
  methods: {
    async update(id) {
      try {
		const ins = await axios.post(`update-room/${id}`,this.data)
		 this.$emit('update');
		this.$emit('close')
	  } catch (error) {
		
	  }
    },
    cancel() {
      this.$emit('cancelled');
    },
  },
};
</script>
<style scoped>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  z-index: 1000;
}

.modal-container {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #fff;
  padding: 20px;
  z-index: 1001;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
}

.modal-content {
  text-align: center;
}
</style>

