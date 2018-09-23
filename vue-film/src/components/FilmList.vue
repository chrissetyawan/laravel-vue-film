<template>
  <div>
    <div v-if="isLoading" class="film-preview">
      Loading films...
    </div>
    <div v-else>
      <div v-if="films.length === 0" class="film-preview">
        No films are here... yet.
      </div>
      
      <rwv-film-preview
        v-for="(film, index) in films"
        :film="film"
        :key="film.name + index">
      </rwv-film-preview>

      <v-pagination
        :pages="pages"
        :currentPage.sync="currentPage"
      ></v-pagination>

    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import RwvFilmPreview from '@/components/VFilmPreview'
  import VPagination from '@/components/VPagination'
  import { FETCH_FILMS } from '@/store/actions.type'

  export default {
    name: 'rwv-film-list',
    components: {
      RwvFilmPreview,
      VPagination
    },
    props: {
      type: {
        type: String,
        required: false,
        default: 'all'
      },
      itemsPerPage: {
        type: Number,
        required: false,
        default: 1
      }
    },
    data () {
      return {
        currentPage: 1
      }
    },
    computed: {
      listConfig () {
        const { type } = this
        const filters = {
          offset: (this.currentPage - 1) * this.itemsPerPage,
          limit: this.itemsPerPage
        }
        if (this.author) {
          filters.author = this.author
        }
        return {
          type,
          filters
        }
      },
      pages () {
        if (this.isLoading || this.filmsCount <= this.itemsPerPage) {
          return []
        }
        return [...Array(Math.ceil(this.filmsCount / this.itemsPerPage)).keys()].map(e => e + 1)
      },
      ...mapGetters([
        'filmsCount',
        'isLoading',
        'films'
      ])
    },
    watch: {
      currentPage (newValue) {
        this.listConfig.filters.offset = (newValue - 1) * this.itemsPerPage
        this.fetchFilms()
      },
      type () {
        this.resetPagination()
        this.fetchFilms()
      }
    },
    mounted () {
      this.fetchFilms()
    },
    methods: {
      fetchFilms () {
        this.$store.dispatch(FETCH_FILMS, this.listConfig)
      },
      resetPagination () {
        this.listConfig.offset = 0
        this.currentPage = 1
      }
    }
  }
</script>
