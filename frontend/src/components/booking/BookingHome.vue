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
								<form action="#" class="booking_form" id="booking_form" @submit.prevent="savePendingBooking">
									<div class="d-flex flex-xl-row flex-column align-items-start justify-content-start">
										<div class="booking_input_container d-flex flex-row align-items-start justify-content-start flex-wrap">
											<div><input type="date" class="booking_input booking_input_a booking_in" placeholder="Check in" required="required" v-model="arrivalDate"></div>
											<div><input type="date" class="booking_input booking_input_a booking_out" placeholder="Check out" required="required" v-model="departureDate"></div>
											<div><input type="number" class="booking_input booking_input_b" placeholder="Children" required="required"></div>
											<div>
											<select class="booking_input booking_input_b" required="required" v-model="roomName">
												<option value="" disabled selected >Select Room</option>
												<option v-for="info in info" :key="info.id">{{info.roomName}}</option>
											</select>
											</div>
										</div>
										<div><button class="booking_button trans_200">Book Now</button></div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

    </div>
</template>
<script>
import axios from "axios";
export default {
    name:'BookingHome',
	data() {
		return {
			bookingOne:'booking.jpg',
			info:[],
			roomName:'',
			arrivalDate:'',
			departureDate:'',
		
		}
	},
	created() {
		this.get();
	},
	methods:{
		async get(){
            try {
                const ins= await axios.get('getRoom');
                this.info=ins.data;
            } catch (error) {
                
            }
        },
		async savePendingBooking(){
			try {
				const ins= await axios.post('bookRoom',{
					roomName:this.roomName,
					arrivalDate:this.arrivalDate,
					departureDate:this.departureDate
				});
			} catch (error) {
				
			}
		},
		async checkRoomName(){
			console.log(this.roomName)
		}

	}
}
</script>

<style lang="css">
	.booking_input_b option {
    color: #333; /* Change the color of the text */
    background-color: #fff; /* Change the background color */
    /* Add any other styles you want to apply to the options */
}
</style>
