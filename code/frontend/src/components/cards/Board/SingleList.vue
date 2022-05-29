<template>
  <div>
    <div class="main">
      <div class="d-flex">
        <b class="ma-2">{{ list.name }}</b>
        <v-spacer></v-spacer>
        <v-btn icon @click="openEditList"><v-icon>mdi-dots-vertical</v-icon></v-btn>
        <CreateListModal :list="list" ref="editList"/>
      </div>
      <div style="max-height: 100%; overflow-y: auto;">
        <SingleCard v-for="card in list.cards" :key="card.id" :card="card"/>
      </div>

      <v-btn outlined block @click="openCreateCard" class="mt-2"
        ><v-icon>mdi-plus</v-icon>Add a card</v-btn
      >
      <CreateCardModal :list="list" ref="createCard" />
    </div>
    <v-spacer></v-spacer>
  </div>
</template>

<script>
import CreateCardModal from "@/components/modals/CreateCardModal.vue";
import CreateListModal from "@/components/modals/CreateListModal.vue";

import SingleCard from "./SingleCard.vue";
export default {
  name: "SingleList",
  components: { CreateCardModal, SingleCard, CreateListModal },
  props: ["list"],
  data() {
    return {};
  },
  methods: {
    openCreateCard() {
      this.$refs.createCard.open();
    },
    openEditList() {
      this.$refs.editList.open();
    }
  },
};
</script>

<style lang="scss" scoped>
.main {
  min-width: 280px;
  max-width: 280px;
  overflow-y: auto;
  max-height: calc(100vh - 100px);
  border-radius: 5px;
  background: white;
  padding: 5px;
  display: flex;
  flex-direction: column;
}
</style>