<template>
  <v-card>
    <v-card-title primary-title>
      Créer un flux RSS
      <v-spacer></v-spacer>
    </v-card-title>
    <v-card-text>
      <v-form>
        <v-text-field
          v-model="article.url"
          label="URL du flux RSS"
        ></v-text-field>
        <v-text-field v-model="article.site" label="Site"></v-text-field>
        <v-text-field v-model="article.topique" label="Topique"></v-text-field>
        <v-text-field
          v-model="article.categorie"
          label="Categorie"
        ></v-text-field>
        <v-text-field v-model="article.langue" label="Langue"></v-text-field>
        <div class="d-flex justify-end">
          <!-- <v-btn color="primary" class="ma-2 pa-2" @click="createFluxRSS">
            Créer
          </v-btn> -->
          <v-btn color="primary" class="ma-2 pa-2" @click="close">
            Annuler
          </v-btn>
          <v-btn
            color="primary"
            class="ma-2 pa-2"
            @click="formPreviewFluxRSS = true"
          >
            Prévisualiser
          </v-btn>
          <v-dialog v-model="formPreviewFluxRSS" max-width="80%">
            <!-- <template v-slot:activator="{ on }"></template> -->
            <FormPreviewFluxRSS
              :fluxRss="article"
              @close="formPreviewFluxRSS = false"
              @create="createFluxRSS"
            >
            </FormPreviewFluxRSS>
          </v-dialog>
        </div>
      </v-form>
    </v-card-text>
  </v-card>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import FormPreviewFluxRSS from "./FormPreviewFluxRSS.vue";

const formPreviewFluxRSS = ref(false);

const article = ref({
  url: "",
  site: "",
  topique: "",
  categorie: "",
  langue: "",
});

const emit = defineEmits(["createFluxRSS", "close"]);

const createFluxRSS = () => {
  emit("createFluxRSS", article.value);
};

const close = () => {
  emit("close");
};
</script>
