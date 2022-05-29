<template>
  <v-dialog width="600" v-model="dialog">
    <v-card>
      <v-card-title>
        {{ card ? "Edit card" : "Create card" }}
        <v-spacer />
        <v-btn icon @click="dialog = false">
          <v-icon>mdi-close</v-icon>
        </v-btn>

      </v-card-title>

      <v-card-text>
        <div v-if="card">
          <p>Created: {{ card.created }}</p>
          <p>Last Modified: {{ card.modified }}</p>
        </div>
        <v-form v-model="form" ref="form">
          <v-text-field
            v-model="cardTitle"
            :rules="cardTitleRules"
            outlined
            label="Card title"
          ></v-text-field>

          <v-textarea
            outlined
            v-model="cardDescription"
            no-resize
            label="Card description (Optional)"
            hint="Something fun..."
          >
          </v-textarea>

          <DatePicker
            ref="datePicker"
            :initDate="card ? card.due_date : null"
          />

          <v-btn v-if="!card" color="primary" @click="onSubmit"
            >Create card</v-btn
          >

          <v-btn v-if="card" color="primary" @click="onUpdate" class="mx-4"
            >Update card</v-btn
          >
          <v-btn v-if="card" color="error" @click="onDelete">Delete card</v-btn>
        </v-form>
      </v-card-text>
    </v-card>
  </v-dialog>
</template>

<script>
import { mapActions } from "vuex";
import DatePicker from "@/components/DatePicker.vue";

export default {
  name: "CreateCardModal",
  components: { DatePicker },
  props: ["list", "card"],
  data() {
    return {
      form: false,
      dialog: false,

      cardTitle: "",
      cardTitleRules: [
        (v) => !!v || "Card title is required",
        (v) =>
          (v && v.length <= 15) || "Card title must be less than 15 characters",
      ],

      cardDescription: "",
    };
  },
  methods: {
    ...mapActions("general", ["createCard", "updateCard", "deleteCard"]),

    open() {
      this.dialog = true;
      this.cardTitle = this.card ? this.card.title : "";
      this.cardDescription = this.card ? this.card.description : "";
    },

    async onUpdate() {
      if (!this.$refs.form.validate()) return;
      await this.updateCard({
        card_id: this.card.id,
        title: this.cardTitle,
        description: this.cardDescription,
        due_date: this.$refs.datePicker.date,
        list_id: this.card.list_id,
      });

      this.closeDialog();
    },
    async onDelete() {
      await this.deleteCard({
        id: this.card.id,
      });
      this.closeDialog();
    },

    closeDialog() {
      this.cardTitle = "";
      this.description = "";
      this.due_date = null;

      this.dialog = false;
    },

    async onSubmit() {
      if (!this.$refs.form.validate()) return;

      await this.createCard({
        title: this.cardTitle,
        description: this.cardDescription,
        due_date: this.$refs.datePicker.date,
        list_id: this.list.id,
        order_num: this.list.cards.length,
      });

      this.closeDialog();
    },
  },
};
</script>

<style>
</style>