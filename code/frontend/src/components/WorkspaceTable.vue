<template>
  <v-card>
    <v-card-title>
      Cards
      <v-spacer />
      <v-text-field
        v-model="search"
        append-icon="mdi-magnify"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table height="calc(100vh - 400px)"
      dense
      multi-sort
      :search="search"
      :items="workspace.cards"
      :headers="tableHeaders"
    >
    <template v-slot:[`item.due_date`]="{ item }">
        {{ item.due_date.charAt(0) == "0" ? "Not defined" : item.due_date}}
    </template>

    
    <template v-slot:[`item.board_id`]="{ item }">
        <a :href="'/board/'+item.board_id">{{item.board_name}}</a>
    </template>
    </v-data-table>
  </v-card>
</template>

<script>
export default {
  name: "WorkspaceTable",
  props: ["workspace"],

  data() {
    return {
      search: "",
      tableHeaders: [
        { text: "Title", value: "title" },
        { text: "Description", value: "description" },
        { text: "Created", value: "created" },
        { text: "Updated", value: "modified" },
        { text: "Due date", value: "due_date" },
        { text: "Board", value: "board_id" },
        { text: "List", value: "list_name" },
      ],
    };
  },
};
</script>

<style>
</style>