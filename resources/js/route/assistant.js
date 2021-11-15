import MainAssistant from '@Assistant/App/App'
import Project from '@Assistant/Project/Index'
import Role from '@Assistant/Role/Index'
import Worker from '@Assistant/Worker/Index'
import Assistant from '@Assistant/Assistant/Index'
import CreateWorker from '@Assistant/Worker/Create';
import FreeEmployee from '@Assistant/Employee/Free';
// import ProjectDetail from '../views/Admin/ProjectDetail/Index';
var role = 'assistant';
export default {
	path: '/assistant',
	name: 'assistant',
	components: {
		default: MainAssistant
	},
	children: [
		{
			path: 'project',
			name: 'assistant.project',
			component: Project
		},
		// {
		// 	path: 'project/:id',
		// 	name: 'assistant.project.detail',
		// 	component: ProjectDetail
		// },
		{
			path: 'assistant',
			name: 'assistant.assistant',
			component: Assistant
		},
		{
			path: 'employee/free',
			name: 'assistant.employee.free',
			component: FreeEmployee
		},
		{
			path: 'worker',
			name: 'assistant.worker',
			component: Worker
		},
		{
			path: 'worker/create',
			name: 'assistant.worker.create',
			component: CreateWorker
		},
		{
			path: 'role',
			name: 'assistant.role',
			component: Role
		}
	]
}