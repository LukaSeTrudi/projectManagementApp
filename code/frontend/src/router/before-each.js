import tokenService from "../services/token.service";
import store from "@/store";

export default async (to, from, next) => {
  if (to.meta.public) {
    next();
    return;
  }
  const alreadyLoggedIn = store.state.auth.loggedIn;
  const hasToken = tokenService.hasToken();
  if (alreadyLoggedIn && hasToken) {
    next();
  } else if (hasToken) {
    await store.dispatch("auth/fetchUser");
    next();
  } else {
    next("/login");
  }
  //const loggedIn = TokenService.hasToken();
};
