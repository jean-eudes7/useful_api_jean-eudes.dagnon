<template>
  <div class="auth-form">
    <h1>Inscription</h1>
    <form @submit.prevent="handleRegister">
      <input type="text" v-model="name" placeholder="Nom" required />
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Mot de passe" required />
      <button type="submit" :disabled="authStore.loading">
        {{ authStore.loading ? 'Inscription...' : 'S\'inscrire' }}
      </button>
      <p v-if="authStore.error" class="error-message">{{ authStore.error }}</p>
      <p v-if="successMessage" class="success-message">{{ successMessage }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const name = ref('');
const email = ref('');
const password = ref('');
const successMessage = ref('');

const handleRegister = async () => {
  await authStore.register({ name: name.value, email: email.value, password: password.value });
  if (!authStore.error) {
    successMessage.value = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
  }
};
</script>
