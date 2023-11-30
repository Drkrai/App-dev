<template>
    <div>
        <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">Appointments</h4>
                               
                            </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
												<th>Room Name</th>
												<th>Rent</th>
												<th>Guest Number</th>
												<th>Time</th>
												<th>Arrival Date</th>
												<th>Depature Date</th>

											</tr>
										</thead>
										<tbody>
											<tr v-for="inf in inf" :key="inf.id">
												<td>{{inf.name}}</td>
												<td>{{inf.rent}}</td>
												<td>{{inf.guest}}</td>
                                                <td>{{inf.time}}</td>
                                                <td>{{inf.arrivalDate}}</td>
                                                <td>{{inf.departureDate}}</td>
												<td>
													<button type="button" class="btn btn-primary" @click="showModal(inf.id)">Payment</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="delete_asset" class="modal fade delete-modal" role="dialog" >
				<div class="modal-dialog modal-dialog-centered">
					<div class="modal-content">
						<div class="modal-body text-center"> <img src="assets/img/sent.png" alt="" width="50" height="46">
							<h3 class="delete_class">Are you sure want to delete this Asset?</h3>
							<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
								<button type="submit" class="btn btn-danger">Delete</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		 <div class="custom-modal" v-if="showPayment">
      <div class="modal-overlay" @click="closePaymentModal"></div>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Payment</h4>
          <button type="button" class="close" @click="closePaymentModal">&times;</button>
        </div>
        <div class="modal-body">
          <form>
          <div v-if="pay">
            <h5>Room Name: {{ pay.name }}</h5>
            <p>Guest: {{ pay.guest }}</p>
            <p>Arrival Date: {{ pay.arrivalDate }}</p>
            <p>Departure Date: {{ pay.departureDate }}</p>
			<div v-if="pay.amenities && pay.amenities.length > 0">
			<div v-for="(amenity, index) in pay.amenities" :key="index" class="form-check">
				<input type="checkbox" class="form-check-input" :id="`amenityCheckbox${index}`" :value="amenity" v-model="pay.selectedAmenities">
				<label class="form-check-label" :for="`amenityCheckbox${index}`">{{ amenity }}</label>
			</div>
			</div>


            <label for="total">Total:</label>
            <span>{{pay.rent}}</span>
          </div>
        </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="closePaymentModal">Close</button>
          <button type="button" class="btn btn-primary">Submit Payment</button>
        </div>
      </div>
    </div>


	</div>
</template>
<script>
import axios from "axios";
export default {
    name:'booking',
	created() {
		this.get();
	},
	data() {
		return {
			inf:[],
			pay: {
        name: '',
        guest: '',
        arrivalDate: '',
        departureDate: '',
        amenities: [],
        rent: '',
        selectedAmenities: []
      },
	  showPayment: false
		}
	},
	methods: {
		async get(){
			try {
				const ins = await axios.get('get-booking')
			this.inf= ins.data
			} catch (error) {
				error
			}
			
		},

		async showModal(id){
    try {
        const ins = await axios.get(`payment/${id}`);
        console.log('Amenities data from server:', ins.data.amenities);

        const amenitiesString = ins.data.amenities || "[]"; // Provide a default value if amenities is undefined
        const amenities = JSON.parse(amenitiesString);

        this.pay = { ...ins.data, amenities, selectedAmenities: [] };
        this.showPayment = !this.showPayment;
    } catch (error) {
        console.error('Error fetching amenities:', error);
    }
},
		closePaymentModal() {
        this.showPayment = false;
    }
	
	},
}
</script>
<style scoped>
.custom-modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1000;
}

.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  z-index: 1001;
}

.modal-content {
  background: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  z-index: 1002;

  /* Adjust the maximum width and center the modal horizontally */
  max-width: 400px;
  margin: 0 auto;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
}

.modal-title {
  margin: 0;
}

.modal-body {
  /* Your custom styles for the modal body */
}

.modal-footer {
  display: flex;
  justify-content: flex-end;
  margin-top: 10px;
}
</style>
