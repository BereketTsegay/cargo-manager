function page (path) {
    return () => import(/* webpackChunkName: '' */ `../pages/${path}`).then(m => m.default || m)
  }

export default [

    {
        path:'/',
        name:'Dashboard',
        component:page('dashboard.vue')
    },
    {
        path:'/login',
        name:'Login',
        component:page('Auth/login.vue')
    },
    {
        path:'*',
        name:'Notfound',
        component:page('404.vue')
    },
    {
        path:'/forget_password',
        name:'forget_password',
        component:page('Auth/login.vue')
    }
]
