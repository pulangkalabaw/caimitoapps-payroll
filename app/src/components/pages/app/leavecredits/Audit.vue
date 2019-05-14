<template>
    <div>

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <div class="container">

                <!-- Fist card -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-default">
                            <div class="card-header">
                                <b>Leave Credit Auditrails</b>
                            </div>
                            <div class="card-body">
                                <b v-if="employee">{{ employee.fname + ' ' + employee.mname + ' ' + employee.lname }} <small><{{ employee.employee_code }}></small></b>
                                <span v-else><i class="fa fa-circle-o-notch fa-spin"></i></span>


                                <!-- Table -->
                                <div class="row  mt-4" v-if="employee">
                                    <div class="col-lg-12 table-responsive">
                                        <table class="table" v-if="audit">
                                            <thead class="text-white" style="background-color:#2A3F54;">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Leave Type</th>
                                                    <th>Credits Before (Hours)</th>
                                                    <th>Change (Hours)</th>
                                                    <th>Total (Hours)</th>
                                                    <th>Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody v-if="audit.data.length != 0">
                                                <tr v-for="aud in audit.data">
                                                    <td>{{ aud.created_at }}</td>
                                                    <td>{{ aud.leave.leave_code }}</td>
                                                    <td>{{ aud.credits_before }}</td>
                                                    <td>
                                                        <span v-if="aud.update_type == 'add'" class="fa fa-plus text-success"></span>
                                                        <span v-else class="fa fa-minus text-danger"></span>
                                                         {{ aud.credits }}
                                                     </td>
                                                     <td>
                                                         <b v-if="aud.update_type == 'add'">{{ aud.credits_before + aud.credits }}</b>
                                                         <b v-else>{{ aud.credits_before - aud.credits }}</b>
                                                     </td>
                                                    <td>{{ aud.reason }}</td>
                                                </tr>
                                            </tbody>
                                            <tbody v-else>
                                                <tr>
                                                    <td colspan="6">no data found</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- End of table -->


                                <div class="row">
                                    <div class="col-lg-12" v-if="audit">
                                        <pagination :data="audit" @pagination-change-page="getEdtr"></pagination>
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
                    {
                        'label': 'Leave History',
                        'route': 'leavecredit.audit',
                        'params': {user_id: this.$route.params.user_id}
                    },
                ],

                employee: '',

                audit: '',
            }
        },

        created(){
            this.getEmployee();
            this.getEdtr(this.$route.params.user_id);
        },

        methods:{


            getEmployee(){
                this.axiosRequest ('GET', this.$store.state.pis + 'employee/' + this.$route.params.user_id)
    			.then (res => {

    				this.employee = res.data.data.data
    				this.employees_loading = false

                    console.log(res);


    			})
    			.catch (err => {
    				console.log(err)
    				this.employees_loading = false
    			})
            },

            // getEmployee(){
            //     this.axiosRequest ('GET', this.$store.state.hl + 'leave_credit')
            //     .then (res => {
            //         this.employee = res.data.data.data.data[0]
            //         // this.employees_loading = false
            //     })
            //     .catch (err => {
            //         console.log(err)
            //         // this.employees_loading = false
            //     })
            // },

            getEdtr(page = 1){
                this.axiosRequest ('GET', this.$store.state.hl + 'leave_credit_audit/' + this.$route.params.user_id + '?page=' + page)
                .then (res => {
                    this.audit = res.data.data;
                    // this.employees_loading = false
                })
                .catch (err => {
                    console.log(err)
                    // this.employees_loading = false
                })
            }
        },

    }

</script>
