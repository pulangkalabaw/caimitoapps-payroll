<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-sm btn-tunch" @click.prevent="redirect('leavecredit.assign')"><i class="fa fa-plus-circle"></i> Assign leave</button>
                </div>
                <div class="col-md-12 mt-2">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox">
                                </th>
                                <th>Employee Name</th>
                                <th>VL</th>
                                <th>SL</th>
                                <th>BL</th>
                                <th>ML</th>
                                <th>PL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>John Smith</td>
                                <td @dblclick="thisbtn ^= true"><input v-if="thisbtn" type="text" value="10.00"><span v-else>10.00</span></td>
                                <td>0.00</td>
                                <td>0.00</td>
                                <td>5.00</td>
                                <td>5.00</td>
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

                thisbtn: false,
                employees: '',
            }
        },

        created(){
            this.getEmployees();
        },

        methods:{

            getEmployees(){
                this.axiosRequest ('GET', this.$store.state.pis + 'employee')
    			.then (res => {

                    console.log(res);
    				this.employees  = res.data.data
    				this.employees_loading = false

    			})
    			.catch (err => {
    				console.log(err)
    				this.employees_loading = false
    			})
            },

        },


    }

</script>
