import {createRouter, createWebHistory} from 'vue-router'
import LoginPage from "./pages/LoginPage.vue";
import SignupPage from "./pages/SignupPage.vue";
import MyFiles from "./pages/MyFiles.vue";
import EditFilePage from "./pages/EditFilePage.vue";
import FilePermissionsPage from "./pages/FilePermissionsPage.vue";
import UploadFilePage from "./pages/UploadFilePage.vue";

const routes = [
    {path: '/login', component: LoginPage},
    {path: '/signup', component: SignupPage},
    {path: '/files/upload', component: UploadFilePage},
    {path: '/files/permissions', component: FilePermissionsPage},
    {path: '/files/edit', component: EditFilePage},
    {path: '/files/:type', component: MyFiles},

]

export const router = createRouter({
    history: createWebHistory(),
    routes,
})