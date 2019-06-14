<template>
	<section>
		<div class="row mt-5">
			<div class="col-md-6">
				
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
					color: '#ffffff',
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
