function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  // The route to the home page will redirect the user to the login form
  { path: '/', name: 'dashboard', component: page('dashboard.vue') },

  // The routes to the login and registration system
  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  // The routes to the settings section: profile and password
  {
    path: '/settings',
    component: page('settings/index.vue'),
    children: [
      { path: '', redirect: { name: 'settings.profile' } },
      { path: 'profile', name: 'settings.profile', component: page('settings/profile.vue') },
      { path: 'password', name: 'settings.password', component: page('settings/password.vue') }
    ]
  },

  // The route to the documents section
  { path: '/documents/how-to-use-this-app', name: 'documents.documentation', component: page('documents/documentation.vue') },

  // The route to display error message if the user is requesting for a resource that do not exist
  { path: '*', component: page('errors/404.vue') }
]
