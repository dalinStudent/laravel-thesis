import Vue from 'vue'
import axios from 'axios';
import store from "../store/index";
import router from '../route/index';

export default {
	login(params) {
		store.commit('setLoading', true);
		axios.post('/api/login', params).then( res => {
			store.commit('setUser', res.data.data)
			store.commit('setLoading', false);
			if (res.data.data.user.role === 'admin') {
				return router.push({name:`${res.data.data.user.role}.home`})
			}
			return router.push({name:`${res.data.data.user.role}.project`})
		}).catch( () => {
			return store.commit('setLoading', false);
		});
	},
	logout() {
		store.commit('setLoading', true);
		var user = Vue.$cookies.get('user');
		var config = {
			headers :{
				'Accept': 'application/json',
				'Authorization' : 'Bearer '+ user.token
			}
		}
		axios.post('/api/logout', null, config).then( () => {
			store.commit('setUser', null)
			store.commit('setLoading', false);
			return router.push({name: 'login'})
		}).catch( () => {
			return store.commit('setLoading', false);
		});
	}
};