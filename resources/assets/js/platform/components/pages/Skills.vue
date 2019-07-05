<template>
	<section class="skill-section">
		<div class="preloader-block" id="preload-block" v-if="preloader == true">
			<p class="text-green text-big text-center mb-0" id="preload-logo">R</p>
			<h1 class="text-center text-small text-white mt-0" id="preload" v-if="preloader == true">Rumus</h1>
			<p class="text-grey text-small-lighter text-center" id="preload-think">Rumus is thinking</p>
			<div class="loader mx-auto"></div>
		</div>
		<div class="row px-0" v-if="preloader !== true">
			<div class="col-sm-12 col-md-6">
				<open-doc v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="60" class="ml-5 mt-5">
				<h1 class="exp-tags mb-3 ml-5 skill-title">Skills<img src="images/testimage2.png" width="60"></h1>
				<h4 class="text-grey ml-5 mb-5 lighter text-xl" v-scroll-reveal.reset>
					Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod corporis, alias sapiente placeat ipsum minus, hic blanditiis, ab earum at eveniet distinctio dolor veniam tempore tempora, officiis cupiditate ea eligendi nisi? Animi saepe quia optio, possimus soluta rem ex temporibus eaque doloremque beatae nobis delectus eos voluptatibus! Molestiae consectetur labore, laborum in magnam ullam quaerat esse tempora quibusdam! Delectus rem impedit quasi pariatur rerum quis unde omnis dolor necessitatibus facilis cumque, quas fugit ipsa magnam labore! Laudantium doloribus iste reprehenderit facilis officiis harum mollitia libero voluptatem consequatur alias quis veniam consequuntur placeat culpa, temporibus ipsum explicabo officia non. Provident, hic.	
				</h4>
				<close-doc v-scroll-reveal.reset></close-doc>
			</div>
			<div class="col-sm-12 col-md-6">
				<tags-ball class="tag-ball" v-bind:style='styleObject' 
				:width='800' 
				:height='800'
				:radius='300'
				:fontMax='200'
				:stop='true'
				:tags='tags'/>
			</div>
			<div class="col-sm-12 col-md-6">
				<tags-ball class="tags-cloud-if" v-bind:style='styleObject' 
				:width='350' 
				:height='350'
				:radius='125'
				:fontMax='75'
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
				preloader: false,
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
			}
		},
		watch: {
		    'preloader'(val){
		    	console.log(val)
		    }
		},
		methods: {
			showPreloader() {
				setTimeout(() => {
					$('#preload').fadeOut('fast');
					$('#preload-logo').fadeOut('fast');
					$('#preload-think').fadeOut('fast');
					this.preloader = false;
				}, 2500);
				
			}
		},
		created() {
			axios.get('/api/allskills')
			.then(response => {
				this.skills = response.data
			})
			this.preloader = true
			this.showPreloader()
		}
	}


</script>
<style type="text/css">
@keyframes slideInFromLeft {
	0% {
		transform: translateX(-100%);
	}
	100% {
		transform: translateX(0);
	}
}

.preloader-block{
animation: 1s ease-out 0s 1 slideInFromLeft;
	/*background: #333;*/
padding: 30px;
}
.loader {
height: 1px;
width: 30%;
position: relative;
overflow: hidden;
background-color: #ddd;
}
.loader:before{
display: block;
position: absolute;
content: "";
left: -200px;
width: 200px;
height: 4px;
background-color: #07fdd8;
animation: loading 2s linear infinite;
}

@keyframes loading {
	from {left: -200px; width: 30%;}
	50% {width: 30%;}
	70% {width: 70%;}
	80% { left: 50%;}
	95% {left: 120%;}
	to {left: 100%;}
}
</style>