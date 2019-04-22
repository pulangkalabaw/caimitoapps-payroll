<template>
    <div class="">

		<navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

		<div id="content">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <button class="btn btn-primary btn-sm btn-tunch"><span class="fa fa-plus-circle"></span> Add new leave type</button>
                    <button class="btn btn-sm btn-tunch-default" @click.prevent="redirect('leavecredit.index')"><span class="fa fa-th-list"></span> View all leave credits</button>
                </div>
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <span class="fa fa-folder"></span> Assign Leave Credits
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- Left side  -->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-danger" v-if="notif">
                                                <span>{{ notif.message }}<br></span>                                                
                                                <span v-for="err in notif.errors">{{ err }}<br></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">Select Leave <span class="text-danger">*</span></div>
                                        <div class="col-md-8 mb-4"><select class="form-control form-control-sm" v-model="leave_id">
                                            <option value="">--select leave--</option>
                                            <option v-for="leave in leaves" :value="leave.leave_id">{{ leave.leave_name }} (<small>{{ leave.leave_code }}</small>)</option>
                                        </select></div>
                                        <div class="col-md-4">Leave Credit <span class="text-danger">*</span></div>
                                        <div class="col-md-8 mb-4"><input type="number" class="form-control form-control-sm" v-model="credits"></div>
                                        <div class="col-md-4">Employee <span class="text-danger">*</span></div>
                                        <div class="col-md-8">
                                            <span v-for="emp,index in collect_users">{{ emp.fname + ' ' + emp.mname + ' ' + emp.lname }}<b v-if="index < collect_users.length - 1">, </b></span><br>
                                            <small class="span-link text-dark" @click.prevent="selectEmployees()"><i><u>{{ ((isSelectingEmp == false) ? ('Select employee') : ('Done selecting')) }}</u></i></small>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 text-right">
                                            <button class="btn btn-success btn-sm" @click="assignLeaveCredit()">Submit <i class="fa fa-cog"></i></button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Right Side -->
                                <div class="col-md-6" v-if="isSelectingEmp == true">
                                    <div class="row">
                                        <div class="col-md-12" style="padding: 30px; background: rgba(0, 0, 0, 0.09);">
                                            {{ collected_user_ids }}
                                            <input @keyup="filterEmployees(valuesearch)" v-model="valuesearch" type="text" class="form-control form-control-sm" placeholder="Search employee"><br>
                                            <span v-for="emp in employees_filtered" v-if="employees_filter_show == true">
                                                <input @click="collectEmployees(emp)" type="checkbox"><span> {{ emp.employee_code }} {{ emp.fname + ' ' + emp.mname + ' ' + emp.lname }}</span> &nbsp;
                                            </span>
                                        </div>

                                    </div>
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

    export default{

        data(){
            return{
                links: [
                    {
                        'label': 'Leave Credits',
                        'route': 'leavecredit.index',
                        'params': {}
                    },
                ],

                isSelectingEmp: false,
                notif: '',

                valuesearch: '',

                leaves: '',
                leave_id: '',
                credits: '',
                employees: '',
                employees_filtered: '',
                employees_filter_show: false,
                collect_users: [],
            }
        },

        computed: {
            collected_user_ids: function(){
                return this.collect_users.map(val => val.user_id);
            }
        },

        created(){
            this.employeesIndex();
            this.leaveIndex();
        },

        methods:{
            selectEmployees(){
                this.isSelectingEmp ^= true;
            },

            filterEmployees(value){
                if(value == '' || value == undefined){
                    this.employees_filter_show = false;
                }else{
                    this.employees_filter_show = true;
                }
                this.employees_filtered = this.employees.data;
                this.employees_filtered = this.employees_filtered.filter(val => {
                    if(val.fname.toLowerCase().includes(value.toLowerCase()) || val.mname.toLowerCase().includes(value.toLowerCase()) || val.lname.toLowerCase().includes(value.toLowerCase())){
                        return val;
                    }else if(val.employee_code.toLowerCase().includes(value.toLowerCase())){
                        return val;
                    }
                });
            },

            employeesIndex () {

    			this.index_employees_loading = true
    			this.axiosRequest ('GET', this.$store.state.pis + 'employee?filter=all')
    			.then (res => {
    				this.employees = res.data.data
    				this.employees_filtered = this.employees.data
    				this.index_employees_loading = false
    			})
    			.catch (err => {
    				console.log(err)
    				this.index_employees_loading = false
    			})

    		},

            collectEmployees(value){
                if(this.collect_users.find(val => val.user_id == value.user_id)){
                    this.collect_users.splice(this.collect_users.findIndex(val => val.user_id == value.user_id), 1);
                }else{
                    this.collect_users.push(value);
                }
            },

            assignLeaveCredit(){
                let params = {
                    user_id: this.collected_user_ids,
                    leave_id: this.leave_id,
                    credits: this.credits,
                }
                console.log(params);

                this.axiosRequest ('POST', this.$store.state.hl + 'leave_credit', params)
    			.then (res => {
    				// this.index_employees_loading = false
                    if(res.data.status == 'success'){

                    }else{
                        this.notif = res.data;
                    }
                    console.log({assignleave: res});
    			})
    			.catch (err => {
    				console.log(err)
    				// this.index_employees_loading = false
    			})

            },

            leaveIndex(){

                this.axiosRequest ('GET', this.$store.state.hl + 'leave')
    			.then (res => {
    				this.leaves = res.data.data
    				// this.index_employees_loading = false
    			})
    			.catch (err => {
    				console.log(err)
    				// this.index_employees_loading = false
    			})

            }
        },
    }

</script>
