<template>
  <div
    class="board"
    v-if="this.getSelectedBoard"
    :style="{ background: getBackgroundColor }"
  >
    <div class="d-flex headerBar" style="position: relative;">
      <b :style="{ color: getHeaderColor }"
        >Selected board: {{ this.getSelectedBoard.name }}</b
      >
      <v-spacer/>
      <v-btn @click="onDelete" style="position:absolute; right: 15px;"  color="error">Delete Board</v-btn>
    </div>
    <draggable
      v-model="getList"
      draggable=".item"
      class="d-flex pt-4"
      style="gap: 10px; overflow: auto; height: calc(100% - 20px)"
    >
      <SingleList
        class="item"
        v-for="list in getList"
        :key="list.id"
        :list="list"
      />
      <div style="width: 280px" slot="footer">
        <v-btn outlined block @click="openAddList"
          ><v-icon>mdi-plus</v-icon>Add a list</v-btn
        >
        <CreateListModal :board="getSelectedBoard" ref="createList" />
      </div>
    </draggable>
  </div>
</template>

<script>
import generalService from "@/services/general.service.js";
import SingleList from "@/components/cards/Board/SingleList.vue";
import { mapActions, mapGetters } from "vuex";
import CreateListModal from "@/components/modals/CreateListModal.vue";

export default {
  name: "Board",
  data() {
    return {};
  },

  watch: {
    "$route.params.id": function() {
      this.getBoardById({ boardId: this.$route.params.id });
    },
  },
  components: { SingleList, CreateListModal },

  computed: {
    ...mapGetters("general", ["getSelectedBoard"]),

    getList: {
      get() {
        return this.getSelectedBoard.lists
          .slice()
          .sort((a, b) => a.order_num - b.order_num);
      },
      set(value) {
        this.updateListOrder(value);
      },
    },

    getHeaderColor() {
      return generalService.pickTextColorBasedOnBgColorSimple(
        this.getSelectedBoard.color,
        "#000",
        "000"
      );
    },

    getBackgroundColor() {
      return this.getSelectedBoard.color + "33";
    },
  },

  methods: {
    ...mapActions("general", ["getBoardById", "updateListOrder", "deleteBoard"]),

    openAddList() {
      this.$refs.createList.open();
    },
    
    async onDelete() {
      await this.deleteBoard({ boardId: this.$route.params.id });
      window.location.href = "/";
    }
  },
  async mounted() {
    await this.getBoardById({ boardId: this.$route.params.id });
  },
};
</script>

<style lang="scss" scoped>
.board {
  width: 100%;
  height: calc(100vh - 48px);
  position: absolute;
  padding: 5px;
  left: 0;
  top: 0;
}
.headerBar {
  width: 100vw;
}
</style>