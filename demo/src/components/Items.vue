<template>
  <Loading v-if="isLoading" :totalItem="9" :col="4" />
  <div class="row items" v-else>
    <div class="col-4" v-for="item in items" :key="item.id" :data-id="item.id">
      <div class="item">
        <div class="thumbnail">
          <router-link to="/">
            <img class="img-fluid" src="../assets/item.jpg" alt="aaa" />
          </router-link>
        </div>
        <div class="info">
          <h3 class="title">{{ item.title }}</h3>
          <p class="card-text mb-auto desc">{{ item.desc }}</p>
        </div>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
import Loading from '../components/Loading.vue'

export default {
  props: {
    isLoading: Boolean,
    items: Array
  },
  components: {
    Loading
  }
}
</script>