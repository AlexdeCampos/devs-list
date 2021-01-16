const componentImport = view => () =>
    import (`../views/${view}.vue`)

import Developers from '../views/Developers.vue'

export default [{
        path: "/developers",
        name: "developers",
        component: Developers,
    },
    {
        path: '/',
        redirect: '/developers'
    }
];