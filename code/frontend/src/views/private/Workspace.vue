<template>
  <div v-if="getSelectedWorkspace" class="wrapper">
    <div class="header d-flex my-4">
      <div>
        <div class="headline">
          Workspace name: <b>{{ getSelectedWorkspace.name }}</b>
        </div>
        <div class="subline">
          Workspace description: <b>{{ getSelectedWorkspace.description }}</b>
        </div>
      </div>
      <v-spacer />
      <v-btn color="error" @click="onDeleteWorkspace">Delete workspace</v-btn>
    </div>
    <v-tabs v-model="selectedTab" fixed-tabs>
      <v-tab>Boards</v-tab>
      <v-tab>Members</v-tab>
      <v-tab>Card Review</v-tab>
    </v-tabs>
    <v-tabs-items v-model="selectedTab">
      <v-tab-item>
        <v-card flat>
          <div class="d-flex py-2" style="height: calc(100vh - 300px); overflow-y:auto; flex-wrap:wrap; gap: 15px;">
            <BoardCard style="width: 100%;"
              v-for="board in getSelectedWorkspace.boards"
              :key="board.id"
              :board="board"
            />
          </div>
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <WorkspaceMembers :workspace="getSelectedWorkspace" />
        </v-card>
      </v-tab-item>
      <v-tab-item>
        <v-card flat>
          <WorkspaceTable :workspace="getSelectedWorkspace" />
        </v-card>
      </v-tab-item>
    </v-tabs-items>
  </div>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
import BoardCard from "@/components/cards/BoardCard.vue";
import WorkspaceMembers from "@/components/WorkspaceMembers.vue";
import WorkspaceTable from "@/components/WorkspaceTable.vue";
export default {
  name: "Workspace",
  data() {
    return {
      selectedTab: 0,
    };
  },
  watch: {
    "$route.params.id": async function (newVal) {
      await this.getWorkspaceById({ workspace_id: newVal });
      if (!this.getSelectedWorkspace) {
        window.location.href = "/";
      }
    },
  },
  components: { BoardCard, WorkspaceMembers, WorkspaceTable },
  methods: {
    ...mapActions("general", ["getWorkspaceById", "deleteWorkspace"]),

    async onDeleteWorkspace() {
      await this.deleteWorkspace({ workspace_id: this.$route.params.id });
      window.location.href = "/";
    },
  },
  computed: {
    ...mapGetters("general", ["getSelectedWorkspace"]),
  },
  async mounted() {
    await this.getWorkspaceById({ workspace_id: this.$route.params.id });
    if (!this.getSelectedWorkspace) {
      window.location.href = "/";
    }
  },
};
</script>

<style lang="scss" scoped>
.wrapper {
  padding: 0;
  margin: 0;
  padding: 15px;
  max-height: calc(100vh - 100px);
}
</style>