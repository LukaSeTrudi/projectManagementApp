<template>
  <v-menu
    v-model="menu"
    :close-on-content-click="false"
    nudge-bottom="10"
    max-width="300"
    offset-y
  >
    <template v-slot:activator="{ on, attrs }">
      <v-btn v-bind="attrs" v-on="on" small text color="accent" outlined>
        Create
      </v-btn>
    </template>

    <v-card class="py-2">
      <MenuHeader title="Create" @close="menu = false" />

      <v-list dense>
        <v-list-item-group>
          <v-list-item three-line @click="openBoardModal">
            <v-list-item-content>
              <v-list-item-title
                ><v-icon class="mr-2 my-1">mdi-checkerboard</v-icon>Create
                board</v-list-item-title
              >
              <v-list-item-subtitle
                >A board is made up of cards ordered on
                lists.</v-list-item-subtitle
              >
              <v-list-item-subtitle
                >Use it to manage projects, track information,
              </v-list-item-subtitle>
              <v-list-item-subtitle>or organize anything.</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
          <v-list-item three-line @click="openWorkspaceModal">
            <v-list-item-content>
              <v-list-item-title
                ><v-icon class="mr-2 my-1">mdi-monitor-multiple</v-icon>Create
                Workspace</v-list-item-title
              >
              <v-list-item-subtitle
                >A workspace is a group of boards and
                people.</v-list-item-subtitle
              >
              <v-list-item-subtitle
                >Use it to manage your company, side hustle,
              </v-list-item-subtitle>
              <v-list-item-subtitle>family, or friends.</v-list-item-subtitle>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>
      <CreateBoardModal ref="boardModal"/>
      <CreateWorkspaceModal ref="workspaceModal"/>
    </v-card>
  </v-menu>
</template>

<script>
import MenuHeader from "./MenuHeader.vue";
import CreateWorkspaceModal from "@/components/modals/CreateWorkspaceModal.vue";
import CreateBoardModal from "@/components/modals/CreateBoardModal.vue";

export default {
  name: "CreateMenu",

  data: () => ({
    menu: false,
  }),
  components: {
    MenuHeader,
    CreateWorkspaceModal,
    CreateBoardModal
  },

  methods: {
    openWorkspaceModal() {
      this.menu = false;
      this.$refs.workspaceModal.open();
    },

    openBoardModal() {
      this.menu = false;
      this.$refs.boardModal.open();
    }
  }
};
</script>

<style>
</style>