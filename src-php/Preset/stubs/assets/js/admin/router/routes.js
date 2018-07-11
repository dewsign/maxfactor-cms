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
    },
    {
        path: '/user/create',
        name: 'user.create',
        component: UserShow,
    },
    {
        path: '/user/:id',
        name: 'user.show',
        component: UserShow,
    },
    {
        path: '/role',
        name: 'role.index',
        component: RoleIndex,
    },
    {
        path: '/role/create',
        name: 'role.create',
        component: RoleShow,
    },
    {
        path: '/role/:id',
        name: 'role.show',
        component: RoleShow,
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
