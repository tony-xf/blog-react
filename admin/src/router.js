import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import ArticleList from './modules/article/List.vue'
import ArticleEdit from './modules/article/Edit.vue'
import ArticleCategotyEdit from './modules/article/EditCategory.vue'

const routes = [
    { path: '/article/list', component: ArticleList},
    { path: '/article/add', component: ArticleEdit},
    { path: '/article_c/add', component: ArticleCategotyEdit}
];
const router = new VueRouter({
    routes
})
export default router;
