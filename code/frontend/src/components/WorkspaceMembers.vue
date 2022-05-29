<template>
  <div>
    <v-btn
      class="mb-4"
      color="primary"
      @click="openAddMember"
      :disabled="!hasRights"
    >
      <v-icon class="mr-2">mdi-account-plus</v-icon>
      Add member
    </v-btn>
    <WorkspaceAddMemberModal ref="addMemberModal" :workspace="workspace" />

    <div style="overflow-y: auto; height: 300px;" class="workspaceMembersWrapper">
      <div v-for="user in workspace.members" :key="user.id" class="member">
        <div>
          <h3>
            {{ user.display_name }}
            {{ user.id === getMyself.id ? "(Myself)" : "" }}
          </h3>
          <h6>{{ user.username }}</h6>
        </div>
        <v-spacer />
        <v-select
          :disabled="user.id === workspace.owner_id || !hasRights"
          style="max-width: 150px; height: 45px"
          solo
          flat
          outlined
          dense
          label="Role"
          :items="roles"
          v-model="user.role_id"
          @change="updateRole(user.member_id, $event)"
        />
        <v-btn
          class="ml-2"
          color="error"
          icon
          @click="removeUser(user.id)"
          v-if="user.id !== workspace.owner_id && hasRights"
        >
          <v-icon>mdi-delete</v-icon>
        </v-btn>
      </div>
    </div>
  </div>
</template>

<script>
import WorkspaceAddMemberModal from "@/components/modals/WorkspaceAddMemberModal.vue";
import { mapActions, mapGetters } from 'vuex';
export default {
name: "WorkspaceMembers",
  props: ["workspace"],
  components: { WorkspaceAddMemberModal },
  computed: {
    ...mapGetters('general', ['getMyself']),

    isOwner() {
      return this.workspace.owner_id === this.getMyself.id;
    },
    hasRights() {
      return this.isOwner || this.getMyself.role_id === 1;
    },
  },

  data() {
    return {
      roles: [
        { text: "Admin", value: 0 },
        { text: "Guest", value: 1 },
      ],
    };
  },
  methods: {
    ...mapActions("general", ["removeMemberFromWorkspace", "updateMemberRole"]),

    openAddMember() {
      this.$refs.addMemberModal.open();
    },

    updateRole(memberId, role) {
      this.updateMemberRole({
        member_id: memberId,
        role: role
      });
    },

    removeUser(userId) {
      this.removeMemberFromWorkspace({
        workspace_id: this.workspace.id,
        member_id: userId,
      })
    }
  },
};
</script>

<style lang="scss" scoped>
.member {
  background: #fafafa;
  padding: 15px;
  border: 1px solid #ccc;
  border-radius: 15px;
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}
</style>