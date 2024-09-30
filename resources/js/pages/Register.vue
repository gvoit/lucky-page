<template>
    <v-app>
      <v-main>
        <v-container>
            <v-row class="d-flex justify-center align-center">
                <v-col v-if="luckyPageUrl" cols="12" md="4">
                  <Link :href="luckyPageUrl">{{ luckyPageUrl }}</Link>
                </v-col>
                <v-col v-else cols="12" md="4">
                    <v-form @submit.prevent="register">
                        <v-text-field
                            label="Username"
                            v-model="formData.username"
                            :error-messages="formErrors.username"
                        ></v-text-field>
            
                        <v-text-field
                            label="Phone Number"
                            v-model="formData.phone_number"
                            :error-messages="formErrors.phone_number"
                        ></v-text-field>
            
                        <v-btn type="submit" color="primary">Go</v-btn>
                    </v-form>
                </v-col>

            </v-row>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { userApi } from '@/api/userApi';
  import { Link } from '@inertiajs/vue3';

  const formData = ref({});
  const formErrors = ref({});

  const luckyPageUrl = ref(null);

  async function register() {
    try {
      const response = await userApi.register(formData.value);
      luckyPageUrl.value = route('web.lucky.page', {token: response.token});
      
    } catch (error) {
      if (error.response?.status === 422) {
        formErrors.value = error.response.data?.errors ?? {};

        return;
      }

      throw error;
    } 
  }

  </script>
  