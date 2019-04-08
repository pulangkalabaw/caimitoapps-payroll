<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <!-- Leave Create Form -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            Create Leave Type
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label for=""><b>Leave Code</b></label>
                                    <input type="text" v-model="leave_code" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for=""><b>Leave Name</b></label>
                                    <input type="text" v-model="leave_name" class="form-control">
                                </div>
                                <div class="col">
                                    <label for=""><b>Leave Description</b></label>
                                    <input type="text" v-model="leave_desc" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <br>
                                    <button class="btn btn-success btn-sm" @click.prevent="createLeave()"> Add Leave Type</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of create leave form -->

        </div>

    </div>
</template>

<script>

    export default{

        data(){
            return{
                leave_code: '',
                leave_name: '',
                leave_desc: '',
                links: [
                    {
                        'label': 'Leaves',
                        'route': 'leaves.index',
                        'params': {}
                    },
                    {
                        'label': 'Create Leave Type',
                        'route': 'leaves.create',
                        'params': {}
                    }
                ]
            }
        },

        methods:{

            createLeave(){
                let params = {
                    leave_code: this.leave_code,
                    leave_name: this.leave_name,
                    leave_desc: this.leave_desc,
                };

                this.axiosRequest ('POST', this.$store.state.pis + 'leave', params)
    			.then (res => {

                    console.log(res);

    				// this.notif = res.data
    				// this.tnotif (res)
    				// this.employees  = res.data.data.data
    				// this.create_jobs_loading = false

    			})
    			.catch (err => {
    				console.log(err)
    				// this.create_jobs_loading = false
    			})
            },

        },

    }

</script>
