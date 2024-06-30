<template>
    <div class="card mb-3">
      <div class="card-body">
        <form @submit.prevent="handleSubmit">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" v-model="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" v-model="email" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
          <button type="button" class="btn btn-secondary" @click="resetForm">Reset</button>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import { mapActions } from 'vuex';
  
  export default {
    data() {
      return {
        name: '',
        email: '',
        editingId: null
      };
    },
    methods: {
      ...mapActions(['saveUser', 'fetchUsers']),
      handleSubmit() {
        const user = { name: this.name, email: this.email, id: this.editingId };
        this.saveUser(user).then(() => {
          this.resetForm();
          this.fetchUsers();
        });
      },
      resetForm() {
        this.name = '';
        this.email = '';
        this.editingId = null;
      }
    },
    created() {
      this.fetchUsers();
    }
  };
  </script>
  