<template>
  <v-card v-if="filteredCryptos.length !== 0">
    <v-data-table
      class="mr-4"
      :headers="headers"
      :items="filteredCryptos"
      hide-actions
    >
      <template v-slot:top>
        <v-toolbar flat>
          <v-toolbar-title>
            <span class="title font-weight-light">Mes cryptomonnaies</span>
          </v-toolbar-title>
        </v-toolbar>
      </template>
      <template v-slot:item.actions="{ item }">
        <v-icon size="small" @click="deleteFromFavoris(item)">
          mdi-delete
        </v-icon>
      </template>
      <template v-slot:item.info="{ item }">
        <v-btn variant="plain" prepend-icon="mdi mdi-information" class="me-2" :href="item.explorer" target="_blank"></v-btn>
      </template>
    </v-data-table>
  </v-card>
  <div class="d-flex justify-center align-center" style="height: 100%" v-else>
    <h1>Vous n'avez pas de cryptomonnaies dans vos favoris</h1>
  </div>
</template>

<script lang="ts" setup>
import { computed } from "vue";
import { useUserStore } from "@/store/user";
import { useCryptomonnaiesStore } from "@/store/cryptomonnaies";
import { onMounted } from "vue";
import { cryptoApi } from "@/api/crypto";

const userStore = useUserStore();
const cryptomonnaiesStore = useCryptomonnaiesStore();

const headers = [
  { title: "Classement", key: "rank", align: "center" },
  { title: "Nom", key: "id" },
  { title: "Symbole", key: "symbol" },
  { title: "Prix USD", key: "priceUsd"},
  { title: "Taux de change", key: "changePercent24Hr" },
  { title: "Info", key: "info", align: "center" },
  { title: "Favoris", key: "actions", align: "center" },
];

onMounted(async () => {
  if (cryptomonnaiesStore.cryptomonnaies.length === 0) {
    await cryptomonnaiesStore.fetchCryptomonnaies();
  }
  await userStore.getCurrentUser();
});

const filteredCryptos = computed(() => {
  return cryptomonnaiesStore.cryptomonnaies.filter((crypto) => {
    return userStore.crypto.find((cryptoUser) => cryptoUser.name === crypto.id);
  });
});

const deleteFromFavoris = async (item: any) => {
  const id = userStore.crypto.find((crypto) => crypto.name === item.id)?.id;
  const response = await cryptoApi.deleteCrypto(id);
  if (response.status === 200) {
    userStore.crypto = userStore.crypto.filter(
      (crypto) => crypto.id !== item.id,
    );
  }
  window.location.reload();
};
</script>
