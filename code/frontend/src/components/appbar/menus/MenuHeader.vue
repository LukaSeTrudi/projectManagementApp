<template>
  <div>
    <div style="display: flex; align-items: center">
      <div style="width: 36px" />
      <v-spacer />
      <span class="grey--text">{{title}}</span>
      <v-spacer />
      <v-btn icon @click="onClose">
        <v-icon>mdi-close</v-icon>
      </v-btn>
    </div>

    <v-divider class="mx-2"></v-divider>
  </div>
</template>

<script>
export default {
  name: "MenuHeader",
  
  props: ['title'],
  methods: {
    onClose() {
      this.$emit('close');
    }
  }
};
</script>

<style>
</style>