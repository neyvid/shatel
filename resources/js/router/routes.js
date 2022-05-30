import store from "../store";

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
        name: 'adsl-register',


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
//    user Panel Routes
    {
        path: '/panel',
        component: require('../view/profile/layout/index-layout').default,

        children: [
            {
                path: '',
                component: require('../view/profile/home').default,
                name: 'userprofile',
                meta: {auth: true,canSeeUser:true},
            },
            {
                path: 'my-order',
                component: require('../view/panel/order/index').default,
                name: 'my-order',
                meta: {auth: true,canSeeUser:true},
            },

        ],

    },
//    Admin Routes
    {
        path: '/profile',
        component: require('../view/profile/layout/index-layout').default,

        children: [
            {
                path: '',
                component: require('../view/profile/home').default,
                name: 'profile',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'cities', //profile/cities
                component: require('../view/profile/cities/index').default,
                name: 'cities',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'provinces', //profile/cities
                component: require('../view/profile/provinces/index').default,
                name: 'provinces',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'editor', //profile/cities
                component: require('../view/profile/editor/editor').default,
                name: 'editor',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'telecomeCenters', //profile/telecomeCenters
                component: require('../view/profile/telecomeCenters/index').default,
                name: 'telecomeCenters',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'areacode', //profile/telecomeCenters
                component: require('../view/profile/areacode/index').default,
                name: 'areacode',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'oprator', //profile/oprator
                component: require('../view/profile/oprator/index').default,
                name: 'oprator',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'service', //profile/oprator
                component: require('../view/profile/service/index').default,
                name: 'service',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'category', //profile/oprator
                component: require('../view/profile/category/index').default,
                name: 'category',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'product',
                component: require('../view/profile/product/index').default,
                name: 'product',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'order',
                component: require('../view/profile/order/index').default,
                name: 'order',
                meta: {auth: true,canSeeUser:false},
            },
            {
                path: 'menu',
                component: require('../view/profile/menu/index').default,
                name: 'menu',
                meta: {auth: true,canSeeUser:false},
            },

        ],

    }

]
