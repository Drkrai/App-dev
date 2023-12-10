<template>
    <div>
        <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="page-header">
					<div class="row align-items-center">
						<div class="col">
							<div class="mt-5">
								<h4 class="card-title float-left mt-2">All Amenities</h4> <a href="#" class="btn btn-primary float-right viewbutton" @click.prevent="showModal()">Add Amenities</a> </div>
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
										
												<th>Name Of Amenities</th>
												<th>Price</th>
												<th class="text-right">Actions</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="data in data" :key="data.amenities_id">
								
												<td>{{data.name}}</td>
												<td>{{data.price}}</td>
												<td><button type="submit" @click.prevent="showModal(info)">Update</button></td>
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
    <addAmenities
    :show="isVisible"
	@cancelled="closeAdd"
	@added="get"
    >

        </addAmenities>
</template>
<script>
import axios from 'axios';
import addAmenities from './addAmenities.vue';
export default {
    created() {
        this.get()
    },
    components: {
        addAmenities
    },
    data() {
        return {
            data:[],
            name:'',
            price:'',
            isVisible:false,
        }
    },
    methods: {
        async get(){
            const ins = await axios.get('get-amenities');
            this.data = ins.data;
        },
        async addAmenity(){
            await axios.post('add-amenity',{
                name:this.name,
                price:this.price,
            })
        },
        showModal(){
            this.isVisible=!this.isVisible;
        },
		closeAdd(){
			this.isVisible=false;
		}
    },
}
</script>