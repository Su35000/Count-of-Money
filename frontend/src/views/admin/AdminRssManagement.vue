<template>
  <v-card>
    <v-data-table
      class="mr-4"
      style="max-width: 100%"
      :headers="headers"
      :items="fluxRssStore.flux"
      :sort-by="[{ key: 'id', order: 'asc' }]"
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>
            <span class="title font-weight-light">Rss Flux</span>
          </v-toolbar-title>
          <v-divider class="mx-4" inset vertical></v-divider>
          <v-spacer></v-spacer>
          <v-dialog v-model="dialogCreate" max-width="500px" persistent>
            <form-create-flux-r-s-s
              @close="dialogCreate = false"
              @createFluxRSS="createItem"
            ></form-create-flux-r-s-s>
          </v-dialog>
          <v-btn color="primary" @click="dialogCreate = true">
            <v-icon>mdi-plus</v-icon>
            <span class="hidden-sm-and-down">Ajouter un flux RSS</span>
          </v-btn>
        </v-toolbar>
      </template>
      <template v-slot:item.nombreArticles="{ item }">
        <span v-if="item.nombreArticles > 0">{{ item.nombreArticles }}</span>
        <span v-else>
          <v-icon color="red">mdi mdi-alert-circle-outline</v-icon>
        </span>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon size="small" class="me-2" @click="editItemForm(item)">
          mdi-pencil
        </v-icon>

        <v-dialog v-model="dialogEdit" max-width="500px" persistent>
          <form-edit-flux-r-s-s
            @close="dialogEdit = false"
            @editFluxRSS="editItem(selectedItemForEdit)"
            :article="selectedItemForEdit"
          ></form-edit-flux-r-s-s>
        </v-dialog>

        <v-icon size="small" @click="deleteItemForm(item)"> mdi-delete </v-icon>

        <v-dialog v-model="dialogDelete" max-width="500px" persistent>
          <form-delete-flux-r-s-s
            @close="dialogDelete = false"
            @deleteFluxRSS="deleteItem(selectedItemForDelete)"
            :article="selectedItemForDelete"
          ></form-delete-flux-r-s-s>
        </v-dialog>
      </template>
    </v-data-table>
  </v-card>
</template>

<script lang="ts" setup>
import { onMounted, ref } from "vue";
import { useFluxRssStore } from "../../store/fluxRss";
import { fluxRssApi } from "@/api/fluxRss";
import FormDeleteFluxRSS from "@/components/form/FormDeleteFluxRSS.vue";
import FormEditFluxRSS from "@/components/form/FormEditFluxRSS.vue";
import FormCreateFluxRSS from "@/components/form/FormCreateFluxRSS.vue";

const fluxRssStore = useFluxRssStore();
const dialogDelete = ref(false);
const dialogEdit = ref(false);
const dialogCreate = ref(false);
const selectedItemForEdit = ref();
const selectedItemForDelete = ref();

const headers = [
  { title: "id", key: "id" },
  { title: "Url", key: "url" },
  { title: "Site", key: "site" },
  { title: "Topique", key: "topique" },
  { title: "Categorie", key: "categorie" },
  { title: "Langue", key: "langue" },
  { title: "Nombre d'articles", key: "nombreArticles" },
  { title: "Actions", key: "actions", sortable: false },
];

const editItemForm = (item: any) => {
  selectedItemForEdit.value = item;
  dialogEdit.value = true;
};

const deleteItemForm = (item: any) => {
  selectedItemForDelete.value = item;
  dialogDelete.value = true;
};

onMounted(async () => {
  await fluxRssStore.fetchFluxRss();

  // ajouter le nombre d'articles dans le tableau pour chaque flux rss
  fluxRssStore.flux.forEach(async (fluxRss: any) => {
    fluxRss.nombreArticles = await getNumberOfArticles(fluxRss);
  });
});

const getNumberOfArticles = async (article: any) => {
  let response;
  try {
    response = await fetch(
      `https://api.rss2json.com/v1/api.json?rss_url=${article.url}`,
    );

    const data = await response.json();

    // check if items is not undefined
    if (data.items === undefined) {
      return 0;
    }

    return data.items.length;
  } catch (error) {
    console.error("error: ", error);
    return 0;
  }
};

const editItem = async (item: any) => {
  await fluxRssApi.updateFluxRss(item.id, item);
  // update item in store
  const index = fluxRssStore.flux.findIndex(
    (article: any) => article.id === item.id,
  );
  fluxRssStore.flux[index] = item;
  dialogEdit.value = false;
};

const deleteItem = async (item: any) => {
  await fluxRssApi.deleteFluxRss(item.id);
  fluxRssStore.flux = fluxRssStore.flux.filter(
    (article: any) => article.id !== item.id,
  );
  dialogDelete.value = false;
};

const createItem = async (article: any) => {
  await fluxRssApi.createFluxRss(article);
  fluxRssStore.flux.push(article);
  dialogCreate.value = false;
};
</script>
