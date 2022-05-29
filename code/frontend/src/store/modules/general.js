import router from "../../router";
import RequestService from "../../services/request.service";
import storageService from "../../services/storage.service";
export default {
  namespaced: true,
  state: {
    allWorkspaces: [],
    allBoards: [],
    selectedBoard: null,
    selectedWorkspace: null,
    user: null,
    recents: [],
  },
  mutations: {
    setAllWorkspaces(state, workspaces) {
      state.allWorkspaces = workspaces;
    },
    setAllBoards(state, boards) {
      state.allBoards = boards;
    },
    setUser(state, user) {
      state.user = user;
    },
    setRecents(state, recent) {
      state.recents = recent;
    }
  },
  getters: {
    getMyWorkspaces(state) {
      return state.allWorkspaces.filter((workspace) => workspace.owner_id === state.user.id);
    },
    getGuestWorkspaces(state) {
      return state.allWorkspaces.filter((workspace) => workspace.owner_id !== state.user.id);
    },
    getBoardsByWorkspaceId: (state) => (workspaceId) => {
      return state.allBoards.filter((board) => board.workspace_id === workspaceId);
    },
    getRecentBoards(state) {
      return state.allBoards.filter((board) => state.recents[board.id+""]).slice().sort((a, b) => new Date(state.recents[b.id]) - new Date(state.recents[a.id+""]));
    },
    getStarredBoards(state) {
      return state.allBoards.filter(board => board.starred);
    },
    getSelectedBoard(state) {
      return state.selectedBoard;
    },
    getSelectedWorkspace(state) {
      return state.selectedWorkspace;
    },
    getMyself(state) {
      return state.user;
    },
  },
  actions: {
    init(context) {
      context.dispatch("getAllWorkspaces");
      context.dispatch("getAllBoards");
      context.dispatch("refreshWorkspace");
      context.dispatch("refreshBoard");
      context.commit('setRecents', storageService.getRecents());
    },

    addRecent(context, board) {
      storageService.updateRecents(board);
      context.commit('setRecents', storageService.getRecents());
    },

    // WORKSPACES

    getAllWorkspaces(context) {
      RequestService.get("/api/workspaces/").then(
        (response) => {
          context.commit("setAllWorkspaces", response);
        },
        (error) => {
          console.error(error);
        }
      );
    },

    createWorkspace(context, data) {
      RequestService.postFormData("/api/workspaces/", { ...data, request_type: "create" }).then(
        (response) => {
          //returns new workspace id TODO: reroute to workspace page
          router.push({
            path: "/workspace/" + response,
          });
        },
        (error) => {
          console.error(error);
        }
      );
    },

    deleteWorkspace(context, data) {
      RequestService.postFormData("/api/workspaces/", { ...data, request_type: "delete" }).then(response => {
        return response;
      });
    },

    getWorkspaceById(context, data) {
      return RequestService.postFormData("/api/workspaces/", {...data, request_type: "getSingle"}).then((response) => {
        context.state.selectedWorkspace = response;
        return response;
      });
    },

    refreshWorkspace(context) {
      if (context.state.selectedWorkspace) {
        context.dispatch("getWorkspaceById", { workspace_id: context.state.selectedWorkspace.id });
      }
    },

    addMemberToWorkspace(context, data) {
      return RequestService.postFormData("api/workspaces/", { ...data, request_type: "addMember" }).then((response) => {
        context.dispatch("getAllWorkspaces");
        context.dispatch("refreshWorkspace");
        return response;
      });
    },

    removeMemberFromWorkspace(context, data) {
      return RequestService.postFormData("api/workspaces/", { ...data, request_type: "removeMember" }).then((response) => {
        context.dispatch("getAllWorkspaces");
        context.dispatch("refreshWorkspace");
        return response;
      });
    },

    updateMemberRole(context, data) {
      return RequestService.postFormData("api/workspaces/", { ...data, request_type: "updateMemberRole" }).then((response) => {
        context.dispatch("getAllWorkspaces");
        context.dispatch("refreshWorkspace");
        return response;
      });
    },

    // BOARDS

    starBoard(context, data) {
      return RequestService.postFormData("api/boards/", data).then((response) => {
        context.dispatch('init');
        return response;
      });
    },

    getAllBoards(context) {
      RequestService.get("/api/boards/").then(
        (response) => {
          context.commit("setAllBoards", response);
        },
        (error) => {
          console.error(error);
        }
      );
    },

    createBoard(context, data) {
      RequestService.postFormData("/api/boards/", data).then(
        (response) => {
          //returns new workspace id TODO: reroute to board page
          router.push({
            path: "/board/" + response,
          });
        },
        (error) => {
          console.error(error);
        }
      );
    },

    getBoardById(context, data) {
      return RequestService.postFormData("/api/boards/", data).then((response) => {
        context.state.selectedBoard = response;
        context.dispatch('addRecent', response);
        return response;
      });
    },

    refreshBoard(context) {
      if (context.state.selectedBoard) {
        context.dispatch("getBoardById", { boardId: context.state.selectedBoard.id });
      }
    },

    deleteBoard(context, data) {
      return RequestService.postFormData("/api/boards/", {...data, delete: true}).then((response) => {
        return response;
      });
    },

    // CARDS

    getCardsByBoardId(context, data) {
      return RequestService.postFormData("/api/cards/", data);
    },

    createCard(context, data) {
      return RequestService.postFormData("/api/cards/", { ...data, request_type: "create" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    updateCard(context, data) {
      return RequestService.postFormData("/api/cards/", { ...data, request_type: "update" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    deleteCard(context, data) {
      return RequestService.postFormData("/api/cards/", { ...data, request_type: "delete" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    // LISTS

    createList(context, data) {
      return RequestService.postFormData("/api/lists/", { ...data, request_type: "create" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },
    updateListOrder(context, data) {
      const list = data.map((x) => x.id);
      list.forEach((listId, index) => {
        context.state.selectedBoard.lists.forEach((list) => {
          if (list.id == listId) {
            list.order_num = index;
          }
        });
      });
      return RequestService.postFormData("/api/lists/", { listOrders: list, request_type: "updateOrder" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    updateList(context, data) {
      return RequestService.postFormData("/api/lists/", { ...data, request_type: "update" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    deleteList(context, data) {
      return RequestService.postFormData("/api/lists/", { ...data, request_type: "delete" }).then((response) => {
        context.dispatch("refreshBoard");
        return response;
      });
    },

    // USERS

    getAvailableUsers(context, data) {
      return RequestService.postFormData("/api/workspaces/", { ...data, request_type: "availableUsers" });
    },
  },
  modules: {},
};
