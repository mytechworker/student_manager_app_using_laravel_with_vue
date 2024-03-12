import { createRouter,createWebHistory } from "vue-router";

// import home from '../components/pages/home/index.vue'
import StudentList from '../components/StudentList.vue'
import AddStudent from '../components/AddStudent.vue';

const routes = [
    {
        path: '/',
        name: 'StudentList',
        component: StudentList
    },
    {
        path: '/add',
        name: 'AddStudent',
        component: AddStudent
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

export default router;