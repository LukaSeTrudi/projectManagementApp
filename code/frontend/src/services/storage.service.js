export default {
  updateRecents(newRecent) {
    if (!localStorage.getItem("recents")) {
      localStorage.setItem("recents", JSON.stringify({}));
    }
    let recents = JSON.parse(localStorage.getItem("recents"));
    recents[newRecent.id+""] = new Date();
    localStorage.setItem("recents", JSON.stringify(recents));
  },

  getRecents() {
    if (localStorage.getItem("recents")) {
      return JSON.parse(localStorage.getItem("recents"));
    } else {
      return {};
    }
  },

  clearRecents() {
    localStorage.removeItem("recents");
  }
};
