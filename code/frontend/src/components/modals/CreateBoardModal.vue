<template>
  <v-dialog v-model="dialog" width="600">
    <v-card>
      <v-card-title>
        Create a board
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text>
        <v-form v-model="form" ref="form">
          <b> Board title </b>
          <v-text-field
            v-model="boardName"
            :rules="boardNameRules"
            outlined
          >
          </v-text-field>

          <b> Workspace </b>

          <v-select
            outlined
            v-model="boardWorkspace"
            :items="getMyWorkspaces"
            item-text="name"
            item-value="id"
            v-if="getMyWorkspaces.length > 0"
          ></v-select>
          <b style="color: red" v-else>Please make a workspace first.</b><br />

          <b>Board background</b>

          <v-color-picker
            class="my-2 py-2"
            style="background: lightgray"
            :swatches="swatches"
            show-swatches
            hide-canvas
            hide-inputs
            hide-mode-switch
            hide-sliders
            v-model="color"
            mode="hexa"
          ></v-color-picker>

          <v-btn color="primary" @click="onSubmit">Create Board</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "CreateWorkspaceModal",
  data() {
    return {
      dialog: false,
      form: false,

      boardWorkspace: null,
      color:"#FF0000",
      boardName: "",
      boardNameRules: [
        (v) => !!v || "Board name is required",
        (v) =>
          (v && v.length <= 15) || "Board name must be less than 15 characters",
      ],

      swatches: [
        ["#FF0000"], ["#FFA500"], ["#FFFF00"], ["#008000"], ["#0000FF"], ["#4B0082"], ["#800080"], ["#FF00FF"], ["#FFFFFF"], ["#000000"],
      ]
    };
  },

  mounted() {
    if(this.getMyWorkspaces.length>0) {
      this.boardWorkspace = this.getMyWorkspaces[0].id;
    }
  },
  computed: {
    ...mapGetters("general", ["getMyWorkspaces"]),
  },

  methods: {
    ...mapActions("general", ["createBoard"]),

    open() {
      this.dialog = true;
      this.boardName = "";
      if(this.getMyWorkspaces.length > 0) {
        this.boardWorkspace = this.getMyWorkspaces[0].id
      }
    },

    async onSubmit() {
      if (!this.$refs.form.validate() || this.getMyWorkspaces.length == 0) return;

      await this.createBoard({
         name: this.boardName,
         workspaceId: this.boardWorkspace,
         color: this.color
       });

      this.dialog = false;
    },
  },
};
</script>

<style>
</style>