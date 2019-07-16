<template>
	<section class="section-about">
		<div class="preloader-block" id="preload-block" v-if="preloader == true">
			<p class="text-green text-big text-center mb-0" id="preload-logo">R</p>
			<h1 class="text-center text-small text-white mt-0" id="preload" v-if="preloader == true">Rumus</h1>
			<p class="text-grey text-small-lighter text-center" id="preload-think">Rumus is thinking</p>
			<div class="loader mx-auto"></div>
		</div>
		
		<div class="row" v-if="preloader !== true">
			<div class="col-sm-12 col-md-6">
				<open-doc v-scroll-reveal.reset></open-doc>
				<img src="images/testimage.png" width="60" class="ml-5 mt-5">
				<h1 class="expirience-title mb-3 ml-5 exp-tags">About Me<img src="images/testimage2.png" width="60"></h1>
				<div class="text-grey lighter mb-4 ml-5 text-xl" v-scroll-reveal.reset>
					<h4 class="text-grey lighter mb-4 text-xl">Lorem ipsum dolor sit amet, consectetur adipisicing elit. </h4>
					<h4 class="text-grey lighter mb-4 text-xl">Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas!</h4>
					<h4 class="text-grey lighter mb-4 text-xl">Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea?</h4>
					<h4 class="text-grey lighter mb-4 text-xl">Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. </h4>
					<h4 class="text-grey lighter mb-4 text-xl">Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur.</h4> 
				</div>
				<close-doc v-scroll-reveal.reset></close-doc>
			</div>
			<div class="col-sm-12 col-md-6 stack">
				<div class="wrap">
					<div class="cube">
						<div class="front text-center pt-5">
							<img src="/images/icons/js.jpg" width="100" height="100">
						</div>
						<div class="back text-center pt-5">
							<img src="/images/icons/php.png" width="100" height="100">
						</div>
						<div class="top text-center pt-5">
							<img src="/images/icons/laravel.png" width="100" height="100">
						</div>
						<div class="bottom text-center pt-5">
							<img src="/images/icons/vue.png" width="100" height="100">
						</div>
						<div class="left text-center pt-5">
							<img src="/images/icons/postgresql-logo.png" width="100" height="100">
						</div>
						<div class="right text-center pt-5">
							<img src="/images/icons/mysql.png" width="100" height="100">
						</div>
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
				preloader: false,
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
			this.preloader = true
			this.showPreloader()
		}	
	}
</script>

<style type="text/css">
.wrap {
	margin-top: 200px;
	perspective: 1000px;
	perspective-origin: 50% 50%;
}
.cube {
	margin: auto;
	position: relative;
	height: 200px;
	width: 200px;
	transform-style: preserve-3d;
}

.cube > div {
	position: absolute;
	box-sizing: border-box;
	padding: 10px;
	height: 100%;
	width: 100%;
	opacity: 0.9;
	background-color: #484848;
	border: solid 1px #07fdd8;
	color: #ffffff;
}
.front {
	transform: translateZ(100px);
}

.back {
	transform: translateZ(-100px) rotateY(180deg);
}

.right {
	transform: rotateY(-270deg) translateX(100px);
	transform-origin: top right;
}

.left {
	transform: rotateY(270deg) translateX(-100px);
	transform-origin: center left;
}

.top {
	transform: rotateX(-270deg) translateY(-100px);
	transform-origin: top center;
}

.bottom {
	transform: rotateX(270deg) translateY(100px);
	transform-origin: bottom center;
}
@keyframes rotate {
	from {
		transform: rotateX(0deg) rotateY(0deg);
	}

	to {
		transform: rotateX(360deg) rotateY(360deg);
	}
}

.cube {
	animation: rotate 20s infinite linear;
}
.wrap:hover .front {
	transform: translateZ(200px);
}
.wrap:hover .back {
	transform: translateZ(-200px) rotateY(180deg);
}
.wrap:hover .right {
	transform: rotateY(-270deg) translateZ(100px) translateX(100px);
}
.wrap:hover .left {
	transform: rotateY(270deg) translateZ(100px) translateX(-100px);
}
.wrap:hover .top {
	transform: rotateX(-270deg) translateZ(100px) translateY(-100px);
}
.wrap:hover .bottom {
	transform: rotateX(270deg) translateZ(100px) translateY(100px);
}
.cube > div {
	transition: transform 0.2s ease-in;
}
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