<template>
	<section>
		<div class="row px-0">
			<div class="col-md-6">
				<open-doc></open-doc>
				<img src="images/testimage.png" width="80" class="ml-5 mt-5">
				<h1 class="exp-tags mb-3 ml-5 skill-title">Skills<img src="images/testimage2.png" width="80"></h1>
				<h4 class="text-grey ml-5 mb-5 lighter">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod corporis, alias sapiente placeat ipsum minus, hic blanditiis, ab earum at eveniet distinctio dolor veniam tempore tempora, officiis cupiditate ea eligendi nisi? Animi saepe quia optio, possimus soluta rem ex temporibus eaque doloremque beatae nobis delectus eos voluptatibus! Molestiae consectetur labore, laborum in magnam ullam quaerat esse tempora quibusdam! Delectus rem impedit quasi pariatur rerum quis unde omnis dolor necessitatibus facilis cumque, quas fugit ipsa magnam labore! Laudantium doloribus iste reprehenderit facilis officiis harum mollitia libero voluptatem consequatur alias quis veniam consequuntur placeat culpa, temporibus ipsum explicabo officia non. Provident, hic.	
				</h4>
				<close-doc></close-doc>
			</div>
			<div class="col-md-6">
				<tags-ball v-bind:style='styleObject' 
				:width='800' 
				:height='800'
				:radius='300'
				:fontMax='200'
				:stop='true'
				:tags='tags'/>
			</div>
		</div>
	</section>
</template>


<script>
	import TagsBall from 'vue-tags-ball'

	export default {
		name: 'Skills',

		components: {
			"tags-ball":TagsBall
		},

		data() {
			return {
				styleObject: {
					border: '2px solid #252628'
				},
				skills: [{
					id: ''
				}],
				tags: [
				'PHP',
				'Laravel',
				'Spark',
				'Twilio',
				'Javascript',
				'Vue JS',
				'MySQL',
				'PostgreSQL',
				'SASS',
				'JSON',
				'Git',
				'Mailgun',
				'Rollbar',
				'TaxJar',
				'Stripe',
				'Braintree',
				],
				// tags: [
				// 'PHP',
				// 'Laravel',
				// 'Spark',
				// 'Twilio',
				// 'laravel-translatable',
				// 'laravel-dompdf',
				// 'phpword',
				// 'UUID',
				// 'Geo',
				// 'Tinker',
				// 'Passport',
				// 'PhpSpreadsheet',
				// 'Mailgun',
				// 'Rollbar',
				// 'TaxJar',
				// 'Stripe',
				// 'Braintree',
				// 'multi-tenant',
				// 'Javascript',
				// 'Vue JS',
				// 'Chart JS',
				// 'VueChart JS',
				// 'Websocket',
				// 'axios',
				// 'VueX',
				// 'Bootstrap',
				// 'Laravel-Echo',
				// 'Laravel-Mix',
				// 'Sweetalert',
				// 'v-calendar',
				// 'vue',
				// 'vue-awesome-swiper',
				// 'vue-chartjs',
				// 'vue-country-select',
				// 'vue-form-wizard',
				// 'vue-hotel-datepicker',
				// 'vue-multiselect',
				// 'vue-router',
				// 'vue-scroll-reveal',
				// 'vue-select',
				// 'vue-social-sharing',
				// 'vue-spinner',
				// 'vue-swal',
				// 'vue-tel-input',
				// 'vue-template-compiler',
				// 'vue2-dropzone',
				// 'vue2-editor',
				// 'vuedraggable',
				// 'vuejs-datepicker',
				// 'vuelidate',
				// 'vuetable-2',
				// 'vue-avatar-cropper',
				// 'font-awesome',
				// 'v-autocomplete',
				// 'vue-tour',
				// 'MySQL',
				// 'PostgreSQL',
				// 'SASS',
				// 'JSON',
				// 'Git'
				// ],
			}
		},

		methods: {

		},
		created() {
			axios.get('/api/allskills')
			.then(response => {
				this.skills = response.data
			})
		}
	}


</script>
