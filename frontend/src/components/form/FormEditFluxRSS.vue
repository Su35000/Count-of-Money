<template>
  <v-card>
    <v-card-title primary-title>
      Modifier un flux RSS
      <v-spacer></v-spacer>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field
          v-model="props.article.url"
          label="URL du flux RSS"
        ></v-text-field>
        <v-text-field v-model="props.article.site" label="Site"></v-text-field>
        <v-text-field
          v-model="props.article.topique"
          label="Topique"
        ></v-text-field>
        <v-text-field
          v-model="props.article.categorie"
          label="Categorie"
        ></v-text-field>
        <v-text-field
          v-model="props.article.langue"
          label="Langue"
        ></v-text-field>
        <div class="d-flex justify-end">
          <v-btn color="primary" class="ma-2 pa-2" @click="editFluxRSS">
            Modifier
          </v-btn>
          <v-btn color="primary" class="ma-2 pa-2" @click="close">
            Annuler
          </v-btn>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script lang="ts" setup>
const props = defineProps({
  article: {
    type: Object,
    required: true,
  },
});

const emit = defineEmits(["editFluxRSS", "close"]);

const editFluxRSS = () => {
  emit("editFluxRSS", props.article);
};

const close = () => {
  emit("close");
};
</script>
