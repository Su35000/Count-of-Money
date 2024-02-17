// Composables
import { createRouter, createWebHistory } from "vue-router";
import type { NavigationGuardNext, RouteLocationNormalized } from "vue-router";
import HomePageVue from "@/views/HomePage.vue";
import HomeCrypto from "@/views/HomeCrypto.vue";
import DefaultLayout from "@/layouts/default/Default.vue";
import UserActiclesVue from "@/views/UserActicles.vue";
import UserCryptoVue from "@/views/UserCrypto.vue";
import AdminRssManagementVue from "@/views/admin/AdminRssManagement.vue";
import LoginVue from "@/views/Login.vue";
import RegisterVue from "@/views/Register.vue";

const routes = [
  {
    path: "/login",
    name: "Login",
    component: LoginVue,
  },
  {
    path: "/register",
    name: "Register",
    component: RegisterVue,
  },
  {
    path: "/",
    component: DefaultLayout,
    children: [
      {
        path: "",
        name: "HomePage",
        component: HomePageVue,
      },
      {
        path: "/home-crypto",
        name: "HomeCrypto",
        component: HomeCrypto,
      },
      {
        path: "/user-articles",
        name: "UserActicles",
        component: UserActiclesVue,
      },
      {
        path: "/user-crypto",
        name: "UserCrypto",
        component: UserCryptoVue,
      },
      {
        path: "/admin-rss-management",
        name: "AdminRssManagement",
        component: AdminRssManagementVue,
      },
    ],
  },
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
});

router.beforeEach(
  async (
    to: RouteLocationNormalized,
    from: RouteLocationNormalized,
    next: NavigationGuardNext,
  ) => {
    const jwt: string | null = sessionStorage.getItem("token");
    const privetRoutes: string[] = [
      "user-crypto",
      "user-articles",
      "admin-rss-management",
    ];

    if (to.name && !privetRoutes.includes(to.name.toString())) {
      next();
    } else {
      if (!jwt) {
        next({ name: "Login" });
      } else {
        next();
      }
    }
  },
);

export default router;
