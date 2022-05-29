<template>
  <v-list nav dense style="width: 200px;">
    <v-list-item-group>
      <v-list-item link>
        <v-list-item-icon>
          <v-icon>mdi-home</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Home</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item link>
        <v-list-item-icon>
          <v-icon>mdi-home-outline</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Boards</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

    </v-list-item-group>

    <div class="my-4"></div>
    <v-divider class="mx-2"></v-divider>
    
    <v-list-item-group>
      <v-list-item>
        <v-list-item-icon>
          <v-icon>mdi-plus-box</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title>Workspaces</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

    </v-list-item-group>


    <v-list-item-group>
      
    </v-list-item-group>
  </v-list>
</template>

<script>
export default {
  name: "Sidebar",
};
</script>

<style>
</style>