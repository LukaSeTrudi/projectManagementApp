<template>
  <v-app>
    <AppBar v-if="!isPublic"></AppBar>
    <v-main>
      <v-container fluid><router-view /> </v-container>
    </v-main>
  </v-app>
</template>

<script>
import AppBar from "@/components/appbar/Appbar.vue";

export default {
  name: "App",

  components: { AppBar },

  computed: {
    isPublic() {
      return this.$route.meta.public;
    }
  },

  data: () => ({
    //
  }),
};
</script>

<style>
span {
  line-height: 1;
}
</style>