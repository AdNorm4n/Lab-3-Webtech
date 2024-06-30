import { createStore } from 'vuex';
import axios from 'axios';

export default createStore({
  state: {
    users: []
  },
  mutations: {
    SET_USERS(state, users) {
      state.users = users;
    }
  },
  actions: {
    async fetchUsers({ commit }) {
      try {
        const response = await axios.get('http://localhost:8080/users');
        console.log('fetchUsers response:', response.data); // Debug
        commit('SET_USERS', response.data);
      } catch (error) {
        console.error('Error fetching users:', error);
      }
    },
    async saveUser({ dispatch }, user) {
      try {
        if (user.id) {
          const response = await axios.put(`http://localhost:8080/users/${user.id}`, user);
          console.log('updateUser response:', response.data); // Debug
        } else {
          const response = await axios.post('http://localhost:8080/users', user);
          console.log('createUser response:', response.data); // Debug
        }
        dispatch('fetchUsers');
      } catch (error) {
        console.error('Error saving user:', error);
      }
    },
    async deleteUser({ dispatch }, id) {
      try {
        const response = await axios.delete(`http://localhost:8080/users/${id}`);
        console.log('deleteUser response:', response.data); // Debug
        dispatch('fetchUsers');
      } catch (error) {
        console.error('Error deleting user:', error);
      }
    }
  },
  modules: {}
});
