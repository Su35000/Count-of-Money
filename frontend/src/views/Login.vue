<template>
  <v-app>
    <v-main>
      <v-container
        class="d-flex justify-center align-center"
        :style="{ height: '100%' }"
        fluid
      >
        <v-row justify="center">
          <v-col
            class="login-container"
            cols="12"
            sm="9"
            md="6"
            lg="4"
            justify="center"
          >
            <v-card class="elevation-12">
              <v-toolbar dark color="#f7931a">
                <v-toolbar-title>Login form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <form ref="form" @submit.prevent="login()">
                  <v-text-field
                    v-model="email"
                    name="email"
                    label="Email"
                    type="email"
                    placeholder="email"
                    required
                  ></v-text-field>
                  <v-text-field
                    v-model="password"
                    name="password"
                    label="Password"
                    type="password"
                    placeholder="password"
                    required
                  ></v-text-field>
                  <div class="error-message">{{ errorMessage }}</div>
                  <v-row class="align-center">
                    <v-col cols="6">
                      <v-btn
                        type="submit"
                        class="mt-4"
                        color="#f7931a"
                        value="log in"
                        >Login</v-btn
                      >
                    </v-col>
                    <v-col cols="6">
                      <span @click="goToRegister" class="register-link"
                        >Don't have an Account? Register you. :)</span
                      >
                    </v-col>
                  </v-row>
                </form>
              </v-card-text>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
  </v-app>
</template>

<script lang="ts" setup>
import { ref } from "vue";
import axios from "axios";
import { useUserStore } from "@/store/user";
import { userApi } from "@/api/user";

const email = ref("user@mail.com");
const password = ref("user");
let errorMessage = ref("");

const goToRegister = () => {
  window.location.href = "/register";
};

const login = async () => {
  const data = {
    username: email.value,
    password: password.value,
  };

  try {
    const response = await userApi.login(data);

    if (response.status == 200) {
      sessionStorage.setItem("token", JSON.stringify(response.data.token));
      window.location.href = "/";
    } else {
      console.error(response);
      // TODO: show error message in toast
    }
  } catch (err) {
    console.error(err);
    errorMessage.value = "Mot de passe ou email incorrect";
  }

  // const request = axios
  //   .post("http://localhost:8000/api/login", data)
  //   .then((res) => {
  //     if (res.data.token) {
  //       sessionStorage.setItem("token", JSON.stringify(res.data.token));
  //     }
  //     // redirect to admin page
  //     window.location.href = "/";
  //   })
  //   .catch((err) => {
  //     console.error(err);
  //   });
};
</script>

<style scoped>
.login-container {
  max-width: 100%;
}
.d-flex {
  display: flex;
}
.justify-center {
  justify-content: center;
}
.align-center {
  align-items: center;
}

.error-message {
  color: red;
  font-weight: bold;
}
.register-link {
  color: var(--v-primary-base);
  cursor: pointer;
  text-decoration: underline;
}
</style>
