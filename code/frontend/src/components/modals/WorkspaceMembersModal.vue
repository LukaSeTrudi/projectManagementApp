<template>
  <v-dialog width="600" v-model="dialog">
    <v-card>
      <v-card-title>
        Member list
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-text >
        <div>
          <WorkspaceMembers :workspace="workspace" />
        </div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import WorkspaceMembers from "@/components/WorkspaceMembers.vue";

export default {
  name: "WorkspaceMembersModal",
  props: ["workspace"],
  components: { WorkspaceMembers },

  data() {
    return {
      form: false,
      dialog: false,
    };
  },
  methods: {
    
    open() {
      this.dialog = true;
    },

  },
};
</script>

<style lang="scss">
.workspaceMembersWrapper {
  height: calc(100vh - 300px) !important;
}
</style>