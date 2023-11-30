<template>
    <div>
        <div class="booking">
		<div class="container">
			<div class="row">
				<div class="col">

					<!-- Booking Slider -->
					<div class="booking_slider_container">
						<div class="owl-carousel owl-theme booking_slider">						
							<!-- Slide -->
							<div class="booking_item" v-for="info in info" :key="info.id">
								<div class="background_image" :style="{
      'background-image': 'url(' + require(`@/assets/images/${bookingOne}`) + ')'
  }"></div>
								<div class="booking_overlay trans_200"></div>
								<div class="booking_item_content">
									<div class="booking_item_list">
										<ul>
											<li>{{info.description}}</li>
											<li>{{info.food}}</li>
											<li>{{info.ac}}</li>
											<li>{{info.roomType}}</li>
										</ul>
									</div>
								</div>
								<div class="booking_price">₱{{info.rent}}</div>
								<div class="booking_link"><a href="booking.html">{{info.roomName}}</a></div>
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
import axios from 'axios';
export default {
    name:'Mainbooking',
    data() {
        return {
            bookingOne:'booking_1.jpg',
            bookingTwo:'booking_2.jpg',
            bookingThree:'booking_3.jpg',
			info:[],
        }
    },
	created() {
			this.get()
		},
	methods: {
		 async get(){
            try {
                const ins= await axios.get('showRoom');
                this.info=ins.data;
                
            } catch (error) {
                
            }
        }
	},
}
</script>