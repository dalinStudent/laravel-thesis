import MainAdmin from '@Admin/App/App';
import Profile from '@Admin/Profile/Index';
import Home from '@Admin/Home/Index';
import ProductList from '@Admin/Product/Index';
import StudentList from '@Admin/Student/Index';
import StudentCreate from '@Admin/Student/Create';
import StudentEdit from '@Admin/Student/edit';
import ProductCreate from '@Admin/Product/Create';
import ProductEdit from '@Admin/Product/edit';
import CategoryList from '@Admin/Category/Index';
import CategoryCreate from '@Admin/Category/Create';
import CategoryEdit from '@Admin/Category/Edit';
import BorrowingList from '@Admin/Borrowing/Index';
import BorrowingCreate from '@Admin/Borrowing/Create';
import BorrowingEdit from '@Admin/Borrowing/Edit';
import RoomList from '@Admin/Room/Index';
import ProjectCreate from '@Admin/Project/Create';
import DepartmentCreate from '@Admin/Department/Create';
import DepartmentEdit from '@Admin/Department/edit';
import RoomCreate from '@Admin/Room/Create';
import DepartmentList from '@Admin/Department/index';
import SideManager from '@Admin/SideManager/Index';
import Assistant from '@Admin/Assistant/Index';
import Worker from '@Admin/Worker/Index';
import WorkerCreate from '@Admin/Worker/Create';
import WorkerFree from '@Admin/FreeWorker/Index';
import Role from '@Admin/Role/Index';
import UserCreate from '@Admin/User/create';
import User from '@Admin/User/index';
import Report from '@Admin/Report/Index';
import ProjectDetail from '@Admin/ProjectDetail/Index';
import EmployeeList from '@Admin/Employee/index';
import EmployeeEdit from '@Admin/Employee/edit';
import EmployeeCreate from '@Admin/Employee/create';
import ProjectCard from '@Admin/ProjectDetail/Card/Index';
// report
import RptStudent from '@Admin/RptStudent/index';
// import Card from '@Admin/Card/Index'
// import CardSetting from '@Admin/Card/Setting';
import Schedule from '@Admin/Schedule/Index';
export default {
	path: '/admin',
	components: {
		default: MainAdmin
	},
	children: [
		{
			path: 'profile',
			name: 'admin.profile',
			component: Profile
		},
		{
			path: 'rptStudent',
			name: 'admin.rptStudent',
			component: RptStudent
		},
		{
			path: 'home',
			name: 'admin.home',
			component: Home
		},
		{
			path: 'product',
			name: 'admin.product',
			component: ProductList
		},

		{
			// Leang
			path: 'department',
			name: 'admin.department',
			component: DepartmentList
		},
		{
			// Leang
			path: 'borrowingproduct',
			name: 'admin.borrowingproduct',
			component: BorrowingList
		},
		{
			// Leang
			path: 'borrowingproduct/create',
			name: 'admin.borrowingproduct.create',
			component: BorrowingCreate
		},
		{
			// Leang
			path: 'borrowingproduct/:id',
			name: 'admin.borrowingproduct.edit',
			component: BorrowingEdit
		},
		{
			// Leang
			path: 'category',
			name: 'admin.category',
			component: CategoryList
		},
		{
			// Leang
			path: 'category/create',
			name: 'admin.category.create',
			component: CategoryCreate
		},
		{
			// Leang
			path: 'category/:id',
			name: 'admin.category.edit',
			component: CategoryEdit
		},

		{
			// Leang
			path: 'product/create',
			name: 'admin.product.create',
			component: ProductCreate
		},
		{
			// Leang
			path: 'product/:id',
			name: 'admin.product.edit',
			component: ProductEdit
		},

		{
			// Leang
			path: 'student',
			name: 'admin.student',
			component: StudentList
		},
		{
			// Leang
			path: 'student/create',
			name: 'admin.student.create',
			component: StudentCreate
		},
		{
			// Leang
			path: 'student/edit/:id',
			name: 'admin.student.edit',
			component: StudentEdit
		},
		
		{
			path: 'department/create',
			name:'admin.department.create',
			component: DepartmentCreate
		},
		{
			path: 'department/edit/:id',
			name:'admin.department.edit',
			component: DepartmentEdit
		},

		{
			path: 'room/create',
			name:'admin.room.create',
			component: RoomCreate
		},
		// {
		// 	path: 'room/:id',
		// 	name:'admin.room.create',
		// 	component: RoomCreate
		// },
		{
			path: 'project/:id',
			name: 'admin.project.detail',
			component: ProjectDetail
		},
//
		{
			path: 'side-manager',
			name: 'admin.side-manager',
			component: SideManager
		},
		{
			path: 'assistant',
			name: 'admin.assistant',
			component: Assistant
		},
// 		{
// 			path: 'employee/free',
// 			name: 'admin.employee.free',
// 			component: FreeEmployee
// 		},
// //
		{
			path: 'worker',
			name: 'admin.worker',
			component: Worker
		},
		{
			path: 'worker/create',
			name: 'admin.worker.create',
			component: WorkerCreate
		},
		// {
		// 	path: 'employee/:id',
		// 	name: 'admin.employee.detail',
		// 	component: EmployeeDetail
		// },
		{
			path: 'role',
			name: 'admin.role',
			component: Role
		},
		{
			path: 'report',
			name: 'admin.report',
			component: Report
		},
	//
		{
			path: 'project/card/:id',
			name: 'admin.project.card',
			component: ProjectCard
		},
		// {
		// 	path: 'card/setting',
		// 	name: 'admin.card.setting',
		// 	component: CardSetting
		// },
		{
			path: 'room',
			name: 'admin.room',
			component: RoomList
		},
		{
			path: 'schedule',
			name: 'admin.schedule',
			component: Schedule
		},
		{
			path: 'user/create',
			name: 'admin.user.create',
			component: UserCreate
		},
		{
			path: 'employee',
			name: 'admin.employee',
			component: EmployeeList
		},
		{
			path: 'employee/create',
			name: 'admin.employee.create',
			component: EmployeeCreate
		},
		{
			path: 'employee/edit/:id',
			name: 'admin.employee.edit',
			component: EmployeeEdit
		},
		{
			path: 'user',
			name: 'admin.user',
			component: User
		}
	]
}