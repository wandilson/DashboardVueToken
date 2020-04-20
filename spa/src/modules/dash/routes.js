const routes = [
	{
		path: '/login',
		name: 'login',
		component: () => import('./pages/Login'),
	},
	{
		path: '/register',
		name: 'register',
		component: () => import('./pages/Register'),
	},
	
	
	
	
	{
		path: '/app',
		name: 'app',
		component: () => import('./pages/Home'),
		meta: { requiresAuth: true }
	},
	{
		path: '/profile',
		name: 'profile',
		component: () => import('./pages/Profile'),
		meta: { requiresAuth: true }
	},
	{
		path: '/users',
		name: 'users',
		component: () => import('./pages/Users'),
		meta: { requiresAuth: true }
	},



	
	{
		path: '/bank',
		name: 'bank',
		component: () => import('./pages/Bank'),
		meta: { requiresAuth: true }
	}
]

export default routes