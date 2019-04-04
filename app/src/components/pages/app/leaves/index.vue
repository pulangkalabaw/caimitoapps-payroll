<template>
    <div>

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">
            <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Leave type</button>
            <br><br>

            <div class="card">
                <div class="card-header">
                    Leaves types
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hovered">
                        <thead>
                            <tr>
                                <th>Leave Code</th>
                                <th>Leave Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>asd</td>
                                <td>asd</td>
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
    					'label': 'Leaves',
    					'route': 'leaves.index',
    					'params': {}
    				},
    			],
            }
        },
    }


</script>
