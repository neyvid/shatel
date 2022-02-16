export default [
    //FRONT END ROUTES
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
        name: 'verify-email',
        meta: {auth: true}

    },
    {
        path: '/verify-mobile',
        component: require('../view/front/register/VerifyMobile').default,
        name: 'verify-mobile',
        meta: {auth: true}
    },
    {
        path: '/reset-password-form-request',
        component: require('../view/front/login/ForgotPasswordRequestForm').default,
        name: 'reset-password-form',
        meta: {guest: true}
    },
    {
        path: '/password/reset/:token',
        component: require('../view/front/login/ResetPassword').default,
        name: 'reset-password',
        meta: {guest: true}
    },
//    Admin Routes
    {
        path: '/profile',
        component: require('../view/profile/layout/index-layout').default,
        children: [
            {
                path: '',
                component: require('../view/profile/home').default,
                name: '',

            },
            {
                path: 'cities', //profile/cities
                component: require('../view/profile/cities/index').default,
                name: 'cities',

            },
            {
                path: 'provinces', //profile/cities
                component: require('../view/profile/provinces/index').default,
                name: 'provinces',

            },
            {
                path: 'editor', //profile/cities
                component: require('../view/profile/editor/editor').default,
                name: 'editor',

            },
            {
                path: 'telecomeCenters', //profile/telecomeCenters
                component: require('../view/profile/telecomeCenters/index').default,
                name: 'telecomeCenters',

            }
        ]
    }

]
