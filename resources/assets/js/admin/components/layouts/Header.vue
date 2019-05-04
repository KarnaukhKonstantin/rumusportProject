<template>
	<section class="shadow mb-3">
		<div class="row px-2">
			<button type="button" class="btn btn-default mb-2"><i class="fa fa-list-ul"></i></button>
			<img src="images/rumusport.png" width="8%" height="8%">
			<div class="col-md-10 d-flex justify-content-end align-items-center pl-0 pl-sm-3">
				<!-- User -->
				<div class="btn-group py-2">
					<a href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="/images/me.jpg" width="50" height="50" class="rounded-circle">
					</a>
				<div class="dropdown-menu">
					<h5 class="text-center">Rumus Hard</h5>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" :href="'/' + $route.params.lang + '/settings'">Profile</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="/logout">Logout</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	export default {
		data() {
			return {
				
			}
		}	
	}
</script>