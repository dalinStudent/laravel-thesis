import axios from 'axios';
import store from "../store/index";

var chttp = {};
chttp.install = function (Vue, options) {
    
    Vue.prototype.$chttp = {
        getFullUrl(url) {
            var user = Vue.$cookies.get('user');
            return `/api/${user ? user.user.role : ''}/${url}`;
        },
        getHeaderConfig(param = null) {
            var user = Vue.$cookies.get('user');
            return {
                headers :{
                    'Accept': 'application/json',
                    'Authorization' : `Bearer ${user ? user.token : ''}`
                },
                params: param
            }
        },
        ///
        post(url, params, alert = true) {
            store.commit('setLoading', true);
            return new Promise((response, reject) => {
                axios.post(this.getFullUrl(url), params, this.getHeaderConfig()).then(result => {
                    store.commit('setLoading', false);
                    this.alertSuccess(alert)
                    response(result);
                }).catch((e) => {
                    this.alertErrorMessage(e, alert);
                    reject(e);
                    store.commit('setLoading', false);
                });
            });
        },
        get(url, params,alert = true) {
            store.commit('setLoading', alert);
            return new Promise((response, reject) => {
                axios.get(this.getFullUrl(url), this.getHeaderConfig(params)).then(result => {
                    store.commit('setLoading', false);
                    response(result);
                }).catch((e) => {
                    reject(e);
                    store.commit('setLoading', false);
                });
            });
        },
        delete(url, params,alert = true) {
            store.commit('setLoading', alert);
            return new Promise((response) => {
                axios.delete(this.getFullUrl(url), this.getHeaderConfig(params)).then(result => {
                    store.commit('setLoading', false);
                    this.alertSuccess(alert)
                    response(result);
                }).catch((e) => {
                    this.alertErrorMessage(e, alert);
                    store.commit('setLoading', false);
                });
            });
        },
        put(url, params, alert = true) {
            store.commit('setLoading', true);
            return new Promise((response, reject) => {
                axios.put(this.getFullUrl(url), params, this.getHeaderConfig()).then(result => {
                    store.commit('setLoading', false);
                    this.alertSuccess(alert)
                    response(result);
                }).catch((e) => {
                    this.alertErrorMessage(e, alert);
                    reject(e);
                    store.commit('setLoading', false);
                });
            });
        },
        //file
        uploadFile(file, file_type) {
            var form = new FormData();
            form.append('file', file)
            form.append('file_type', file_type)
            return new Promise((response, reject) => {
                axios.post('api/file', form, this.getHeaderConfig()).then(res => {
                    response(res);
                }).catch(error => {
                    reject(error);
                });
            });
        },
        deleteFile(id) {
            return new Promise((response, reject) => {
                axios.delete('api/file/'+id, this.getHeaderConfig()).then(res => {
                    response(res);
                }).catch((e) => {
                    reject(e);
                });
            });
        },
        alertSuccess(alert) {
            if (alert) {
                Vue.$swal('Success',{
                    icon: "success",
                    button: false,
                    timer: 1000
                });
            }
        },
        alertErrorMessage(e, alert = false) {
            if (alert) {
                console.log(e)
                var sms = e.response.data
                Vue.$swal(sms.message, {
                    icon: "error",
                    timer: 1000,
                    button: false
                })
            }
        }
    }
};
export default chttp;

