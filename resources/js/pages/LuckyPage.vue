<template>
    <v-app>
      <v-main>
        <v-container>
            <v-row class="d-flex justify-center align-center">
                <v-col cols="12" md="4">
                  <Link v-if="newLuckyPageUrl"  :href="newLuckyPageUrl">{{ newLuckyPageUrl }}</Link>
                  <v-btn v-else @click="createNewLuckyPageLink" color="primary" class="text-none">Generate New Link</v-btn>
                </v-col>
            </v-row>
            <v-row class="d-flex justify-center align-center">
                <v-col cols="12" md="4">
                  <v-alert
                    v-if="currentTokenDeactivated"
                    title="Current Lucky Page Toke is Deactivated"
                    type="warning"
                  ></v-alert>
                  <v-btn v-else @click="deactivateCurrentToken" color="error" class="text-none">Deactivate Current Link</v-btn>
                </v-col>
            </v-row>
            <v-row class="d-flex justify-center align-center">
                <v-col cols="12" md="4">
                  <v-btn color="green" class="text-none" @click="imFeelingLucky">Imfeelinglucky</v-btn>
                </v-col>
                <v-col cols="12">
                  <v-alert
                    :color="newImFeelingLuckyResult.is_winner ? 'success' : 'error'"
                    elevation="2"
                    v-if="newImFeelingLuckyResult"
                  >
                    <v-list>
                      <v-list-item>{{ newImFeelingLuckyResult.random_number}}</v-list-item>
                      <v-list-item>{{ newImFeelingLuckyResult.is_winner ? 'Win': 'Lose'  }}</v-list-item>
                      <v-list-item>Prize: {{ newImFeelingLuckyResult.prize}}</v-list-item>
                    </v-list>
                  </v-alert>
                </v-col>
                
            </v-row>
            <v-row class="d-flex justify-center align-center">
                <v-col  cols="12" md="4">
                  <v-btn @click="imFeelingLuckyHistory" color="grey" class="text-none">History</v-btn>
                </v-col>
            </v-row>
            <v-row class="d-flex justify-center align-center">
                <v-col v-for="entity in imFeelingLuckyHistoryCollection">
                  <v-card>
                    <v-alert
                    :color="entity.is_winner ? 'success': 'error'"
                    >
                      <v-list>
                        <v-list-item>{{ entity.random_number}}</v-list-item>
                        <v-list-item>{{ entity.is_winner ? 'Win': 'Lose'  }}</v-list-item>
                        <v-list-item>Prize: {{ entity.prize}}</v-list-item>
                      </v-list>
                    </v-alert>
                  </v-card>
                </v-col>
            </v-row>
        </v-container>
      </v-main>
    </v-app>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { luckyApi } from '@/api/luckyApi';
  import { Link } from '@inertiajs/vue3';


  const newImFeelingLuckyResult = ref(null);
  const imFeelingLuckyHistoryCollection = ref([]);
  const currentTokenDeactivated = ref(false);
  const newLuckyPageUrl = ref(null);

  const props = defineProps({
    accessToken: {
        type: String,
        required: true,
    }
  });

  async function createNewLuckyPageLink() {
      const response = await luckyApi.createNewToken(props.accessToken);
      
      newLuckyPageUrl.value = route('web.lucky.page', {token: response.token});
  }

  async function deactivateCurrentToken() {
      await luckyApi.deactivateCurrentToken(props.accessToken);
      currentTokenDeactivated.value = true;
  }

  async function imFeelingLuckyHistory() {
      imFeelingLuckyHistoryCollection.value = await luckyApi.imFeelingLuckyHistory(props.accessToken);
  }

  async function imFeelingLucky() {
    newImFeelingLuckyResult.value = await luckyApi.imFeelingLucky(props.accessToken);
  }

  </script>
  