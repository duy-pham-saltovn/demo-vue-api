<template>
  <div class="navbar nav-tick">
    <div class="container">
      <div class="row">
        <ul class="col-12 nav-menu">
          <li>
            <router-link class="item" to="/"> Home </router-link>
          </li>
          <li>
            <router-link class="item" to="/about"> About </router-link>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>
<script lang="ts">
export default {
  name: 'Header'
}
</script>
