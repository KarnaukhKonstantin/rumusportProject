<template>
	<section>
		<div class="row">
			<div class="col-md-6">
				<open-doc></open-doc>
				<img src="images/testimage.png" width="80" class="ml-5 mt-5">
				<h1 class="expirience-title mb-3 ml-5 exp-tags">About Me<img src="images/testimage2.png" width="80"></h1>
				<h4 class="text-grey lighter mb-5 ml-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore totam doloribus quidem harum quos dolor eligendi nulla, amet, officiis impedit. Aperiam eum suscipit minus iusto modi dolores, nesciunt rem repellendus harum voluptas! Repellat, totam, ipsum! Sequi assumenda quidem natus architecto voluptate molestias amet quibusdam nulla cupiditate, dignissimos perferendis, dicta cum porro enim nesciunt aliquam ratione inventore ea? Iure necessitatibus quis facilis ut. Aut harum, voluptatibus, assumenda est sapiente iure velit sed placeat nulla rem ullam consequatur, suscipit voluptatum officia, molestias ipsa at. Consequatur voluptatem, ipsum, sequi repudiandae magni, porro ducimus in commodi repellendus harum velit quos mollitia! Magnam ipsum quas quasi? Aliquam dicta quos aut itaque labore sit magnam aperiam nesciunt doloremque quae quasi cumque eum, suscipit, temporibus nobis, dignissimos sunt quo consequuntur consequatur. </h4>
				<close-doc></close-doc>
			</div>
			<div class="col-md-6 stack">
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
				
			}
		}	
	}
</script>

<style type="text/css">
.wrap {
	margin-top: 150px;
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
</style>