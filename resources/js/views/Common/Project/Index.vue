<template>
	<div>
		<TemplateA
			title="Company Project"
		>
			<template #action>
				<v-btn 
					v-if="options.isBtnCreateShow"
					color="primary"
					to="project/create"
				>
					Create
				</v-btn>
			</template>
			<template #body>
				<v-row class="p-0 m-0">
					<v-col cols="3" md="4" v-for="(item,index) in projects" :key="index">
						<v-card class="project-card hover-scale" @click="onProjectClick(item)">
							<div class="profile-con">
								<v-img
									class="profile"
									:src="item.photo"
								/>
							</div>
							<div class="name-con">
								<h3>{{ item.name }}</h3>
							</div>
						</v-card>
					</v-col>
				</v-row>
			</template>
		</TemplateA>
	</div>
</template>
<script>
export default {
	props: {
		options: {
			type: Object,
			default() {
				return {
					isBtnCreateShow: false
				}
			}
		}
	},
	mounted() {
		this.init()
	},
	data() {
		return {
			projects: []
		}
	},
	methods: {
		init() {
			this.$chttp.get('project').then( res => {
				this.projects = res.data.data.projects
			})
		},
		onProjectClick(item) {
			this.$router.routeTo({
				name: 'project.detail',
				params: {
					id: item.id
				}
			})
		}
	}
}
</script>