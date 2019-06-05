<template>
	<aside class="sidebar-admin">
		<ul class="pl-4">
			<li class="pt-2">
				<a role="button" class="text-white">Points</a>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'categoriesAdmin'}" tag="a">
					<i class="fa fa-list mr-2"></i>
					Categories
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'tagsAdmin'}" tag="a">
					<i class="fa fa-tags mr-2"></i>
					Tags
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'skillsAdmin'}" tag="a">
					<i class="fa fa-wrench mr-2"></i>
					Skills
				</router-link>
			</li>
			<li class="pr-5 pt-3">
				<span class="border-bottom w-100 d-block border-color-blue"></span>
			</li>
			<li class="pt-2">
				<a role="button" class="text-white">Content</a>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'blogAdmin'}" tag="a">
					<i class="fa fa-file-text-o mr-2"></i>
					Blog
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'newsAdmin'}" tag="a">
					<i class="fa fa-newspaper-o mr-2"></i>
					News
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'projectsAdmin'}" tag="a">
					<i class="fa fa-connectdevelop mr-2"></i>
					Projects
				</router-link>
			</li>
			<li class="pr-5 pt-3">
				<span class="border-bottom w-100 d-block border-color-blue"></span>
			</li>
			<li class="pt-2">
				<a role="button" class="text-white">Author Info</a>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'aboutAdmin'}" tag="a">
					<i class="fa fa-user mr-2"></i>
					About
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'socialAdmin'}" tag="a">
					<i class="fa fa-external-link mr-2"></i>
					Social Links
				</router-link>
			</li>
			<li class="pr-5 pt-3">
				<span class="border-bottom w-100 d-block border-color-blue"></span>
			</li>
			<li class="pt-2">
				<a role="button" class="text-white">Clients</a>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'usersAdmin'}" tag="a">
					<i class="fa fa-users mr-2"></i>
					Users
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'contactsAdmin'}" tag="a">
					<i class="fa fa-envelope mr-2"></i>
					Contacts
				</router-link>
			</li>
			<li class="pl-3 pt-3">
				<router-link class="d-block" :to="{ name: 'subscribedAdmin'}" tag="a">
					<i class="fa fa-pencil-square-o mr-2"></i>
					Subscribed
				</router-link>
			</li>		
		</ul>
	</aside>
</template>
<script>
	export default {
		data() {
			return {
				
			}
		}	
	}
</script>