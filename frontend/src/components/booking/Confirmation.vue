<template>
  <div v-if="show">
    <div class="modal-overlay"></div>
    <div class="modal-container">
      <div class="modal-content">
        <p class="confirmation-message">{{ message }}</p>
        <p>You're Booking Details:</p>
        <div v-if="selectedOptions" class="selected-options">
          <p>Date: {{ selectedOptions.arrivalDate }} - {{ selectedOptions.departureDate }}</p>
          <p>Guests: {{ selectedOptions.guest }}</p>
          <p>Room: {{ selectedOptions.roomName }}</p>
          <p>Rent: {{ selectedOptions.rent }}</p>
        </div>
        <div class="button-container">
          <button class="confirm-button" @click="confirm">Yes</button>
          <button class="cancel-button" @click="cancel">No</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  created() {
    console.log('selectedOptions:', this.selectedOptions);
  },
  props: {
    show: Boolean,
    message: String,
    selectedOptions: Object,
  },
  methods: {
    confirm() {
      this.$emit('confirmed');
    },
    cancel() {
      this.$emit('canceled');
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

.confirmation-message {
  font-size: 18px;
  font-weight: bold;
  color: #6d6d6d;
  margin-bottom: 20px;
}

.button-container {
  display: flex;
  justify-content: center;
}

.confirm-button,
.cancel-button {
  margin: 5px;
  padding: 10px 20px;
  font-size: 16px;
  cursor: pointer;
}

.confirm-button {
  background-color: #ffa07f;
  color: #fff;
  border: none;
}

.cancel-button {
  background-color: #eee;
  color: #333;
  border: none;
}

.confirm-button:hover {
  background-color: #ff824a;
}

.cancel-button:hover {
  background-color: #ccc;
}
</style>
