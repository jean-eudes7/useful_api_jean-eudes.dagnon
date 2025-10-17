import { defineStore } from 'pinia';
import axios from 'axios';

export const useDashboardStore = defineStore('dashboard', {
  state: () => ({
    data: null as any,
    loading: false,
    error: null as string | null,
  }),
  actions: {
    async fetchData() {
      this.loading = true;
      this.error = null;
      try {
        const response = await axios.get('http://localhost:8000/api/dashboard');
        this.data = response.data;
      } catch (error: any) {
        this.error = 'Erreur lors du chargement des données: ' + error.message;
      } finally {
        this.loading = false;
      }
    },
  },
});

