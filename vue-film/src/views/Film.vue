<template>
    <div class="home-global">
      <RwvFilmList type="all" />
    </div>
</template>
<script>
  import RwvFilmList from '@/components/FilmList'

  export default {
    name: 'rwv-films',
    components: {
      RwvFilmList
    }
  }
</script>
