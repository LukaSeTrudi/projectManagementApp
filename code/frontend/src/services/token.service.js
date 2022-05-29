
export default { 
  init() {

  },

  hasToken() {
    return this.getToken() != null;
  },

  setToken(token) {
    localStorage.setItem('authToken', token);
  },

  getToken() {
    return localStorage.getItem('authToken');
  },

  clearToken() {
    localStorage.removeItem('authToken');
  }
}