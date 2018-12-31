<template>
	<ul class="menu-items">
		<li class="m-t-30">
			<a v-bind:href="admin_url" class="detailed">
				<span class="title">Home</span>
			</a>
			<span class="icon-thumbnail "><i class="pg-home"></i></span>
		</li>
		<li v-for="item in items">
			<a href='javascript:;'>
				<span class="title">
					{{ item.name }}
				</span>
				<span class="arrow" style="padding-right: 3px;"></span>
			</a>
			<span class="folder-link icon-thumbnail">
                <i v-bind:class="item.icon"></i>
            </span>
			<ul v-if="item.children.length !== 0" class='sub-menu'>
				<li v-for="child in item.children">
					<a v-bind:href="child.route" class='detailed'>
						<span class='title'>
							{{ child.name }}
						</span>
					</a>
					<a v-bind:href='child.route' class="sub-icon-link icon-thumbnail" style="padding: 0;">
						<i v-bind:class='child.icon'></i>
					</a>
				</li>
			</ul>
		</li>
	</ul>
</template>

<script>
	export default {
		name: "navigation",
		data() {
			return {
				items: [],
				admin_url: process.env.MIX_IKPANEL_URL
			};
		},
		props: {

		},
		created() {

		},
		beforeMount(){
			this.get();
		},
		methods: {
			get: function() {
				let self = this;
				axios.get('/admin/navigation')
					.then(function(response) {
						self.items = response.data;
					})
					.catch(function(error) {
						console.log(error);
					});

			}
		}
	};
</script>

<style scoped>

</style>