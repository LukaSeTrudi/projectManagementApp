<template>
  <v-card class="card">
    <v-card-text>
      <v-card-title style="justify-content: center">Register</v-card-title>
      <v-form v-model="form" ref="form">
        <v-text-field
          v-model="username"
          :rules="usernameRules"
          outlined
          @keyup.enter="onRegister"
          label="Enter username"
        ></v-text-field>
        <v-text-field
          v-model="display_name"
          :rules="display_nameRules"
          outlined
          @keyup.enter="onRegister"
          label="Enter display name"
        ></v-text-field>
        <v-text-field
          v-model="email"
          outlined
          :rules="emailRules"
          @keyup.enter="onRegister"
          label="Enter email"
        ></v-text-field>
        <v-text-field
          type="password"
          v-model="password"
          outlined
          :rules="passwordRules"
          @keyup.enter="onRegister"
          label="Enter password"
        ></v-text-field>
        <v-btn color="primary" block @click="onRegister">Register</v-btn>
        <v-divider class="my-4"></v-divider>
        <a href="/login">Already have an account? Login</a>
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
      username: "",
      display_name: "",
      email: "",
      password: "",
      alertMessage: null,
      alertType: "success",

      usernameRules: [
        (v) => !!v || "Username is required",
        (v) =>
          (v && v.length <= 25) || "Username must be less than 25 characters",
      ],

      display_nameRules: [(v) => !!v || "Display name is required"],

      emailRules: [
        (v) => !!v || "Email is required",
        (v) => /.+@.+\..+/.test(v) || "E-mail must be valid",
      ],

      passwordRules: [
        (v) => !!v || "Password is required",
        (v) => (v && v.length >= 6) || "Password must be at least 6 characters",
      ],
    };
  },

  methods: {
    ...mapActions("auth", ["register"]),

    async onRegister() {
      if (!this.$refs.form.validate()) return;

      const success = await this.register({
        username: this.username,
        display_name: this.display_name,
        email: this.email,
        password: this.password,
      });
      
      if (success.success) {
        this.alertType = "success";
        this.alertMessage = "Successfully registered. Redirecting to login...";
        setTimeout(() => {
          this.$router.push("/login");
        }, 1000);
      } else {
        this.alertType = "error";
        this.alertMessage =
          "Registration failed. Please try again with different username or email";
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
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>>
