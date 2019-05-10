<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <!-- Modal for update leave -->
            <div class="modal" tabindex="-1" role="dialog" >
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <notif :notif="notif"></notif>
                      <div class="clearfix"></div>
                      <label for=""><b>{{ modal_data.fname + ' ' + modal_data.mname + ' ' + modal_data.lname }} <small><{{ modal_data.employee_code }}></small></b></label>
                      <div class="row">
                          <div class="col-md-5">
                              <small class="font-weight-bold"><label for="">Leave credit to {{ typeofupdate }}</label></small>
                              <input type="number" v-model="credit" class="form-control form-control-sm" placeholder="In hours e.g 8.00">
                          </div>
                          <div class="col-md-12">
                              <small class="font-weight-bold"><label for="">Reason for updating leave</label></small>
                              <textarea type="number" v-model="reason" class="form-control form-control-sm" placeholder="Reason"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                        <button type="button" class="btn btn-success btn-sm" @click="doUpdateCredit(modal_data, credit,typeofupdate, reason)" v-if="typeofupdate == 'add'">Add and update</button>
                        <button type="button" class="btn btn-danger btn-sm" @click="doUpdateCredit(modal_data, credit,typeofupdate, reason)" v-else>Subtract and update</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>


            <!-- Start of the real content  -->
            <div class="row">
                <div class="col-md-2">
                    <!-- <button class="btn btn-primary btn-sm btn-tunch" @click.prevent="redirect('leavecredit.assign')"><i class="fa fa-plus-circle"></i> Assign leave</button> -->
                </div>

                <div class="col-md-12 mt-4">
                    <form class="form-inline" @submit.prevent="getEmployees()">
                      <div class="form-group mx-sm-3 mb-2">
                        <input type="text" v-model="search" class="form-control form-control-sm" placeholder="Search employee">
                      </div>
                      <button type="submit" class="btn btn-outline-success mb-2 btn-sm">Search</button>
                    </form>
                </div>

                <div class="col-md-12 mt-2 table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="2%">
                                    <input type="checkbox">
                                </th>
                                <th width="2%">Employee Number</th>
                                <th width="10%">Employee Name</th>
                                <th v-for="leave in leaves" width="5%">{{ leave.leave_code }} (in hours)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees.data">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td><b>{{ emp.employee_code }}</b></td>
                                <td><a href="#" @click.prevent="redirect('leavecredit.audit', {user_id: emp.user_id})">{{ emp.fname + ' ' + emp.mname + ' ' + emp.lname }}</a></td>
                                <td v-for="leave in leaves" class="hover-leave">
                                    <span v-for="credits in emp.leave_credits.filter(val => val.leave_id == leave.leave_id)">{{ hoursToDay(credits.credits) }}</span>
                                    <span v-if="emp.leave_credits.filter(val => val.leave_id == leave.leave_id).length == 0">--</span>
                                    <button @click="updateLeaveModal(emp, leave, 'add')" class="btn btn-info btn-xs hover-tohide"><span class="fa fa-plus"></span></button>
                                    <button @click="updateLeaveModal(emp, leave, 'subtract')" class="btn btn-danger btn-xs hover-tohide"><span class="fa fa-minus"></span></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- pagination -->
            <div class="row">
                <div class="col-lg-4 offset-lg-5">
                    <pagination :data="employees" @pagination-change-page="getEmployees"></pagination>
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
                leaves: '',
                employees: '',

                modal_data:'',
                credit: '',
                reason: '',
                typeofupdate: '',

                search: '',

                notif: '',

            }
        },

        created(){
            this.getleaves();
            this.getEmployees();
        },

        methods:{

            getleaves(){
                this.axiosRequest('get', this.$store.state.hl + 'leave')
                .then(res => {
                    this.leaves = res.data.data;
                })
                .catch(err => {

                });
            },

            getEmployees(page = 1){
                this.axiosRequest ('GET', this.$store.state.hl + 'leave_credit?page=' + page + '&search=' + this.search)
    			.then (res => {

    				this.employees = res.data.data.data
    				this.employees_loading = false

                    console.log(this.employees);


    			})
    			.catch (err => {
    				console.log(err)
    				this.employees_loading = false
    			})
            },

            // Update
            doUpdateCredit(modal_data, credit, typeofupdate, reason){
                let params = {
                    'user_id': modal_data.user_id,
                    'leave_id': modal_data.leave.leave_id,
                    'employee_code': modal_data.employee_code,
                    'credits': credit,
                    'update_type': typeofupdate,
                    'reason': reason,
                };

                console.log(params);
                this.axiosRequest('post', this.$store.state.hl + 'leave_credit', params)
                .then(res => {
                    if(res.data.status == 'success'){
                        this.getEmployees();
                    }
                    this.notif = res.data;
                    this.tnotif (res)
                    console.log(res.data.status == 'success');
                })
                .catch(err => {

                });
            },

            // Open Modal on click of hoverable**********************************
            updateLeaveModal(emp, leave, type){

                this.modal_data = emp;
                this.modal_data.leave = leave;
                this.typeofupdate = type;

                $('.modal').modal('toggle');
            }

        },


    }

</script>

<style>
    .hover-tohide{
        display: none;
    }

    .hover-leave:hover > .hover-tohide{
        display: inline;
    }

    .btn-group-xs > .btn, .btn-xs {
      padding: .25rem .4rem;
      font-size: .500rem;
      line-height: .5;
      border-radius: .2rem;
    }

</style>
