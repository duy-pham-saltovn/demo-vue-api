<template>
  <div class="row">
    <div class="col-4 item" v-if="typeof totalItem === undefined">
      <div class="timeline-wrapper">
        <div class="timeline-item">
          <div class="animated-background">
            <div class="background-masker header-image"></div>
            <div class="background-masker content-top"></div>
            <div class="background-masker content-second-line"></div>
            <div class="background-masker content-second-end"></div>
            <div class="background-masker content-third-line"></div>
            <div class="background-masker desc-first-line"></div>
          </div>
        </div>
      </div>
    </div>
    <div
      :class="`col-${typeof col !== undefined ? col : 4}`"
      v-else
      v-for="item in totalItem"
      :key="item"
    >
      <div class="timeline-wrapper">
        <div class="timeline-item">
          <div class="animated-background">
            <div class="background-masker header-image"></div>
            <div class="background-masker content-top"></div>
            <div class="background-masker content-second-line"></div>
            <div class="background-masker content-second-end"></div>
            <div class="background-masker content-third-line"></div>
            <div class="background-masker desc-first-line"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'comp-loading',
  props: ['totalItem', 'col']
}
</script>
<style lang="scss">
@import '../assets/loading.scss';
</style>