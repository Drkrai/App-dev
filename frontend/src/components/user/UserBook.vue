<template>
    <div>
    <div class="home">
					<div class="background_image" :style="{
      'background-image': 'url(' + require(`@/assets/images/${galleryOne}`) + ')'
  }"></div>
		<div class="home_container">
			<div class="container">
				<div class="row">
					<div class="col">
						<div class="home_content text-center">
							<div class="home_title">Your Bookings</div>
							<div class="booking_form_container">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


    <div class="user-bookings">
      <h2>Your Room Bookings</h2>
      <table v-if="userBookings.length > 0">
        <thead>
          <tr>
            <th>Room</th>
            <th>Date</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="booking in userBookings" :key="booking.id">
            <td>{{ booking.name }}</td>
            <td>{{ booking.arrivalDate }} - {{ booking.departureDate }}</td>
            <td>{{ booking.status }}</td>
            <td>
              <button @click="rateBooking(booking.id)">Rate</button>
              <button @click="openCancelModal(booking.id)">Cancel</button>
            </td>
          </tr>
        </tbody>
      </table>
      <p v-else>No bookings available.</p>
    </div>    
    
    <div v-show="showCancelModal" class="modal" @click="closeCancelModal">
      <div class="modal-content" @click.stop>
        <span class="close" @click="closeCancelModal">&times;</span>
        <h2>Cancel Booking</h2>
        <p>Are you sure you want to cancel this booking?</p>
        <label for="cancellationReason">Cancellation Reason:</label>
        <input type="text" id="cancellationReason" v-model="cancelReason">
        <button @click="cancelBookingConfirmed">Confirm</button>
      </div>
    </div>
    </div>
</template>
<script>
import axios from 'axios';
export default {
  data() {
    return {
      userBookings: [],
      galleryOne: 'contact.jpg',
      showCancelModal: false,
      bookingToCancel: null,
      cancelReason:''
    };
  },
  created() {
    const userId = localStorage.getItem('user_id');
    console.log(userId);
    axios
      .get(`getUserBookings/${userId}`)
      .then((response) => {
        this.userBookings = response.data;
      })
      .catch((error) => {
        console.error('Error fetching user bookings:', error);
      });
  },
  methods: {
        openCancelModal(bookingId) {
      this.showCancelModal = true;
      this.bookingToCancel = bookingId;
    },

    closeCancelModal() {
      this.showCancelModal = false;
      this.bookingToCancel = null;
    },

      closeCancelModalOutside(event) {
      const modalContent = document.querySelector('.modal-content');
      if (modalContent && !modalContent.contains(event.target)) {
        this.closeCancelModal();
      }
    },

  async cancelBookingConfirmed() {
    try {
      if (this.bookingToCancel !== null) {
        const userId = localStorage.getItem('user_id');
        const booking = this.bookingToCancel; 
        const cancellationData = {
          user_id: userId,
          booking_id: booking,
          reason: this.cancelReason,
        };
        console.log(cancellationData)
        const response = await axios.post('cancel-booking', cancellationData);

        console.log(response.data);
        this.closeCancelModal();
      } else {
        console.error('Invalid cancellation details');
      }
    } catch (error) {
      console.error('Error cancelling booking:', error);
    }
  },


    
  },
};
</script>

<style scoped>
.user-bookings {
  background-color: #f0f0f0;
  padding: 20px;
  margin: 20px;
  border-radius: 5px;
}

h2 {
  color: #333;
  font-size: 24px;
  font-weight: bold;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 10px;
}

th, td {
  border: 1px solid #ddd;
  padding: 10px;
  text-align: left;
  font-size: 14px;
}

th {
  background-color: #f2f2f2;
}

button {
  padding: 5px 10px;
  margin: 2px;
  font-size: 14px;
  cursor: pointer;
}

button:hover {
  background-color: #ffa37b;
}

p {
  font-style: italic;
  color: #777;
  font-size: 14px;
}
.modal {
  display: block; /* Change 'none' to 'block' */
  position: fixed;
  z-index: 1;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
}

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 60%;
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
