<template>
  <div class="auth-form">
    <h1>Connexion</h1>
    <form @submit.prevent="handleLogin">
      <input type="email" v-model="email" placeholder="Email" required />
      <input type="password" v-model="password" placeholder="Mot de passe" required />
      <button type="submit" :disabled="authStore.loading">
        {{ authStore.loading ? 'Connexion...' : 'Se connecter' }}
      </button>
      <p v-if="authStore.error" class="error-message">{{ authStore.error }}</p>
    </form>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import { useAuthStore } from '@/stores/auth';

const authStore = useAuthStore();
const router = useRouter();

const email = ref('');
const password = ref('');

const handleLogin = async () => {
  await authStore.login({ email: email.value, password: password.value });
  if (authStore.token) {
    router.push('/');
  }
};
</script>
