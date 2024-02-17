<template>
  <v-app-bar flat color="#f7931a">
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
    <v-app-bar-title class="ml-0 pl-3">
      <v-icon icon="mdi mdi-currency-btc" />

      Count of money
    </v-app-bar-title>
    <v-spacer></v-spacer>
    <!-- test
    <v-btn icon>
      <v-icon>mdi-magnify</v-icon>
    </v-btn> -->
    <div class="mr-4">
      <v-btn
        v-if="!userStore.isLogged"
        to="/login"
        class="mr-4"
        icon="mdi mdi-account"
        >Login</v-btn
      >
      <v-btn
        v-if="!userStore.isLogged"
        to="/register"
        icon="mdi mdi-account-plus"
        class="mr-4 ml-4"
        >Register</v-btn
      >
      <v-btn
        v-if="userStore.isLogged"
        icon="mdi mdi-account"
        @click="userStore.logout"
        class="mr-4 ml-4"
        to="/"
      >
        Logout
      </v-btn>
    </div>
  </v-app-bar>
  <v-navigation-drawer v-model="drawer" :rail="false">
    <!-- <v-list-item
            prepend-avatar="https://randomuser.me/api/portraits/men/85.jpg"
            title="John Leider"
            nav
          >
          </v-list-item> -->

    <!-- <v-divider></v-divider> -->

    <v-list density="compact" nav>
      <!-- <v-list-item
        prepend-icon="mdi-account"
        title="Account"
        value="account"
        to="/user-account"
      ></v-list-item> -->
      <v-list-item
        prepend-icon="mdi-home-city"
        title="Accueil"
        value="home"
        to="/"
      ></v-list-item>
      <v-list-item
        prepend-icon="mdi mdi-currency-btc"
        title="Cryptomonnaies"
        value="crypto"
        to="/home-crypto"
      ></v-list-item>
      <v-list-item
        prepend-icon="mdi-account-group-outline"
        title="Mes articles"
        value="mesArticles"
        to="/user-articles"
        v-if="userStore.isLogged"
      ></v-list-item>
      <v-list-item
        prepend-icon="mdi mdi-currency-btc"
        title="Mes cryptomonnaies"
        value="mesCrypto"
        to="/user-crypto"
        v-if="userStore.isLogged"
      ></v-list-item>
      <!-- Add part for admin -->
      <v-list-item
        prepend-icon="mdi mdi-rss"
        title="Manage rss flux"
        value="adminRss"
        to="/admin-rss-management"
        v-if="userStore.roles.includes('ROLE_ADMIN')"
      ></v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import { useUserStore } from "@/store/user";
import { onMounted } from "vue";

const userStore = useUserStore();

onMounted(async () => {
  await userStore.getCurrentUser();
});

const drawer = ref(true);
</script>
