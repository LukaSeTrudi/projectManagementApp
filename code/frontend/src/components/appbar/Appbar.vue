<template>
  <v-app-bar dense app flat color="primary">
    <div class="main">
      <v-btn small text color="accent" href="/" class="mx-1"> Home </v-btn>
      <WorkspacesMenu class="mx-2"/>

      <CreateMenu class="mx-2"/>

      <v-spacer />

      <v-btn small text color="accent" href="/login" class="mx-1"> Logout </v-btn>
    </div>
  </v-app-bar>
</template>

<script>
import WorkspacesMenu from "@/components/appbar/menus/WorkspacesMenu.vue";
import CreateMenu from "@/components/appbar/menus/CreateMenu.vue";

export default {
  name: "Appbar",
  components: {
    WorkspacesMenu,
    CreateMenu
  },
  async created() {
  }
};
</script>

<style lang="scss" scoped>
.main {
  width: 100vw !important;
  display: flex;
  flex: 1;
}
</style>