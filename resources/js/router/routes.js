

export default [
    {
        path: '',
        component: require('../view/front/layout/index-layout').default,
        children: [
            {path: '/', component: require('../view/front/home').default, name: 'home'},
            {path: '/services/adsl/availability-check', component: require('../view/front/adsl-service-availability-check/AdslServiceAvailabilityCheck').default, name: 'adsl-availability-check'},
        ]
    },
    {
        path: '',
        component: require('../view/front/layout/login-register-layout').default,
        children: [
            {path: '/login', component: require('../view/front/login/Login').default, name: 'login'},
            {path: '/register', component: require('../view/front/register/Register').default, name: 'register'},
        ]
    },
    {
        path: '/registerAdsl',
        component: require('../view/front/adsl-register/AdslRegister').default,
        name:'adsl-register'
    }
]
