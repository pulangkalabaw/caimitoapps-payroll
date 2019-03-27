<template>
    <div>
        <!-- Style -->
        <div class="alert alert-dismissible" :class="{'alert-success': notif.status == 'success', 'alert-danger': notif.status != 'success' }" v-if="notif" style="overflow-wrap:break-word;">

            <div v-if="notif.errors.length != 0">

                <!-- Validation Error -->
                <div v-for="(mess, index) in notif.errors">
                    <div v-for="(error) in Object.values(mess)">

                        <!-- Icon -->
                        <span class="fa" :class="{'fa-check-circle': notif.status == 'success', 'fa-times-circle': notif.status != 'success' }"></span>
						{{ error }}
                    </div>
                </div>
            </div>
            <div v-else>
                <!-- Icon -->

                <span class="fa" :class="{'fa-check-circle': notif.status == 'success', 'fa-times-circle': notif.status != 'success' }"></span>
                <!-- Message -->
                <span>{{ notif.message }}</span>
            </div>

        </div>

    </div>
</template>
<script>
export default {
    props: ['notif'],

	created () {
		console.log(this.notif)
	}
}
</script>
