<template>
  <v-dialog
    ref="dialog"
    v-model="modal"
    :return-value.sync="date"
    width="290px"
  >
    <template v-slot:activator="{ on, attrs }">
      <v-text-field
        v-model="date"
        label="Due Date"
        prepend-icon="mdi-calendar"
        readonly
        v-bind="attrs"
        v-on="on"
        clearable
      ></v-text-field>
    </template>
    <v-date-picker v-model="date" color="success" :min="currDate">
      <v-spacer></v-spacer>
      <v-btn text color="primary" @click="modal = false"> Cancel </v-btn>
      <v-btn text color="primary" @click="$refs.dialog.save(date)"> OK </v-btn>
    </v-date-picker>
  </v-dialog>
</template>

<script>
export default {
  name: "DatePicker",
  props: ['initDate'],
  data() {
    return {
      modal: false,
      date: null,
      currDate: new Date().toISOString().substr(0, 10),
    };
  },
  mounted() {
    if(this.initDate && this.initDate.charAt(0) !== '0') {
      this.date = this.initDate.substr(0,10);
    }
  }
};
</script>

<style>
</style>