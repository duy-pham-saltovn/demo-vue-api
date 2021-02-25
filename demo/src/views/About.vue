<template>
  <div class="container">
    <h1 v-if="isActive">This is an about page (Active page)</h1>
    <h1 v-else>This is an about page</h1>
    <button @click="handleClick" type="button" class="btn btn-primary">
      Click here
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isActive: false,
      error: null
    }
  },
  methods: {
    handleClick() {
      console.log('handle click')
    }
  }
}
</script>