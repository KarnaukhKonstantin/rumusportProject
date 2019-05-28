<template>
	<h1>
		THIS IS TEST
	</h1>
</template>
<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {

		}, 
		created() {
			console.log('okay')
			axios.get('/api/userauth')
				.then(response => {
			
				})
		}	
	}
</script>