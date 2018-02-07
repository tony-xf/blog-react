import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import ArticleList from './modules/article/List.vue'
import ArticleEdit from './modules/article/Edit.vue'

const routes = [
    { path: '/article/list', component: ArticleList},
    { path: '/article/add', component: ArticleEdit}
];
const router = new VueRouter({
    routes
})
export default router;
