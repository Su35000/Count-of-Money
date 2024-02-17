<template>
  <v-card>
    <v-data-table class="mr-4" :headers="headers" :items="items" hide-actions>
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>
            <span class="title font-weight-light">Cryptomonnaies</span>
          </v-toolbar-title>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon
          size="small"
          class="me-2"
          @click="addToFavoris(item)"
          v-if="!item.favorite"
        >
          mdi mdi-plus
        </v-icon>

        <v-icon size="small" @click="deleteFromFavoris(item)" v-else>
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:item.infoBtn="{ item }">
        <v-btn variant="plain" prepend-icon="mdi mdi-information" :href="item.info" target="_blank"></v-btn>
      </template>
    </v-data-table>
  </v-card>
</template>

<script lang="ts" setup>
import { useCryptomonnaiesStore } from "@/store/cryptomonnaies";
import { useUserStore } from "@/store/user";
import { cryptoApi } from "@/api/crypto";
import {onMounted, reactive} from "vue";
import router from "@/router";

const cryptomonnaiesStore = useCryptomonnaiesStore();
const userStore = useUserStore();

const items: [] = reactive([])

const headers = [
  { title: "Classement", key: "rank", align: "center" },
  { title: "Nom", key: "id" },
  { title: "Symbole", key: "symbol" },
  { title: "Prix USD", key: "priceUsd"},
  { title: "Taux de change", key: "changePercent24Hr" },
  { title: "Info", key: "infoBtn", align: "center" },
  { title: "Favoris", key: "actions", align: "center" },
];

onMounted(async () => {
  await cryptomonnaiesStore.fetchCryptomonnaies();
  // await userStore.getCurrentUser();
  reloadTable();
});

const reloadTable = () => {
  items.push(...cryptomonnaiesStore.cryptomonnaies.map((crypto) => {
    return {
      rank: crypto.rank,
      symbol: crypto.symbol,
      id: crypto.id,
      priceUsd: Math.round(crypto.priceUsd * 100) / 100 + " $",
      changePercent24Hr: Math.round(crypto.changePercent24Hr * 100) / 100 + " %",
      favorite: isFavoris(crypto),
      info: crypto.explorer
    };
  }))
};

const addToFavoris = async (item: any) => {
  if (!userStore.isLogged) {
    router.push({ name: "Login" });
    return;
  }

  const response = await cryptoApi.addCrypto({ name: item.id });
  if (response.status === 201) {
    userStore.crypto.push({ id: response.data.id, name: response.data.name });
  }
  items[items.indexOf(item)].favorite = true
};

const deleteFromFavoris = async (item: any) => {
  const id = userStore.crypto.find((crypto) => crypto.name === item.id)?.id;
  const response = await cryptoApi.deleteCrypto(id);
  if (response.status === 200) {
    userStore.crypto = userStore.crypto.filter(
      (crypto) => crypto.id !== item.id,
    );
    items[items.indexOf(item)].favorite = false
  }
};

const isFavoris = (item: any) => {
  return !!userStore.crypto.find((el) => el.name === item.id)
};
</script>
