<template>
  <div class="container">
    <Items :isLoading="isLoading" :items="items" />
  </div>
</template>

<script>
import Items from '@/components/Items.vue'
import useFetchPosts from '../api/use-fetch-posts'
import { API_URL, CONFIG } from '../configs/constant'

export default {
  components: { Items },
  name: 'Home',
  data() {
    return {
      isLoading: true,
      items: [],
      errors: null
    }
  },
  methods: {
    async fetchData() {
      const { data, fetching } = await useFetchPosts(
        `${API_URL}${CONFIG.API_POST}`
      )
      this.items = data
      this.isLoading = fetching
    }
  },
  created() {
    this.fetchData()
  }
}
</script>
 
<style lang="scss">
.items {
  .item {
    margin-bottom: 20px;
  }
}
</style>
