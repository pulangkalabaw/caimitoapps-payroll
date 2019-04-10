<template>
    <div class="">

        <navdir :links='links'></navdir>
		<div class="clearfix"></div><br />

        <div id="content">

            <button class="btn btn-primary" @click.prevent="redirect('leaves.create')">Create Leave Type</button>




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
            ]
        }
    },
}

</script>
