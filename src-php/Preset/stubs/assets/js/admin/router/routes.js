import UserIndex from '../components/User/UserIndex.vue'
import UserShow from '../components/User/UserShow.vue'
import RoleIndex from '../components/User/Role/RoleIndex.vue'
import RoleShow from '../components/User/Role/RoleShow.vue'
// import LanguageIndex from '../components/Language/LanguageIndex.vue'
// import LanguageShow from '../components/Language/LanguageShow.vue'


export default [
    {
        path: '/user',
        name: 'user.index',
        component: UserIndex,
        meta: {
            title: 'All User Accounts',
        },
    },
    {
        path: '/user/create',
        name: 'user.create',
        component: UserShow,
        meta: {
            title: 'Create a new User Account',
        },
    },
    {
        path: '/user/:id',
        name: 'user.show',
        component: UserShow,
        meta: {
            title: 'Edit User',
        },
    },
    {
        path: '/role',
        name: 'role.index',
        component: RoleIndex,
        meta: {
            title: 'All Roles',
        },
    },
    {
        path: '/role/create',
        name: 'role.create',
        component: RoleShow,
        meta: {
            title: 'Create a new Role',
        },
    },
    {
        path: '/role/:id',
        name: 'role.show',
        component: RoleShow,
        meta: {
            title: 'Edit Role',
        },
    },
    // {
    //     path: '/language',
    //     name: 'language.index',
    //     component: LanguageIndex,
    // },
    // {
    //     path: '/language/create',
    //     name: 'language.create',
    //     component: LanguageShow,
    // },
    // {
    //     path: '/language/:id',
    //     name: 'language.show',
    //     component: LanguageShow,
    // },
]
