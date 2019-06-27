<template>
	<section>
		<div class="row all-posts-row">
			<div class="col-md-4 mt-3" v-for="post in posts">
				<div class="box" @mouseover="getDate(post)">
					<router-link :to="{ name: 'post', params: { id: post.id }}" tag="a">
						<img :src="post.image" width="100%" height="100%">
						<div class="hover-effect">
							<a href="#" class="hover-text">
								<h1>{{post.title}}</h1>
								<p>{{post.short_description}}</p>
								<p class="mt-2">{{date}}</p>
							</a>
						</div>
					</router-link>
				</div>
			</div>
		</div>
	</section>
</template>
<script>
	import moment from 'moment'
	export default {
		data() {
			return {
				posts: [],
				date:'',
			}
		},
		methods: {
			getDate(post) {
				this.date = moment(post.created_at).format('ll');
			}
		},
		created() {
			axios.get('/api/posts')
			.then(response => {
				this.posts = response.data
			})
		}
	}
</script>
<style type="text/css">
.all-posts-row .box {
	position: relative;
	overflow: hidden;
	height: 300px;
	width: 100%;
	background-size: cover;
	cursor: pointer;
}
.hover-effect a{
	color:#fff;
}

.hover-effect {
	position: absolute;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background: rgba(5, 8, 31, 0.62);
	transition: all 0.3s ease-in-out;
	opacity: 0;
}

.box:hover .hover-effect {
	opacity: 1;
}
.box:hover .hover-text {
	right: 0;
}
/*.box img {
	object-fit: fill;
	}*/
	.hover-text {
		position: absolute;
		right: -100%;
		bottom: 0;
		display: block;
		max-width: 100%;
		padding: 40px 45px;
		color: #e2e2e2;
		text-decoration: none;
		text-align: right;
		line-height: 1.5em;
		font-size: 15px;
		font-family: "Proxima Nova";
		font-weight: 300;
		text-transform: uppercase;
		letter-spacing: 5px;
		transition: all 0.5s ease-in-out;
	}

	.hover-text h1 {
		font-size: 2em;
		font-weight: 500;
		padding: 0.8em 0;
		margin-bottom: 0.3em;
		border-bottom: 1px solid #fff;
	}

</style>