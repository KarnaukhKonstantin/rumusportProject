<template>
	<section>
		<div class="row stack">
			<div class="col-md-6">
				
			</div>
			<div class="col-md-4">
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
			<div class="col-md-2">
				
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