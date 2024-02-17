<template>
  <div v-if="userStore.articles.length !== 0">
    <v-card-title>
      <h1>Mes articles</h1>
    </v-card-title>
    <v-card-text>
      <div class="d-flex flex-wrap">
        <Article
          v-for="article in userStore.articles"
          :key="article.title"
          :article="article"
          max-width="400px"
        ></Article>
      </div>
    </v-card-text>
  </div>
  <div class="d-flex justify-center align-center" style="height: 100%" v-else>
    <h1>Vous n'avez pas encore d'articles</h1>
  </div>
</template>

<script lang="ts" setup>
import { onMounted } from "vue";
import { useUserStore } from "@/store/user";
import Article from "@/components/card/Article.vue";

const userStore = useUserStore();

onMounted(async () => {
  await userStore.getCurrentUser();
});
</script>
