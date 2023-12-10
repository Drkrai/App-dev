<template>
    <div>
        	<div class="home">
		<div class="background_image" :style="{
      'background-image': 'url(' + require(`@/assets/images/${bookingOne}`) + ')'
  }"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
							<div class="home_title">Book a room</div>
							<div class="booking_form_container">
								<form action="#" class="booking_form" id="booking_form" @submit.prevent="showConfirmationDialog">
									<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
										<div class="booking_input_container d-flex flex-row align-items-start justify-content-start flex-wrap">
											<div><input type="date" class="booking_input booking_input_a booking_in" placeholder="Check in" required="required" v-model="arrivalDate"></div>
											<div><input type="date" class="booking_input booking_input_a booking_out" placeholder="Check out" required="required" v-model="departureDate"></div>
											<div><input type="number" class="booking_input booking_input_b" placeholder="Guest Number" required="required" v-model="guest"></div>
												<div>
												<select class="booking_input booking_input_b" required="required" v-model="roomName" @change="updateRent">
													<option value="" disabled selected >Select Room</option>
													<option v-for="info in info" :key="info.id">{{info.roomName}}</option>
												</select>
												</div>
											<div><input type="hidden" v-model="rent"></div>
											
										</div>
										<div v-if="isLoggedIn"><button class="booking_button trans_200">Book Now</button></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<confirmation
		:show="showDialog"
      message="Are you sure you want to book?"
	  :selectedOptions="selectedOptions"
      @confirmed="savePendingBooking"
      @canceled="cancelBooking"
	>
	</confirmation>
    </div>
</template>
<script>
import axios from "axios";
import Confirmation from './Confirmation.vue';
import {showNotification} from '../Notification';
export default {
    name:'BookingHome',
	components: {Confirmation},
	data() {
		return {
			bookingOne:'booking.jpg',
			info:[],
			roomName:'',
			arrivalDate:'',
			departureDate:'',
			guest:'',
			rent:'',
			showDialog:false,
			selectedOptions:{
				arrivalDate: '',
				departureDate: '',
				guest: '',
				roomName: '',
				rent: '',
			},
			isLoggedIn:false
		}
	},
	created() {
		this.get();
    	this.isLoggedIn = localStorage.getItem("user_id") !== null;
	},
	methods:{
		showConfirmationDialog() {
			this.selectedOptions={roomName:this.roomName,arrivalDate:this.arrivalDate,departureDate:this.departureDate,guest:this.guest,rent:this.rent}
	  console.log('Selected Options:', this.selectedOptions);
      this.showDialog = true;
    	},
		async get(){
            try {
                const ins = await axios.get('showroom');
				this.info = ins.data.filter(room => room.status === 'Active').map(room => ({
				roomName: room.roomName,
				rent: room.rent,

			}));
            } catch (error) {
                
            }
        },
		async savePendingBooking(){
			this.showDialog=false;
			try {
				const userId = localStorage.getItem('user_id');
				const ins= await axios.post('bookRoom',{
					roomName:this.roomName,
					arrivalDate:this.arrivalDate,
					departureDate:this.departureDate,
					guest:this.guest,
					rent:this.rent,
					user_id:userId
					
				}
				);
				    this.roomName = '';
					this.arrivalDate = '';
					this.departureDate = '';
					this.guest = '';
					this.rent = '';
				showNotification('Reservation successful', 'success');
			} catch (error) {
				
			}
		
		},
		cancelBooking() {
      this.showDialog = false;
    },
		updateRent() {
            const selectedRoom = this.info.find(room => room.roomName === this.roomName);
            if (selectedRoom) {
                this.rent = selectedRoom.rent; 
            }
		},
}
}
</script>

<style lang="css">
	.booking_input_b option {
    color: #333; 
    background-color: #fff;
}
</style>