import requestService from "../../services/request.service"
import tokenService from "../../services/token.service";
import store from "@/store";
export default {
  namespaced: true,
  state: {
    loggedIn: false,
    user: null,
  },
  mutations: {
    setLoggedIn(state, loggedIn) {
      state.loggedIn = loggedIn;
    },
    setUser(state, user) {
      state.user = user;
    }
  },
  actions: {

    async register(context, data) {
      return requestService.postFormData('/api/auth/register.php', data);
    },

    async login(context, data) {
      return requestService.postFormData('/api/auth/login.php', data);
    },

    async fetchUser(context) {
      return requestService.get(`/api/users/`).then((response) => {
        context.dispatch("setUser", response);
      }, error => {
        console.error(error);
      });
    },

    async logout(context) {
      tokenService.clearToken();
      context.commit("setLoggedIn", false);
      context.commit("setUser", null);
      window.location.href = "/login";
    },

    async setUser(context, user) {
      context.commit("setLoggedIn", true);
      context.commit("setUser", user);
      store.commit("general/setUser", user, { root: true });
      store.dispatch("general/init", { root: true });
    },
  },
  modules: {
  }
}
