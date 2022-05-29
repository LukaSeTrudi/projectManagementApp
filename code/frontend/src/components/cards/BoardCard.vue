<template>
  <v-sheet elevation="1" width="200" height="100" class="mr-2" style="cursor: pointer; min-width: 200px; min-height:100px; border-radius: 5px;" v-bind:style="{background: board.color}" @click="clickedBoard">
    <div class="pa-2">
      {{board.name}}
    </div>
    <v-btn style="float:right; margin-top:20px;" icon @click="clickedHeart"><v-icon v-if="board.starred">mdi-heart</v-icon><v-icon v-else>mdi-heart-outline</v-icon></v-btn>
  </v-sheet>
</template>

<script>
import { mapActions } from 'vuex';
export default {
  name: "BoardCard",
  props: ["board"],

  methods: {
    ...mapActions('general', ['starBoard']),

    clickedBoard() {
      this.$router.push({
        path: '/board/'+this.board.id
      });
    },

    clickedHeart(event) {
      event.stopPropagation();
      this.starBoard({boardId: this.board.id, star: !this.board.starred});
    }
  }
};
</script>

<style>
</style>