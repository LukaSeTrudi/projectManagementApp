<template>
  <v-dialog width="600" v-model="dialog">
    <v-card>
      <v-card-title>
        {{ list ? 'Edit list' : 'Create list' }}
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>
      </v-card-title>

      <v-card-text>
        <v-form v-model="form" ref="form">
          <v-text-field
            v-model="listName"
            :rules="listNameRules"
            outlined
            label="List name"
          ></v-text-field>

          <v-btn v-if="!list" color="primary" @click="onSubmit">Create list</v-btn>
          <v-btn color="primary" v-if="list" @click="onUpdate" class="mr-4">Update list</v-btn>
          <v-btn color="error" v-if="list" @click="onDelete">Delete list</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";

export default {
  name: "CreateListModal",
  props: ["board", "list"],
  data() {
    return {
      form: false,
      dialog: false,

      listName: "",
      listNameRules: [
        (v) => !!v || "List name is required",
        (v) =>
          (v && v.length <= 15) || "List name must be less than 15 characters",
      ],
    };
  },
  methods: {
    ...mapActions("general", ["createList", "updateList", "deleteList"]),

    open() {
      this.dialog = true;
      this.listName = this.list ? this.list.name : "";
    },

    async onDelete() {
      await this.deleteList({
        id: this.list.id,
      });
      this.dialog = false;
    },

    async onUpdate() {
      if (!this.$refs.form.validate()) return;
      this.updateList({
        name: this.listName,
        id: this.list.id
      });
    },

    async onSubmit() {
      if (!this.$refs.form.validate()) return;

      await this.createList({
        name: this.listName,
        order_num: this.board.lists.length,
        board_id: this.board.id,
      });

      this.listName = "";
      this.dialog = false;
    },
  },
};
</script>

<style>
</style>