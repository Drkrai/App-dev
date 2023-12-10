<template>
  <div>
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col">
              <div class="mt-5">
                <h4 class="card-title float-left mt-2">All Cancellation</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card card-table">
              <div class="card-body booking_card">
                <div class="table-responsive">
                  <table
                    class="datatable table table-stripped table table-hover table-center mb-0"
                  >
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <th>User</th>
                        <th>Reason</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="data in data" :key="data.id">
                        <td>{{ data.booking_id }}</td>
                        <td>{{ data.user_name }}</td>
                        <td>{{ data.reason }}</td>
                        <td>
                          <button
                            type="button"
                            class="btn btn-primary"
                            @click="acceptCancel(data.booking_id)"
                          >
                            Accept
                          </button>
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
            <div class="modal-body text-center">
              <img src="assets/img/sent.png" alt="" width="50" height="46" />
              <h3 class="delete_class">
                Are you sure want to delete this Asset?
              </h3>
              <div class="m-t-20">
                <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                <button type="submit" class="btn btn-danger">Delete</button>
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
  created() {
    this.get();
  },
  components: {},
  data() {
    return {
      data: [],
      name: "",
      price: "",
      isVisible: false,
      cancelBooking:'Cancelled'
    };
  },
  methods: {
    async get() {
      const ins = await axios.get("get-cancel");
      this.data = ins.data;
    },
    async acceptCancel(id){
        try {
            await axios.post(`booking-cancel/${id}`,this.cancelBooking)
        } catch (error) {
            
        }
    }
    ,
    showModal() {
      this.isVisible = !this.isVisible;
    },
    closeAdd() {
      this.isVisible = false;
    },
  },
};
</script>
