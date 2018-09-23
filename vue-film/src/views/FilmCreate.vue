<template>
  <div class="editor-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-10 offset-md-1 col-xs-12">
          <RwvListErrors :errors="errors"/>
          <form v-on:submit.prevent="onPublish(film)">

            <fieldset :disabled="inProgress">

              <fieldset class="form-group">
                <input
                  type="text"
                  class="form-control "
                  v-model="film.name"
                  placeholder="Film Name">
              </fieldset>
              
              <fieldset class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="film.photo"
                  placeholder="Image url">
              </fieldset>

              <fieldset class="form-group">
                <input
                  type="date"
                  class="form-control"
                  v-model="film.release_date"
                  placeholder="Release Date">
              </fieldset>

              <fieldset class="form-group">
                <input
                  type="number" min="1" max="5"
                  class="form-control"
                  v-model="film.rating"
                  placeholder="Rating">
              </fieldset>

              <fieldset class="form-group">
                <input
                  type="number" min="0"
                  class="form-control"
                  v-model="film.ticket_price"
                  placeholder="Ticket price">
              </fieldset>

              <fieldset class="form-group">
                <input
                  type="text"
                  class="form-control"
                  v-model="film.country"
                  placeholder="Country">
              </fieldset>

              <fieldset class="form-group">
                <textarea
                  class="form-control"
                  rows="4"
                  v-model="film.description"
                  placeholder="Description">
                </textarea>
              </fieldset>

              <fieldset class="form-group">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Enter genres"
                  v-model="genreInput"
                  v-on:keypress.enter.prevent="addGenre(genreInput)">
                <div class="genre-list">
                  <span class="genre-default genre-pill"
                    v-for="(genre, index) of film.genreList"
                    :key="genre + index">
                    <i class="ion-close-round"
                      v-on:click="removeGenre(genre)">
                    </i>
                    {{ genre }}
                  </span>
                </div>
              </fieldset> (Press enter to add genre)
              
            </fieldset>

            <button
              :disabled="inProgress"
              class="btn btn-lg pull-xs-right btn-primary"
              type="submit">
              Save Film
            </button>

          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import RwvListErrors from '@/components/ListErrors'
  import { FilmsService } from '@/common/api.service'

  export default {
    name: 'RwvFilmCreate',
    components: { RwvListErrors },
    data () {
      return {
        genreInput: null,
        inProgress: false,
        errors: {},
        film: {
          slug: '',
          name: '',
          description: '',
          release_date: '',
          rating: '',
          ticket_price: '',
          country: '',
          photo: '',
          genreList: []
        }
      }
    },
    methods: {
      onPublish (film) {
        // console.log('film=' + JSON.stringify(film))
        this.inProgress = true
        FilmsService.create(film)
          .then(({ data }) => {
            this.inProgress = false
            this.$router.push({
              name: 'film-detail',
              params: { slug: data.film.slug }
            })
          })
          .catch(({ response }) => {
            this.inProgress = false
            this.errors = response.data.errors
          })
      },
      removeGenre (genre) {
        this.film.genreList = this.film.genreList.filter(t => t !== genre)
      },
      addGenre (genre) {
        this.film.genreList = this.film.genreList.concat([genre])
        this.genreInput = null
      }
    }
  }
</script>
