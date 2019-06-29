<template>
	<section>
		<div class="row">
			<div class="col-md-5">
				<open-doc v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="80" class="ml-5 mt-5">
				<h2 class="contact-title exp-tags my-0 ml-5">Contact me...<img src="images/testimage2.png" width="80"></h2>
				<p class="text-grey lighter ml-5">If you have any questions, please don’t hesitate to contact using form below…</p>
				<div class="contact-form ml-5">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group" v-scroll-reveal.reset>
								<input type="text" class="form-control br-dark-blue contact-input" v-model="form.name" placeholder="Name" id="contact_name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group" v-scroll-reveal.reset>
								<input type="text" class="form-control br-dark-blue contact-input" v-model="form.email" placeholder="Email" id="contact_email">
							</div>
						</div>
					</div>
					
					<div class="form-group" v-scroll-reveal.reset>
						<input type="text" class="form-control  br-dark-blue contact-input" id="contact_subject" placeholder="Subject" v-model="form.subject">
					</div>

					<!-- Message -->
					<div class="form-group" v-scroll-reveal.reset> 
						<textarea class="form-control contact-input" rows="6"  id="contact_description" placeholder="Message" v-model="form.message"></textarea>
					</div>
				</div>
				<div class="row justify-content-end">
					<button class="contact-me py-2 px-2 mb-5 mr-3" @click="save()">
						<p class="text-uppercase my-0">Send</p>
					</button>
				</div>
				<close-doc v-scroll-reveal.reset></close-doc>
			</div>
			<div class="col-md-7 map-section">
				<!-- <l-map :zoom="zoom" :center="center">
			      <l-tile-layer :url="url" :attribution="attribution"></l-tile-layer>
			      <l-marker :lat-lng="marker"></l-marker>
			    </l-map> -->
				<img src="images/map.png" class="w-100 h-100">
			</div>
		</div>
	</section>
</template>
<script>

	import {LMap, LTileLayer, LMarker} from 'vue2-leaflet'
	export default {
		components: { 
			LMap, LTileLayer, LMarker 
		},
		data() {
			return {
				name: '',
				email: '',
				form: {},
				//for map
				zoom:13,
				center: L.latLng(47.8388,35.1396),
				url:'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
				attribution:'&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
				marker: L.latLng(47.8388,35.1396),
			}
		}, 
		methods: {
			save() {
				if (this.form.email == '') {
					document.getElementById('contact_email').focus()
				}
				if(this.form.name == '') {
					document.getElementById('contact_name').focus()
				}
				if(this.form.subject == '') {
					document.getElementById('contact_subject').focus()
				}
				if(this.form.message == '') {
					document.getElementById('contact_description').focus()
				}

				if(this.form.name !== '' && this.form.message !== '' && this.form.email !== '' && this.form.subject !== '') {
						this.error = true
				}

				if(this.form.name !== '' && this.form.message !== '' && this.form.email !== '' && this.form.subject !== '') {
					axios.post('/api/messages', this.form)
					.then(response => {
						this.form.name = '',
						this.form.email = '',
						this.form.subject = '',
						this.form.message = '',
						this.$swal('Message was Send',
							'',
							'success',
							);
					})
				}
			},
		},
		created() {

		}
	}
</script>
<style type="text/css">
.map-section {
	height: 100%;
  	margin: 0;
}
</style>
