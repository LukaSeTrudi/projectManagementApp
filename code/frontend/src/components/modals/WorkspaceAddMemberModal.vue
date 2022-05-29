<template>
  <v-dialog width="600" v-model="dialog">
    <v-card>
      <v-card-title>
        Add member
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text>
        <v-text-field
          v-model="search"
          label="Search by username or display name"
        />
        <div style="overflow-y: auto; height: 300px;">
          <div v-for="user in getFilteredUsers" :key="user.id" class="member">
            <div>
              <h3>{{ user.display_name}}</h3>
              <h6>{{ user.username }}</h6>
            </div>
            <v-spacer/>
            <v-btn class="ml-2" color="primary" @click="addMember(user.id)">
              Add Member
            </v-btn>
          </div>
        </div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "WorkspaceAddMemberModal",
  props: ["workspace"],

  computed: {
    getFilteredUsers() {
      return this.availableUsers.filter(x => {
        if(x.username.toLowerCase().includes(this.search.toLowerCase())) {
          return true;
        } else if (x.display_name.toLowerCase().includes(this.search.toLowerCase())) {
          return true;
        } else {
          return false;
        }
      })
    }
  },

  data() {
    return {
      dialog: false,
      availableUsers: [],
      search: "",
    };
  },
  methods: {
    ...mapActions("general", ["getAvailableUsers", "addMemberToWorkspace"]),

    open() {
      this.dialog = true;
      this.search = "";
      this.availableUsers = [];
      this.loadUsers();
    },

    async addMember(userId) {
      await this.addMemberToWorkspace({
        workspace_id: this.workspace.id,
        member_id: userId,
      });
      this.dialog = false;
    },

    async loadUsers() {
      this.availableUsers = await this.getAvailableUsers({workspace_id: this.workspace.id});
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