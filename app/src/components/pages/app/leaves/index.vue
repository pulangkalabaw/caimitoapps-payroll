<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <button class="btn btn-primary" @click.prevent="redirect('leaves.create')">Create Leave Type</button>

            <!-- List of Leave Type -->
            <div class="row mt-4">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <b>Leave Types</b>
                        </div>
                        <div class="card-body">

                            <div class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Leave Code</th>
                                        <th>Leave Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="leave in leaves" @click.prevent="redirect('leaves.show', {id: leave.leave_id})" style="cursor:pointer;">
                                        <td>{{ leave.leave_code }}</td>
                                        <td>{{ leave.leave_name }}</td>
                                    </tr>
                                </tbody>

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
                }
            ],

            leaves: '',
        }
    },

    created(){
        this.getLeaveTypes();
    },

    methods:{

        getLeaveTypes(){
            this.axiosRequest ('get', this.$store.state.hl + 'leave')
            .then (res => {

                this.leaves = res.data.data;
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
