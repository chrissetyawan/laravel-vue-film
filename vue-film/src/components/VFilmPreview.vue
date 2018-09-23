<template>

  <div class="film-preview">
    <router-link
      :to="{name: 'film-detail', params: {'slug': film.slug}}"
      class="preview-link">
      <h1>{{film.name}}</h1>
      <p>{{film.description}}</p>
      <span style="color:#9bc4e2;"><b>Click here for more detail...</b></span>
      <ul class="genre-list">
        <li class="genre-default genre-pill genre-outline"
         v-for="(genre, index) of film.genreList"
         :key="genre + index">
         {{ genre }}
        </li>
      </ul>
    </router-link>
  </div>
</template>

<script>
export default {
  name: 'RwvFilmPreview',
  props: {
    film: { type: Object, required: true }
  }
}
</script>
