<template>
  <v-dialog v-model="dialog">
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
          <WorkspaceTable :workspace="workspace" />
        </div>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import WorkspaceTable from "@/components/WorkspaceTable.vue";

export default {
  name: "WorkspaceTableModal",
  props: ["workspace"],
  components: { WorkspaceTable },

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
</style>