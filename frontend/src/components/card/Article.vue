<template>
  <v-card
    class="mr-2 ml-2 mt-2 mb-2"
    min-width="50ch"
    max-width="400px"
  >
    <v-img
      v-if="props.article.thumbnail"
      :src="props.article.thumbnail"
      height="200px"
      class="my-4"
    ></v-img>
    <v-img
      v-if="props.article.image && !props.article.thumbnail"
      :src="props.article.image"
      height="200px"
      class="my-4"
    ></v-img>
    <v-img
      v-if="props.article.enclosure.link && !props.article.thumbnail && !props.article.image"
      :src="props.article.enclosure.link"
      height="200px"
      class="my-4"
    ></v-img>
    <!-- <v-img
      v-if="
        !props.article.thumbnail &&
        !props.article.image &&
        !props.article.enclosure.link
      "
      src="https://static.vecteezy.com/system/resources/previews/005/337/799/non_2x/icon-image-not-found-free-vector.jpg"
      height="200px"
      class="my-4"
    ></v-img> -->

    <v-card-text class="text-h6" align="center" v-if="props.article.title">
      {{ props.article.title }}
    </v-card-text>

    <v-card-text v-if="description">{{ description }}</v-card-text>
    <v-card-item v-if="props.article.categories">
      <v-chip v-for="category in props.article.categories" :key="category">
        {{ category }}
      </v-chip>
    </v-card-item>
      <div style="height: 2.5em">
        <v-row style="position: absolute; bottom: 0; width: 100%" class="mt-4" height="100%">
          <v-card-actions style="width: 100%">
            <v-card-text v-if="props.article.pubDate">
              {{ getDate(props.article.pubDate) }}
            </v-card-text>
            <v-btn
            v-if="props.article.link"
            :href="props.article.link"
            target="_blank"
            >
            Read more
          </v-btn>
          <v-btn
          @click="deleteArticle"
          align="right"
          v-if="isArticleInUserArticles(props.article)"
          >
          <v-icon>mdi-heart</v-icon>
        </v-btn>
        <v-btn @click="addArticle" align="right" v-else>
          <v-icon>mdi-heart-outline</v-icon>
        </v-btn>
      </v-card-actions>
    </v-row>
  </div>
  </v-card>
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";
import { ArticlesApi } from "@/api/articles";
import { useUserStore } from "@/store/user";
import router from "@/router";

const description = ref<string>("");
const userStore = useUserStore();

const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
});

const getDate = (dateParam: string) => {
  let date: Date = new Date(dateParam);
  return date.toTimeString().split(" ")[0] + " " + date.toLocaleDateString();
};

onMounted(() => {
  // delete all html tags
  description.value = props.article.description.replace(/(<([^>]+)>)/gi, "");
});

// check if article is already in user's articles and return true or false
const isArticleInUserArticles = (article: any) => {
  const articleInUserArticles = userStore.articles.find(
    (articleInUserArticles) => articleInUserArticles.title === article.title,
  );

  if (articleInUserArticles) {
    return true;
  } else {
    return false;
  }
};

const addArticle = async () => {
  if (!userStore.isLogged) {
    router.push("/login");
  }

  const article = props.article;
  const responceArticle = await ArticlesApi.createArticle(article);
  article.id = responceArticle.id;
  userStore.articles.push(article);
};

const deleteArticle = async () => {
  if (!props.article.id) {
    // check if article is in user's articles
    const articleInUserArticles = userStore.articles.find(
      (articleInUserArticles) =>
        articleInUserArticles.title === props.article.title,
    );

    // if article is in user's articles, delete it
    if (articleInUserArticles) {
      userStore.articles = userStore.articles.filter(
        (article) => article.title !== props.article.title,
      );

      await ArticlesApi.deleteArticle(articleInUserArticles.id);
    }
  } else {
    // delete article from database
    await ArticlesApi.deleteArticle(props.article.id);

    userStore.articles = userStore.articles.filter(
      (article) => article.id !== props.article.id,
    );
  }
};
</script>
