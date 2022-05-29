import axios from "axios";
import Store from "@/store";
import tokenService from "./token.service";
export default {
  init(baseURL) {
    axios.defaults.baseURL = baseURL;
    // axios.defaults.timeout = 5000; // 5s Timeout
    this.loadingToken = false;
  },

  get(path, params, headers) {
    return this.request("GET", path, null, params, headers);
  },

  post(path, data, params, headers) {
    return this.request("POST", path, data, params, headers);
  },

  postFormData(path, form, headers) {
    const formData = new FormData()
    Object.keys(form).forEach((key) => {
      formData.append(key, form[key])
    })
    return this.request("POST", path, formData, null, headers);
  },

  put(path, data, params, headers) {
    return this.request("PUT", path, data, params, headers);
  },

  delete(path, params, headers) {
    return this.request("DELETE", path, null, params, headers);
  },

  async request(method, url, data, params, headers) {
    headers={
      ...headers,
      'Access-Control-Allow-Origin': '*',
      'Authorization': `Bearer ${ tokenService.getToken() }`
    }
    const request =  {
      method: method,
      url: url,
      data: data,
      params: params,
      headers: headers,
    }
    return axios(request).then(response => {
      return response.data;
    }, error => {
      if(error && error.response && error.response.status == 401) {
        tokenService.clearToken();
        Store.dispatch("auth/logout");
      }
      throw error;
    })
  }
}
