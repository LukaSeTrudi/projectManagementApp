<template>
  <v-dialog v-model="dialog" width="600">
    <v-card>
      <v-card-title>
        Lets build a workspace
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>
      <v-card-subtitle>
        Boost your productivity by making it easier for everyone to access
        boards in one location.
      </v-card-subtitle>

      <v-card-text>
        <v-form v-model="form" ref="form">
          <b> This is the name of your company, team or organization. </b>
          <v-text-field
            v-model="workspaceName"
            :rules="workspaceNameRules"
            outlined
            label="Workspace name"
          >
          </v-text-field>

          <b>
            Get your members on board with a few words about your Workspace.
          </b>
          <v-textarea
            outlined
            v-model="workspaceDescription"
            no-resize
            label="Workspace description (Optional)"
            hint="Our team organizes everything here."
          >
          </v-textarea>

          <v-btn color="primary" @click="onSubmit">Create workspace</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";
export default {
  name: "CreateWorkspaceModal",
  data() {
    return {
      dialog: false,
      form: false,

      workspaceName: "",
      workspaceNameRules: [
        (v) => !!v || "Workspace name is required",
        (v) =>
          (v && v.length <= 15) ||
          "Workspace name must be less than 15 characters",
      ],

      workspaceDescription: "",
    };
  },
  methods: {
    ...mapActions("general", ["createWorkspace"]),

    open() {
      this.dialog = true;
      this.workspaceName = "",
      this.workspaceDescription = ""
    },

    async onSubmit() {
      if (!this.$refs.form.validate()) return;

      await this.createWorkspace({
        name: this.workspaceName,
        desc: this.workspaceDescription,
      });

      this.workspaceName = "";
      this.workspaceDescription = "";

      this.dialog = false;
    },
  },
};
</script>

<style>
</style>