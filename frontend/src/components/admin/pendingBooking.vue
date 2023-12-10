<template>
    <div>
        <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">Pending Booking</h4>
                               
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
												<th>User Name</th>
												<th>Rent</th>
												<th>Guest Number</th>
												<th>Time</th>
												<th>Arrival Date</th>
												<th>Depature Date</th>	
												<th>Status</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="info in info" :key="info.id">
                                                <td>{{info.roomName}}</td>
												<td>{{info.user_id}}</td>
												<td>{{info.rent}}</td>
												<td>{{info.guest}}</td>
                                                <td>{{info.time}}</td>
                                                <td>{{info.arrivalDate}}</td>
                                                <td>{{info.departureDate}}</td>
												<td>
													<div class="actions"> <a href="#" class="btn btn-sm bg-success-light mr-2">Active</a> </div>
												</td>
												<td class="text-right">
													<button class="btn btn-success" @click="showConfirmation(info.id)">Admit</button>
													<button class="btn btn-danger" @click="showDeleteModal(info.id)">Deny</button>
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
			<div id="delete_asset" class="modal fade delete-modal" role="dialog">
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
		<confirmation
		:show="showAccept"
		message="Are you sure you want to accept this booking?"
		@confirmed="confirmBooking"
		@canceled="cancelDialog"
		>
		</confirmation>

		<deleteModal
		:show="showDelete"
		message="Are you sure you want to deny this booking?"
		@confirmed="deletePending"
		@canceled="cancelDelete"
		>

		</deleteModal>


    </div>
</template>
<script>
import axios from 'axios';  
import confirmation from './adminConfirmation.vue';
import deleteModal from './delete.vue';
export default {
    name:'pendingBooking',
	components:{confirmation,deleteModal},
    created() {
        this.showPendingBooking();

    },
    data() {
        return {
            info:[],
			showDelete:false,
			currentBookingId: null,
			deleteID:null,
			showAccept:false,
        }
    },
    methods:{
        async showPendingBooking(){
            try {
                const ins=await axios.get('pending');
                this.info=ins.data;
				
            } catch (error) {
                
            }
        },
		async deletePending(){
			try {
				if (this.deleteID) {
					const ins= await axios.post(`delete-pending/${this.deleteID}`)
					this.showPendingBookings()
				}
			} catch (error) {
				console.error(error)
			}
			finally {
            this.showDelete = false; // Close the dialog after confirming or if an error occurs
        }
		},
        async confirmBooking(){
             try {
            if (this.currentBookingId) {
                const ins = await axios.post(`confirmed-booking/${this.currentBookingId}`);
                this.$emit('booking-confirmed');
                this.showPendingBooking();
            }
        } catch (error) {
            console.log(error);
        } finally {
            this.showDialog = false; // Close the dialog after confirming or if an error occurs
        }
        },
		cancelDialog() {
			this.showAccept = false;
		},
	showConfirmation(bookingId) {
		this.showAccept = true;
		this.currentBookingId=bookingId
    	},

	showDeleteModal(bookingId) {
		try {
		this.showDelete = true;
		this.deleteID=bookingId
		} catch (error) {
			console.log(error);
		}

    	},
	cancelDelete() {
			this.showDelete = false;
		},
		
    }
}
</script>