<template>
    <div v-if="show" title="Modal title" @hidden="closeModal">
		<div class="modal-overlay">
			<div class="modal-container">
				<div class="modal-header">
				<div class="modal-body">
        <!-- Amenity Form -->
        <form @submit.prevent="addAmenity">
          <div class="mb-3">
            <label for="amenityName" class="form-label">Name:</label>
            <input type="text" class="form-control" id="amenityName" placeholder="Enter Amenity Name" v-model="name" required>
          </div>
          <div class="mb-3">
            <label for="amenityPrice" class="form-label">Price:</label>
            <input type="number" class="form-control" id="amenityPrice" placeholder="Enter Amenity Price" v-model="price" required>
          </div>
          <button type="submit" class="btn btn-primary">Add Amenity</button>
          <button type="button" class="btn btn-primary" @click="cancel">Close</button>
        </form>
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
            name:'',
            price:'',
        }
    },
	props:{
		show:Boolean,
	},
    methods: {
        async addAmenity(){
            await axios.post('add-amenity',{
                name:this.name,
                price:this.price,
            })
            this.$emit('added');
            this.$emit('cancelled');
        },
		cancel(){
			this.$emit('cancelled')
		}
    },
}
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

