<template>
	<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="row justify-content-center px-3">
				<div class="col-lg-11 p-4">
					<form class="d-flex flex-column align-items-center">
						<div class="col-lg-8 text-center mb-2">
							<h3 class="mb-0">Register to Rumusport</h3>
						</div>

						<div class="form-group col-lg-12 justify-content-start mb-1">
							<div class="field">
								<input id="username-regestration" type="text" name="name" placeholder=" " v-model="form.name" :class="{'error': $v.form.name.$error}" @keyup="checkNickname">
								<label class="pl-1" for="username-regestration">Nickname</label>
							</div>
								<span class="error-msg" v-if="$v.form.name.$error">Name is required</span>
								<span class="error-msg" v-if="error && !$v.form.name.$error">Nickname must be without spaces</span>
						</div>

						<div class="form-group col-lg-12 justify-content-start mb-1">
							<div class="field">
								<input id="email-regestration" type="email" name="email" placeholder=" " v-model="form.email" :class="{'error': $v.form.email.$error}">
								<label class="pl-1" for="email-regestration">Email</label>
							</div>
							<span class="error-msg" v-if="$v.form.email.$error">
								<template v-if="$v.form.email.required">
									Invalid error
								</template>
								<template v-else>
									Email is required
								</template>
							</span>
						</div>

						<div class="form-group  col-lg-12 justify-content-start mb-1">
							<div class="field">
								<input id="password-regestration" type="password" name="password" placeholder=" " v-model="form.password" :class="{'error': $v.form.password.$error}">
								<label class="pl-1" for="password-regestration">Password</label>
							</div>
							<span class="error-msg" v-if="$v.form.password.$error">Password is required</span>
						</div>

						<div class="form-group col-lg-12 justify-content-start mb-3">
							<div class="field">
								<input id="password_confirmation-regestration" type="password" name="password_confirmation-regestration" placeholder=" " v-model="form.password_confirmation" :class="{'error': $v.form.password_confirmation.$error}">
								<label class="pl-1" for="password_confirmation-regestration">Confirm password</label>
							</div>
							<span class="error-msg" v-if="$v.form.password_confirmation.$error">
								<template v-if="$v.form.password_confirmation.required">
									Password confirmation is required
								</template>
								<template v-else>
									Password confirmation
								</template>
							</span>
						</div>

						<div class="form-group col-lg-12 d-flex align-items-center mb-5">
							<label class="checkgroup" for="agree">I agree to the <a href="/terms" class="text-underline">Terms of services</a>
							  <input type="checkbox" id="agree" v-model="agree">
							  <span class="checkmark"></span>
							</label>
						</div>

						
						
						<div class="form-group col-lg-8 d-flex justify-content-center mb-5">
							<button type="button" class="btn btn-dark w-75 py-1" @click="sendForm()">
								Register
							</button>
						</div>

						<div class="form-group  col-lg-8 d-flex justify-content-center mb-0">
							<p>Have account<a role="button" class="text text-underline pl-1" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#loginModal">Login</a></p>
						</div>
					</form>
					
				</div>
				<button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close" ref="closeRegister">
					Close
				</button>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	import { required, email, sameAs } from 'vuelidate/lib/validators'

	export default {

		props: ['lang'],

		data() {
			return {
				form: {
					
				},
				error: null,
				agree: false
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
				password_confirmation: {
					required,
					sameAsPassword: sameAs('password')
				}
			}
		},

		methods: {
			checkNickname() {
				if (/\s/.test(this.form.name)) {
					this.error = true
				} else {
					this.error = false
				}
			},
			sendForm() {
				this.$v.form.$touch()
				let isValid = !this.$v.form.$invalid


				if(isValid && this.agree && !this.error) {
					axios.post('/api/signup', this.form)
						.then(response => {
					//add swal
						})
				}
			}
		},

		created() {

		}

	}
</script>