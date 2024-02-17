<template>
  preview flux rss

  <v-card>
    <v-card-title>
      <h3 class="text-h5">Prévisualisation</h3>
    </v-card-title>
    <v-card-text v-if="fluxRss">
      <ArticlesOverflowX :fluxRss="fluxRss"></ArticlesOverflowX>
    </v-card-text>
    <v-card-text v-else class="text-center">
      <h1>Le flux RSS ne fonctionne pas</h1>
    </v-card-text>
    <v-card-actions>
      <v-spacer></v-spacer>
      <v-btn color="primary" @click="close"> Fermer </v-btn>
      <v-btn color="success" @click="create"> Enregistrer </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script lang="ts" setup>
import { defineProps } from "vue";
import ArticlesOverflowX from "../card/ArticlesOverflowX.vue";

const emit = defineEmits(["create", "close"]);

const create = () => {
  emit("create");
};

const close = () => {
  emit("close");
};

const props = defineProps({
  fluxRss: {
    type: Object,
    required: true,
  },
});
</script>
