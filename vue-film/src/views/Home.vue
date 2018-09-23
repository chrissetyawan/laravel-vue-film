<template>
 
    <div class="container page">
      <div class="row">
        <div class="col-md-12">
          Home
        </div>
      </div>
    </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  export default {
    name: 'home',
    components: {
    },
    mounted () {
    },
    computed: {
      ...mapGetters([
        'isAuthenticated'
      ])
    }
  }
</script>
