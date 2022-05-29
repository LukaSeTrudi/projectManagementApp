<template>
  <v-menu
    v-model="menu"
    :close-on-content-click="false"
    :nudge-width="200"
    max-width="300"
    nudge-bottom="10"
    offset-y
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn v-bind="attrs" v-on="on" small text color="accent">
        Workspaces
        <v-icon>mdi-chevron-down</v-icon>
      </v-btn>
    </template>

    <v-card class="py-2">
      <MenuHeader title="Workspaces" @close="menu = false"/>

      <v-list>
        <p class="caption ml-4">Your workspaces</p>
        <v-list-item v-for="workspace in getMyWorkspaces" :key="workspace.id" @click="goToWorkspace(workspace.id)">
          <v-list-item-content>
            <v-list-item-title>{{ workspace.name }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        
        <p class="caption ml-4">Guest workspaces</p>
        <v-list-item v-for="workspace in getGuestWorkspaces" :key="workspace.id" @click="goToWorkspace(workspace.id)">
          <v-list-item-content>
            <v-list-item-title>{{ workspace.name }}</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-card>
  </v-menu>
</template>

<script>
import { mapGetters } from 'vuex';
import MenuHeader from './MenuHeader.vue';

export default {
  name: 'WorkspacesMenu',
  data: () => ({
    menu: false,
  }),
  computed: {
    ...mapGetters('general', ['getMyWorkspaces', 'getGuestWorkspaces'])
  },
  methods: {
    goToWorkspace(id) {
      this.$router.push({ name: 'Workspace', params: { id } });
    }
  },
  components: {
    MenuHeader
  }
};
</script>

<style>
</style>