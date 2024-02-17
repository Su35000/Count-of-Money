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
              <v-toolbar dark style="background-color: #f7931a; color: white">
                <v-toolbar-title>Register form</v-toolbar-title>
              </v-toolbar>
              <v-card-text>
                <form ref="form" @submit.prevent="register()">
                  <v-text-field
                    v-model="email"
                    name="email"
                    label="Email"
                    type="email"
                    placeholder="Email"
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
                  <v-text-field
                    v-model="confirmPassword"
                    name="confirmPassword"
                    label="Confirm Password"
                    type="password"
                    placeholder="confirm password"
                    required
                  ></v-text-field>
                  <div class="error-message">{{ errorMessage }}</div>
                  <v-row class="align-center">
                    <v-col cols="6">
                      <v-btn
                        type="submit"
                        class="mt-4"
                        color="#f7931a"
                        value="Register"
                        @@click.native="register"
                        >Register</v-btn
                      >
                    </v-col>
                    <v-col cols="6">
                      <span @click="goToLogin" class="register-link"
                        >Already have an Account? Login you. :)</span
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
.register-link {
  text-decoration-color: peru;
  cursor: pointer;
  text-decoration: underline;
}
.error-message {
  color: red;
  font-weight: bold;
}
</style>
<script lang="ts">
import { userApi } from "@/api/user";

async function createUser(newUser: any): Promise<any> {
  try {
    const response = await userApi.register(newUser);
    return response;
  } catch (error) {
    return error;
  }
}

export default {
  data() {
    return {
      email: "",
      password: "",
      confirmPassword: "",
      errorMessage: "",
    };
  },
  methods: {
    goToLogin() {
      this.$router.push({ name: "Login" });
    },
    async register() {
      if (this.password === this.confirmPassword) {
        this.errorMessage = "";
        const userData = {
          email: this.email,
          password: this.password,
        };
        const response = await createUser(userData);
        if (response.status == 201) {
          this.$router.push({ name: "Login" });
        } else {
          this.errorMessage = "Something went wrong";
        }
      } else {
        this.errorMessage = "Password did not match";
      }
    },
  },
};
</script>
