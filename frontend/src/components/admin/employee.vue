<template>
  <div>
    <div class="page-wrapper">
      <div class="content container-fluid">
        <div class="page-header">
          <div class="row align-items-center">
            <div class="col">
              <div class="mt-5">
                <h4 class="card-title float-left mt-2">Employee</h4>
                <a
                  href="add-employee.html"
                  class="btn btn-primary float-right veiwbutton"
                  >Add Employee</a
                >
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-12">
            <form>
              <div class="row formtype">
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Employee ID</label>
                    <input type="text" class="form-control" id="usr" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Employee Name</label>
                    <input type="text" class="form-control" id="usr1" />
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Role</label>
                    <select class="form-control" id="sel1" name="sellist1">
                      <option>Admin</option>
                      <option>Manager</option>
                      <option>Staff</option>
                      <option>Accountant</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label>Search</label>
                    <a
                      href="#"
                      class="btn btn-success btn-block mt-0 search_button"
                    >
                      Search
                    </a>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive">
                  <table class="datatable table table-stripped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Join Date</th>
                        <th>role</th>
                        <th class="text-right">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="info in info" :key="info.employee_id">
                        <td>{{info.name}}</td>
                        <td>
                          <a>{{info.email}}</a>
                        </td>
                        <td>{{info.phone_num}}</td>
                        <td>{{info.date_joined}}</td>
                        <td>
                          <span class="custom-badge status-green">{{info.role}}</span>
                        </td>
                      </tr>
                    </tbody>
                  </table>
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
                  <a href="#" class="btn btn-white" data-dismiss="modal"
                    >Close</a
                  >
                  <button type="submit" class="btn btn-danger">Delete</button>
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
    name:'employee',
    data() {
        return {
            info:[],
        }
    },
    created() {
        this.showEmployee()
    },
    methods: {
        async showEmployee(){
            try {
                const ins= await axios.get('show-employee')
                this.info=ins.data;
            } catch (error) {
                
            }
        }
    },
};
</script>

<style></style>
