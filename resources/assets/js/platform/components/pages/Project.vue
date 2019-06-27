<template>
	<section>
		<div class="row">
			<div class="col-md-6">
				<open-doc></open-doc>
				<h1 class="expirience-title mt-5 mb-3 ml-5 exp-tags">{{project.name}}</h1>
				<h4 class="text-grey lighter mb-5 ml-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
				<div class="row justify-content-end">
					<router-link :to="{ name: 'platform-projects'}" tag="a">
						<button class="contact-me py-2 px-2 mb-5">
							<p class="text-uppercase my-0">OTHER PROJECTS</p>
						</button>
					</router-link>
				</div>
				<close-doc></close-doc>
			</div>
			<div class="col-md-6 mt-5">
				<div class="row">
					<div class="col-md-6">
						<h4 class="text-grey lighter mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
					</div>
					<div class="col-md-6">
						<h4 class="text-grey lighter mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
					</div>
				</div>
				<img class="project-image" :src="project.image" width="100%">
			</div>
		</div>
	</section>	
</template>
<script>
	export default {
		data() {
			return {
				project: {},

			}
		},
		methods: {

		},
		created() {
			axios.get('/api/projects/' + this.$route.params.id)
				.then(response => {
					this.project = response.data
				})
		}
	}
</script>
