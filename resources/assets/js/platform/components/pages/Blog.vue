<template>
	<section>
		<div class="row main-post mt-3">
			<div class="col-md-4" @mouseover="descriptionPost()">
				<div class="img-container project-hover">
					<img :src="posts[0].image">
				</div>

			</div>
			<div class="col-md-4">
				<div class="img-container project-hover">
					<img :src="posts[0].image">
				</div>
			</div>
			<div class="col-md-4">
				<div class="img-container project-hover">
					<img :src="posts[0].image">
				</div>
			</div>
		</div>
		<div class="row content-block mt-5">
			<div class="col-md-6">
				<img src="images/testimage.png" width="80" class="ml-5 mt-5">
				<h1 class="expirience-title mb-3 ml-5 exp-tags">Writing...<img src="images/testimage2.png" width="80"></h1>
				<h4 class="text-grey lighter mb-5 ml-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
			</div>
			<div class="col-md-6">
				<div class="row align-items-start">
					<div class="col-md-12 project-hover mt-5" v-scroll-reveal.reset>
					<!-- <div class="col-md-12 project-hover mt-5" v-for="post in posts" v-scroll-reveal.reset> -->
						<div class="box">
							<img :src="posts[0].image" width="100%">
							<div class="hover-effect">
								<a href="#" class="hover-text">
									<h1>{{posts[0].title}}</h1>
									<p>{{posts[0].short_description}}</p>
								</a>
							</div>
						</div>
					</div>
					<!-- <div class="col-md-4 px-5">
						<img :src="post.image" width="100%">
					</div>
					<div class="col-md-8 text-grey project-hover">
						<router-link :to="{ name: 'post', params: { id: post.id }}" tag="a">
							<h3 class="text-grey lighter text-right mt-0">{{ post.title}}</h3>
							<p class="text-grey lighter text-right" v-html="post.short_description"></p>
							<p class="exp-tags lighter text-right mt-5">
								{{post.category.name}}
							</p>
							<p class="text-grey lighter text-right">
								posted on    
								{{post.created_at}}
							</p>
						</router-link>
					</div> -->
				</div>
			</div>
		</div>


	</section>
</template>
<script>
	export default {
		data() {
			return {
				posts: [{
					image: ''
				}],
			}
		},
		methods: {
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
.box {
  position: relative;
  overflow: hidden;
  height: 100%;
  width: 100%;
  background-size: cover;
  cursor: pointer;
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

/*p {
    width: 70%;
    line-height: 1em;
    font-size: 15px;
    display: inline-block;
    text-align: right;
}*/

</style>