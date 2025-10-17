<template>
  <div class="dashboard">
    <h1>Mini Dashboard Interactif</h1>
    <button @click="store.fetchData()" :disabled="store.loading">
      {{ store.loading ? "Chargement..." : "Actualiser les données" }}
    </button>
    <div v-if="store.loading" class="loading">Chargement des données...</div>
    <div v-else-if="store.error" class="error">{{ store.error }}</div>
    <div v-else-if="store.data" class="content">
      <h2>Statistiques</h2>
      <p>Utilisateurs inscrits : {{ store.data.users }}</p>
      <p>Commandes traitées : {{ store.data.orders }}</p>
      <p>Revenu total : {{ store.data.revenue }} €</p>
    </div>
  </div>
</template>

<script setup lang="ts">
import { onMounted } from "vue";
import { useDashboardStore } from "@/stores/dashboard";

const store = useDashboardStore();

onMounted(() => {
  store.fetchData();
});
</script>
