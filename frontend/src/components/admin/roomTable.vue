<template>
    <div>
        <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">All Rooms</h4> </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<div class="card card-table">
							<div class="card-body booking_card">
								<div class="table-responsive">
									<table class="datatable table table-stripped table table-hover table-center mb-0">
										<thead>
											<tr>
												<th>Room Name</th>
												<th>Room Type</th>
                                                <th>AC</th>
												<th>Food</th>
												<th>Charge for cancel</th>
												<th>Guest Allowed</th>
												<th>Rent</th>
												<th>Description</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="info in info" :key="info.id">
												<td>{{info.roomName}}</td>
												<td>
													{{info.roomType}}
                                                </td>
												<td>{{info.ac}}</td>
												<td>{{info.food}}</td>
												<td>{{info.cancelCharge}}</td>
												<td>{{info.numGuest}}</td>
												<td>{{info.rent}}</td>
												<td>{{info.description}}</td>
												<td class="text-right">
													<div class="dropdown dropdown-action"> <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v ellipse_color"></i></a>
														<div class="dropdown-menu dropdown-menu-right"> <a class="dropdown-item" href=""><i class="fas fa-pencil-alt m-r-5"></i> Edit</a> <a class="dropdown-item" href="#" data-toggle="modal" data-target="#delete_asset"><i class="fas fa-trash-alt m-r-5"></i> Delete</a> </div>
													</div>
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
						<div class="modal-body text-center"> <img src="assets/img/sent.png" alt="" width="50" height="46">
							<h3 class="delete_class">Are you sure want to delete this Asset?</h3>
							<div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
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
import axios from "axios"
export default {    
    name:'roomTable',
    created() {
        this.get();
    },
    data() {
        return {
            info:[],
        }
    },
    methods:{
        async get(){
            try {
                const ins= await axios.get('showroom');
                this.info=ins.data;
                
            } catch (error) {
                
            }
        }
    }
}       
</script>