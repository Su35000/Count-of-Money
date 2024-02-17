<template>
  <div v-if="articles.length > 0">
    <v-card-title>
      {{ props.fluxRss.site }} - {{ props.fluxRss.topique }} -
      {{ props.fluxRss.categorie }}
    </v-card-title>
    <div class="d-flex flex-row overflow-x-auto">
      <Article
        v-for="article in articles"
        :key="article.title"
        :article="article"
      ></Article>
    </div>
  </div>
  <!-- <div v-else>
    {{ props.fluxRss.site }}
  </div> -->
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";
import Article from "@/components/card/Article.vue";

const props = defineProps({
  fluxRss: {
    type: Object,
    required: true,
  },
});

const articles = ref<any>([]);

const getArticles = async () => {
  let response;
  try {
    response = await fetch(
      `https://api.rss2json.com/v1/api.json?rss_url=${props.fluxRss.url}`,
    );

    const data = await response.json();
    articles.value = articles.value.concat(data.items);
  } catch (error) {
    console.error("error: ", error);
  }
};

onMounted(async () => {
  await getArticles();
});
</script>
