<template>
	<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content modal-card">
			<div class="d-flex justify-content-end">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="icon-close" aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-8 px-0 pb-3">
						<h2 class="text-center mb-4">{{lang.buttons.sign_up}}</h2>
					<form class="modal-card-login modal-card-login-size">
						<span class="error global-error text-easy d-flex justify-content-center w-100 px-3" v-if="error">{{error}}</span>

						<div class="form-group row justify-content-center px-5">
							<div class="field">
								<span class="text-easy error-msg" v-if="$v.form.name.$error">{{lang.inputs.name}} {{lang.errors.required}}</span>
								<input id="name-regestration" type="text" name="name-regestration" placeholder=" " v-model.trim="form.name" :class="{'error': $v.form.name.$error}">
								<label for="name-regestration">{{lang.inputs.name}}</label>
							</div>
						</div>

						<div class="form-group row justify-content-center px-5">
							<div class="field">
								<span class="text-easy error-msg" v-if="$v.form.email.$error">
									<template v-if="$v.form.email.required">
										{{lang.errors.invalid_email}}
									</template>
									<template v-else>
										{{lang.inputs.email}} {{lang.errors.required}}
									</template>
								</span>
								<input id="email-regestration" type="email" name="email-regestration" placeholder=" " v-model.trim="form.email" :class="{'error': $v.form.email.$error}">
								<label for="email-regestration">{{lang.inputs.email}}</label>
							</div>
						</div>

						<div class="form-group row justify-content-center px-5">
							<div class="field">
								<span class="text-easy error-msg" v-if="$v.form.password.$error">{{lang.inputs.password}} {{lang.errors.required}}</span>
								<input id="password-regestration" type="password" name="password-regestration" placeholder=" " v-model.trim="form.password" :class="{'error': $v.form.password.$error}">
								<label for="password-regestration">{{lang.inputs.password}}</label>
							</div>
						</div>

						<div class="form-group row justify-content-center mb-0 px-5">
							<div class="field">
								<span class="text-easy error-msg" v-if="$v.form.confird_password.$error">
									<template v-if="$v.form.confird_password.required">
										{{lang.inputs.confird_password}} {{lang.errors.required}}
									</template>
									<template v-else>
										{{lang.alerts.confird_password}}
									</template>
								</span>
								<input id="confird_password-regestration" type="password" name="confird_password-regestration" placeholder=" " v-model.trim="form.confird_password" :class="{'error': $v.form.confird_password.$error}">
								<label for="confird_password-regestration">{{lang.inputs.confird_password}}</label>
							</div>
						</div>

						<div class="form-group row pt-4 px-5">
							<div class="d-flex flex-column justify-content-center w-100 sign-up">
								<div class="d-flex align-items-center mb-2">
									<div class="roundedOne">
										<input type="checkbox" id="agree" class="mr-3 mb-1" v-model="agree">
										<label class="label" for="agree"></label>
									</div>
									<p class="mb-0">I agree with Privacy policy and Terms and conditions</p>
									
								</div>
								<div class="d-flex align-items-center">
									<div class="roundedOne">
										<input type="checkbox" id="subscribe" class="mr-3 mb-1" v-model="form.subscribe">
										<label class="label" for="subscribe"></label>
									</div>
									<p class="mb-0">Subscribe to the EasyBusy Newsletter</p>
								</div>
								<!-- <a class="btn btn-link px-0" href="/password/reset">
									{{lang.buttons.forgot_password}}
								</a> -->
							</div>
						</div>

						<div class="form-group row justify-content-center mb-0 px-5">
							<div class="col-md-10 d-flex flex-column justify-content-center align-items-center">
								<button type="button" class="btn btn-easy text-white my-4" @click="sendForm()">
									{{lang.buttons.sign_up}}
								</button>
								
								<p class="mb-0">{{lang.alerts.have_account}} <a role="button" class="text-easy" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#loginModal">{{lang.buttons.login}}</a></p>
							</div>
						</div>
					</form>
					
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	import { required, email, sameAs } from 'vuelidate/lib/validators'

	export default {

		props: ['version', 'lang'],

		data() {
			return {
				form: {},
				error: null,
				agree: null
			}
		},

		validations: {
			form: {
				name: {
					required
				},
				email: {
					required,
					email
				},
				password: {
					required
				},
				confird_password: {
					required,
					sameAsPassword: sameAs('password')
				}
			}
		},

		methods: {
			sendForm() {
				this.error = null
				this.$v.form.$touch()
				let isValid = !this.$v.form.$invalid
				if(!this.agree) {
					document.getElementById('agree').focus()
				}
				if(isValid && this.agree) {
					axios.post('/register', this.form)
					.then(response => {
					
					})
					.catch(error => {
						this.error = error.response.data.message
					})
				}
			}
		},

		created() {

		}

	}
</script>