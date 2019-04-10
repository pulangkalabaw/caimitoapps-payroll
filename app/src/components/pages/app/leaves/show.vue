<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <b>Leave Type Details</b>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col">
                                    <button v-if="isEditing == false" class="btn btn-info btn-sm" @click.prevent="isEditing ^= true; cancelEdit();">Edit leave type</button>
                                    <button v-else class="btn btn-warning btn-sm" @click.prevent="isEditing ^= true; cancelEdit();">Exit edit mode</button>
                                </div>
                                <div class="col text-right">
                                    <button class="btn btn-danger btn-sm" v-if="isEditing == true" @click.prevent="deleteLeave(leave.leave_id)">Remove Leave Type</button>
                                </div>
                            </div>
                            <!-- SHOW  -->
                            <div class="row" v-if="isEditing == false">
                                <div class="col-md-2">
                                    <b>Leave Code</b><br>
                                    <span><b>{{ leave.leave_code }}</b></span>
                                </div>
                                <div class="col-md-4">
                                    <b>Leave Name</b><br>
                                    <span>{{ leave.leave_name }}</span>
                                </div>
                                <div class="col-md-6">
                                    <b>Leave Description</b><br>
                                    <span v-if="leave.leave_description">{{ leave.leave_description }}</span>
                                    <span v-else>--</span>
                                </div>
                            </div>
                            <!-- EDIT  -->
                            <div class="row" v-else>
                                <div class="col-md-12 mb-4">
                                    <div class="alert alert-danger" v-if="notif">
                                        {{ notif }}
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <b>Leave Code</b><br>
                                    <input type="text" class="form-control form-control-sm" v-model="leave_code">
                                </div>
                                <div class="col-md-4">
                                    <b>Leave Name</b><br>
                                    <input type="text" class="form-control form-control-sm" v-model="leave_name">
                                </div>
                                <div class="col-md-6">
                                    <b>Leave Description</b><br>
                                    <input type="text" class="form-control form-control-sm" v-model="leave_description">
                                </div>

                                <div class="col-md-12 mt-4">
                                    <button class="btn btn-success btn-sm" @click.prevent="updateLeave(leave.leave_id)">Update & Save</button>
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
                        'label': 'Leaves',
                        'route': 'leaves.index',
                        'params': {}
                    },
                    {
                        'label': 'Show Leave',
                        'route': 'leaves.show',
                        'params': {}
                    }
                ],

                leave: '',
                isEditing: false,

                leave_code: '',
                leave_name: '',
                leave_description: '',

                notif: '',

            }
        },

        created(){
            this.getLeave();
        },

        methods:{

            getLeave(){
                this.axiosRequest ('GET', this.$store.state.hl + 'leave/' + this.$route.params.id)
    			.then (res => {

                    console.log(res);
                    if(res.data.status == 'success'){
                        this.leave = res.data.data;
                        this.notif = '';
                        // this.tnotif (res)
                    }else{
                        this.notif = res.data.errors
                        this.tnotif (res)
                    }

    			})
    			.catch (err => {
    				console.log(err)
    				// this.create_jobs_loading = false
    			})
            },

            updateLeave(leave_id){
                if(confirm('Updating this will affect all connected modules on leave. Do you still want to update the data?')){

                    let params = {
                        '_method': 'PUT',
                        'leave_code': this.leave_code,
                        'leave_name': this.leave_name,
                    }

                    this.axiosRequest ('POST', this.$store.state.hl + 'leave/' + leave_id, params)
        			.then (res => {

                        console.log(res);
                        if(res.data.status == 'success'){
                            this.notif = '';
                            this.tnotif (res)
                        }else{
                            this.notif = res.data.errors
                            this.tnotif (res)
                        }

        			})
        			.catch (err => {
        				console.log(err)
        				// this.create_jobs_loading = false
        			})
                }
            },

            cancelEdit(){
                this.leave_code = this.leave.leave_code;
                this.leave_name = this.leave.leave_name;
                this.leave_description = this.leave.leave_description;
            },

            deleteLeave(leave_id){
                if(confirm('Are you sure you want to remove this type of leave? this will affect all connected leave modules.')){

                    let params = {
                        '_method': 'DELETE',
                    }

                    this.axiosRequest ('POST', this.$store.state.hl + 'leave/' + leave_id, params)
        			.then (res => {

                        console.log(res);
                        if(res.data.status == 'success'){
                            this.notif = '';
                            this.tnotif (res)
                            this.redirect('leaves.index');
                        }else{
                            this.notif = res.data.errors
                            this.tnotif (res)
                        }

        			})
        			.catch (err => {
        				console.log(err)
        				// this.create_jobs_loading = false
        			})

                }
            },

        },

    }

</script>
