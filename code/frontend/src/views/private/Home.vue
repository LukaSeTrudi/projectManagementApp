<template>
  <div class="d-flex">
    <div style="width: 100%;">
      <div>
        <v-subheader>
          <v-icon>mdi-star</v-icon>
          <span class="ml-2">Starred Boards</span>
        </v-subheader>
        <div class="ml-4">
          <div class="d-flex" style="overflow: auto;">
            <BoardCard v-for="board in getStarredBoards" :key="board.id" :board="board"></BoardCard>
          </div>
        </div>
      </div>
      <div>
        <v-subheader>
          <v-icon>mdi-clock</v-icon>
          <span class="ml-2">Recently viewed</span>
        </v-subheader>
        <div class="ml-4">
          <div class="d-flex" style="overflow: auto;">
            <BoardCard v-for="board in getRecentBoards" :key="board.id" :board="board"></BoardCard>
          </div>
        </div>
      </div>

      <div>
        <v-subheader>
          <span style="font-weight: bold">YOUR WORKSPACES</span>
        </v-subheader>
        <div class="ml-4">
          <div v-for="workspace in getMyWorkspaces" :key="workspace.id">
            <ProjectBar :workspace="workspace"></ProjectBar>
            <div class="d-flex" style="overflow: auto;">
              <BoardCard v-for="board in getBoardsByWorkspaceId(workspace.id)" :key="board.id" :board="board"></BoardCard>
            </div>
          </div>
        </div>
      </div>

      <div>
        <v-subheader>
          <span style="font-weight: bold">GUEST WORKSPACES</span>
        </v-subheader>
        <div class="ml-4">
          <div v-for="workspace in getGuestWorkspaces" :key="workspace.id">
            <ProjectBar :workspace="workspace"></ProjectBar>
            <div class="d-flex" style="overflow: auto;">
              <BoardCard v-for="board in getBoardsByWorkspaceId(workspace.id)" :key="board.id" :board="board"></BoardCard>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ProjectBar from "@/components/cards/ProjectBar.vue";
import BoardCard from "@/components/cards/BoardCard.vue";

import { mapGetters } from 'vuex';

export default {
  name: "Home",
  components: { ProjectBar, BoardCard },

  computed: {
    ...mapGetters('general', ['getMyWorkspaces', 'getGuestWorkspaces', 'getBoardsByWorkspaceId', 'getRecentBoards', 'getStarredBoards'])
  },

  mounted() {
  }
};
</script>

<style>
</style>