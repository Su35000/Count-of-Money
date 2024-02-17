<template>
  <v-card>
    <v-card-title primary-title>
      Supprimer un flux RSS
      <v-spacer></v-spacer>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field
          v-model="props.article.url"
          label="URL du flux RSS"
          readonly
        ></v-text-field>
        <div class="d-flex justify-end">
          <!-- <v-icon color="red">mdi mdi-alert-circle-outline</v-icon>
          <span>Attention, cette action est irréversible !</span> -->
          <v-btn color="primary" class="ma-2 pa-2" @click="deleteFluxRSS">
            Supprimer
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

// define emit function
const emit = defineEmits(["deleteFluxRSS", "close"]);

const deleteFluxRSS = () => {
  emit("deleteFluxRSS", props.article);
};

const close = () => {
  emit("close");
};
</script>
