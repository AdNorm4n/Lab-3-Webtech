<template>
    <div class="card">
      <div class="card-header">
        Users List
      </div>
      <ul class="list-group list-group-flush">
        <li v-for="user in users" :key="user.id" class="list-group-item d-flex justify-content-between align-items-center">
          <div>
            <h5>{{ user.name }}</h5>
            <p>{{ user.email }}</p>
          </div>
          <div>
            <button class="btn btn-warning btn-sm me-2" @click="editUser(user)">Edit</button>
            <button class="btn btn-danger btn-sm" @click="deleteUser(user.id)">Delete</button>
          </div>
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  import { mapActions, mapState } from 'vuex';
  
  export default {
    computed: {
      ...mapState(['users'])
    },
    methods: {
      ...mapActions(['fetchUsers', 'deleteUser']),
      editUser(user) {
        this.$emit('edit-user', user);
      }
    },
    created() {
      this.fetchUsers();
    },
    watch: {
      users(newVal) {
        console.log('Users list updated:', newVal);
      }
    }
  };
  </script>
  