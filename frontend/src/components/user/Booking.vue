<template>
  <div v-if="show" class="modal">
    <div class="modal-content user-bookings">
      <span class="close" @click="closeModal">&times;</span>
      <h2>Your Room Bookings</h2>
      <ul v-if="userBookings.length > 0">
        <li v-for="booking in userBookings" :key="booking.id">
          <strong>Room:</strong> {{ booking.roomName }} -
          <strong>Date:</strong> {{ booking.arrivalDate }} - {{ booking.departureDate }}
          <br><strong>Status:</strong> {{ booking.status}} 
          <br>
          <button @click="openModal('rate', booking.id)">Rate</button>
          <button @click="openModal('cancel', booking.id)">Cancel</button>
        </li>
      </ul>
      <p v-else>No bookings available.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      userBookings: [],
    };
  },
  props: {
    show: Boolean,
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
};
</script>
<style scoped>
/* Add styles for the modal */
.modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  justify-content: center;
  align-items: center;
  z-index: 1000;
}

.modal-content {
  background-color: #fff;
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.close {
  position: absolute;
  top: 10px;
  right: 10px;
  cursor: pointer;
}
</style>