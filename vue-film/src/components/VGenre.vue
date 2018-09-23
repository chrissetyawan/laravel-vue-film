<template>
  <div :class="className"> {{ name }} &nbsp </div>
  <!--
  <router-link :to="{ name: 'home-tag', params: { tag: name } }" :class="className">
  </router-link>
  -->
</template>
<script>
  export default {
    name: 'RwvGenre',
    props: {
      name: {
        type: String,
        required: true
      },
      className: {
        type: String,
        // default: 'genre-pill genre-default'
        default: ''
      }
    }
  }
</script>
