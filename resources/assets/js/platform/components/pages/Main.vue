<template>
	<section>
		<div class="row">
			<div class="col-md-2">
				<p class="text-center">sidebar 1</p>
			</div>
			<div class="col-md-8">
				<h1 class="text-center">content</h1>
			</div>
			<div class="col-md-2">
				<p class="text-center">sidebar2</p>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				
			}
		},
		methods: {

		},
		create() {
			axios.get('/api/userauth')
				.then(response => {
			
				})
		}	
	}
</script>