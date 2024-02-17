import { defineStore } from "pinia";
import axios from "axios";

export const useCryptomonnaiesStore = defineStore("cryptomonnaies", {
  state: () => ({
    cryptomonnaies: [] as any[],
  }),

  actions: {
    async fetchCryptomonnaies() {
      try {
        const response = await axios.get("https://api.coincap.io/v2/assets");
        this.cryptomonnaies = response.data.data;
      } catch (error) {
        // alert(error);
        console.error(error);
      }
    },
  },
});
