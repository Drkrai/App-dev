<template>
    <div>
      <div class="main-wrapper">
        <admin-header/>
        <div class="sidebar" id="sidebar">
			<div class="sidebar-inner slimscroll">
				<div id="sidebar-menu" class="sidebar-menu">
					<ul >
						<li class="active"> <a @click.prevent="showComponent('adminMain')"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a> </li>
						<li class="list-divider"></li>
						<li class="submenu"> <a href=""><i class="fas fa-suitcase"></i> <span> Booking </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li > 
                  <a href="" @click.prevent="showComponent('booking')">All Bookings</a>
                  <a href="" @click.prevent="showComponent('pendingBooking')">Pending Bookings</a>
                  <a href="" @click.prevent="showComponent('cancel')">Cancellations</a>
								</li>
							</ul>
						</li>
						<li class="submenu" > <a href="#"><i class="fas fa-key" ></i> <span> Rooms </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="" @click.prevent="showComponent('roomTable')">All Room</a></li>
								<li><a href="" @click.prevent="showComponent('addRoom')">Add Room</a></li>
							</ul>
						</li>
            <li class="submenu" > <a href="#"><i class="fas fa-archive" ></i> <span> Amenities </span> <span class="menu-arrow"></span></a>
							<ul class="submenu_class" style="display: none;">
								<li><a href="" @click.prevent="showComponent('amenities')">All Amenities</a></li>
							</ul>
						</li>
						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Employees </span> <span class="menu-arrow"></span></a>
            <ul class="submenu_class" style="display: none;">
								<li><a href="" @click.prevent="showComponent('employee')">List of Employees </a></li>
                <li><a href="" @click.prevent="showComponent('addEmployee')">Add Employees </a></li>
							</ul>
						</li>
            						<li class="submenu"> <a href="#"><i class="fas fa-user"></i> <span> Payment </span> <span class="menu-arrow"></span></a>
            <ul class="submenu_class" style="display: none;">
								<li><a href="" @click.prevent="showComponent('payment')">Payment </a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		    </div>
        <admin-main v-if="selectedComponent==='adminMain'"/>
        <add-room v-if="selectedComponent==='addRoom'"/>
        <room-table v-if="selectedComponent==='roomTable'"/>
        <booking v-if="selectedComponent==='booking'"/>
        <pending-booking v-if="selectedComponent==='pendingBooking'"/>
        <employee v-if="selectedComponent==='employee'"/>
        <add-employee v-if="selectedComponent==='addEmployee'"/>
        <amenities v-if="selectedComponent==='amenities'"/>
        <cancel v-if="selectedComponent==='cancel'"/>
        <payment v-if="selectedComponent==='payment'"/>
      </div>
    </div>
</template>
<script>

import {ref} from 'vue';
import { onMounted } from 'vue'
import adminMain from '@/components/admin/adminMain.vue';
import adminSide from '@/components/admin/adminSide.vue';
import adminHeader from '@/components/admin/adminHeader.vue';
import addRoom from '@/components/admin/addRoom.vue';
import roomTable from '@/components/admin/roomTable.vue';
import booking from '@/components/admin/booking.vue';
import pendingBooking from '@/components/admin/pendingBooking.vue';
import employee from '@/components/admin/employee.vue';
import addEmployee from '@/components/admin/addEmployee.vue';
import amenities from '@/components/admin/amenities.vue';
import cancel from '@/components/admin/cancel.vue';
import payment from '@/components/admin/payment.vue';
export default {
    name:'Admin',
    components:{adminMain,adminSide,adminHeader,addRoom,roomTable,booking,pendingBooking,employee,addEmployee,amenities,cancel,payment},
      data() {
        return {
          selectedComponent: "adminMain"
        }
      },
    methods: {
      showComponent(componentName) {
      this.selectedComponent=componentName;
}
    },
  setup() {
    async function loadScript(src) {
      return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.onload = resolve;
        script.onerror = reject;
        document.head.appendChild(script);
      });
    }

    async function loadScriptsInOrder(scriptUrls) {
      for (const url of scriptUrls) {
        await loadScript(url);
      }
    }

    onMounted(async () => {
      await loadScriptsInOrder([
          '/js/adminJs/jquery-3.5.1.min.js' ,
          '/js/adminJs/popper.min.js',
          '/js/adminJs/bootstrap.min.js',
          '/js/adminJs/slimscroll/jquery.slimscroll.min.js',
          '/js/adminJs/raphael/raphael.min.js',
          '/js/adminJs/script.js',
          '/js/adminJs/moment.min.js',
          '/js/adminJs/select2.min.js',
      ]);
    });

  },
};
</script>
<style lang="css">
  @import '@/assets/admin/css/bootstrap.min.css';
  @import '@/assets/admin/css/bootstrap.min.css';
  @import '@/assets/admin/plugins/fontawesome/css/fontawesome.min.css';
  @import '@/assets/admin/plugins/fontawesome/css/all.min.css';
  @import '@/assets/admin/css/feathericon.min.css';
  @import '@/assets/admin/plugins/morris/morris.css';
  @import '@/assets/admin/css/style.css';
</style>
