<template>
  <div class="card" @mouseover="showDelete = true" @mouseout="showDelete = false" @click="openEditModal">
    <span>{{ card.title }}</span>
    <v-spacer />
    <v-btn icon v-show="showDelete" x-small><v-icon></v-icon></v-btn>
    <CreateCardModal :card="card" ref="editCard"/>
  </div>
</template>

<script>

import CreateCardModal from "@/components/modals/CreateCardModal.vue";

export default {
  name: "SingleCard",
  props: ["card"],
  components: {CreateCardModal},
  data() {
    return {
      showDelete: false,
    }
  },

  methods: {
    openEditModal() {
      this.$refs.editCard.open();
    }
  }
};
</script>

<style lang="scss" scoped>
.card {
  background: #eee;
  display: flex;
  align-items: center;
  padding: 10px;
  margin: 2px 0;
  border-radius: 5px;
}
.card:hover {
  opacity: 0.8;
  cursor: pointer;
}
</style>