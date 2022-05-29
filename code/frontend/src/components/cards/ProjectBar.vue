<template>
  <div class="d-flex align-center my-2" style="gap: 5px;">
    <b>{{ workspace.name }}</b>
    <v-spacer></v-spacer>
    <v-btn @click="openWorkspace">Boards</v-btn>
    <v-btn @click="openMembers">Members</v-btn>
    <WorkspaceMembersModal :workspace="workspace" ref="membersModal"/>
    <v-btn @click="openTable">Cards</v-btn>
    <WorkspaceTableModal :workspace="workspace" ref="tableModal"/>
  </div>
</template>

<script>
import WorkspaceMembersModal from "@/components/modals/WorkspaceMembersModal.vue";
import WorkspaceTableModal from "@/components/modals/WorkspaceTableModal.vue";
export default {
  name: 'ProjectBar',
  props: ['workspace'],
  components: {WorkspaceMembersModal, WorkspaceTableModal},

  methods: {
    openMembers() {
      this.$refs.membersModal.open();
    },

    openWorkspace() {
      this.$router.push({ name: 'Workspace', params: { id: this.workspace.id } });
    },

    openTable() {
      this.$refs.tableModal.open();
    }
  }
}
</script>

<style>

</style>