<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <!-- Modal for update leave -->
            <div class="modal" tabindex="-1" role="dialog" v-if="modal_data">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Update leave</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <label for=""><b>{{ modal_data.fname + ' ' + modal_data.mname + ' ' + modal_data.lname }} <small><{{ modal_data.employee_code }}></small></b></label>
                      <div class="row">
                          <div class="col-md-4">
                              <small class="font-weight-bold"><label for="">Leave credit</label></small>
                              <input type="number" class="form-control form-control-sm">
                          </div>
                          <div class="col-md-12">
                              <small class="font-weight-bold"><label for="">Reason for updating leave</label></small>
                              <textarea type="number" class="form-control form-control-sm" placeholder="Reason"></textarea>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm">Save</button>
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
                <div class="col-md-12 mt-2">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">
                                    <input type="checkbox">
                                </th>
                                <th width="10%">Employee Name</th>
                                <th v-for="leave in leaves" width="5%">{{ leave.leave_code }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="emp in employees">
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>{{ emp.fname + ' ' + emp.mname + ' ' + emp.lname }}</td>
                                <td v-for="leave in leaves" class="hover-leave">-- <button @click="updateLeaveModal(emp, leave)" class="btn btn-info btn-xs hover-tohide"><span class="fa fa-edit"></span></button></td>
                            </tr>
                        </tbody>
                    </table>
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

            getEmployees(){
                this.axiosRequest ('GET', this.$store.state.pis + 'employee')
    			.then (res => {

    				this.employees = res.data.data.data.data
    				this.employees_loading = false

                    console.log(this.employees);


    			})
    			.catch (err => {
    				console.log(err)
    				this.employees_loading = false
    			})
            },

            // Open Modal on click of hoverable
            updateLeaveModal(emp, leave){
                this.modal_data = emp;
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
      font-size: .875rem;
      line-height: .5;
      border-radius: .2rem;
    }

</style>
