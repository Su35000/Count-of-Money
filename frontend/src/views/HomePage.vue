<template>
  <v-col v-for="fluxRss in fluxRssArray" :key="fluxRss.id">
    <ArticlesOverflowX :fluxRss="fluxRss"></ArticlesOverflowX>
  </v-col>
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";
import ArticlesOverflowX from "@/components/card/ArticlesOverflowX.vue";
import { useFluxRssStore } from "@/store/fluxRss";
import { useUserStore } from "@/store/user";

const articlesStore = useFluxRssStore();
const userStore = useUserStore();
const fluxRssArray = ref<any[]>();

onMounted(async () => {
  await articlesStore.fetchFluxRss();
  fluxRssArray.value = articlesStore.flux;
  const token = sessionStorage.getItem("token");
  if (token) {
    await userStore.getCurrentUser();
  }
});
</script>
