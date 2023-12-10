<template>
  <div>
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col">
              <div class="mt-5">
                <h4 class="card-title float-left mt-2">All Rooms</h4>
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
                    @refresh="this.get"
                  >
                    <thead>
                      <tr>
                        <th>Booking ID</th>
                        <th>User Name</th>
                        <th>Transaction ID</th>
                        <th>Arrival Date</th>
                        <th>Departure Date</th>
                        <th>Total </th>
                        <th>Date Paid</th>
                      </tr>
                    </thead>
                    <tbody>
						
                      <tr v-for="info in info" :key="info.id">
                        <td>{{ info.booking_id }}</td>
                        <td>
                          {{ info.user_name }}
                        </td>
                        <td>{{ info.transaction_id }}</td>
                        <td>{{ info.arrivalDate }}</td>
                        <td>{{ info.departureDate }}</td>
                        <td>{{ info.total }}</td>
                        <td>{{ info.datePaid }}</td>
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
  name: "payment",
  created() {
    this.get();
  },
  data() {
    return {
      info: [],
	  modalData: {},
	  isVisible:false
    };
  },
  methods: {
    async get() {
      try {
        const ins = await axios.get("showpayment");
        this.info = ins.data;
	  }catch (error) {}
    },
  },
};
</script>