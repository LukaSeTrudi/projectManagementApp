<template>
  <v-card class="card">
    <v-card-text>
      <v-card-title style="justify-content: center">Login</v-card-title>
      <v-form v-model="form" ref="form">
        <v-text-field
          v-model="userMail"
          :rules="userMailRules"
          outlined
          @keyup.enter="onLogin"
          label="Enter email or username"
        ></v-text-field>
        <v-text-field
          type="password"
          v-model="pass"
          :rules="passRules"
          outlined
          @keyup.enter="onLogin"
          label="Enter password"
        ></v-text-field>
        <v-btn color="primary" block @click="onLogin">Login</v-btn>
        <v-divider class="my-4"></v-divider>
        <a href="/register">Dont have an account? Register</a>
      </v-form>

      <v-alert dense v-if="alertMessage" :type="alertType">
        {{ alertMessage }}
      </v-alert>
    </v-card-text>
  </v-card>
</template>

<script>
import tokenService from "@/services/token.service";
import storageService from "@/services/storage.service";

import { mapActions } from "vuex";
export default {
  data() {
    return {
      form: false,

      userMail: "",
      pass: "",

      userMailRules: [
        (v) => !!v || "Email or username is required",
        (v) =>
          (v && v.length <= 25) ||
          "Email or username must be less than 25 characters",
      ],

      passRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length >= 6) || "Password must be at least 6 characters",
      ],

      alertMessage: null,
      alertType: "success",
    };
  },

  methods: {
    ...mapActions("auth", ["login", "setUser"]),

    async onLogin() {
      if (!this.$refs.form.validate()) return;

      const response = await this.login({
        userMail: this.userMail,
        password: this.pass,
      });
      if (response) {
        tokenService.setToken(response.token);
        await this.setUser(response.user);
        this.$router.push("/");
      } else {
        this.alertMessage = "Invalid credentials";
        this.alertType = "error";
      }
    },
  },

  mounted() {
    tokenService.clearToken();
    storageService.clearRecents();
  },
};
</script>

<style lang="scss" scoped>
.card {
  width: 500px;
  position: absolute;
  left: 50%;
  top: 40%;
  transform: translate(-50%, -50%);
}
</style>>
