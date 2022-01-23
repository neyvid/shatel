export default [
    {
        path: '',
        component: require('../view/front/layout/index-layout').default,
        children: [
            {path: '/', component: require('../view/front/home').default, name: 'home'},
            {
                path: '/services/adsl/availability-check',
                component: require('../view/front/adsl-service-availability-check/AdslServiceAvailabilityCheck').default,
                name: 'adsl-availability-check'
            },
        ]
    },
    {
        path: '',
        component: require('../view/front/layout/login-register-layout').default,
        children: [
            {
                path: '/login',
                component: require('../view/front/login/Login').default,
                name: 'login',
                meta: {guest: true}
            },
            {
                path: '/register',
                component: require('../view/front/register/Register').default,
                name: 'register',
                meta: {guest: true}
            },
        ]
    },
    {
        path: '/registerAdsl',
        component: require('../view/front/adsl-register/AdslRegister').default,
        name: 'adsl-register'
    },
    {
        path: '/verify-email',
        component: require('../view/front/register/VerifyEmail').default,
        name: 'verify-email'
    },
    {
        path: '/verify-mobile',
        component: require('../view/front/register/VerifyMobile').default,
        name: 'verify-mobile'
    },
    {
        path: '/reset-password-form-request',
        component: require('../view/front/login/ForgotPasswordRequestForm').default,
        name: 'reset-password-form',
        meta: {guest: true}
    },
    {
        path: '/password/reset/:token',
        component:require('../view/front/login/ResetPassword').default,
        name:'reset-password',
        meta: {guest: true}
    }
]
