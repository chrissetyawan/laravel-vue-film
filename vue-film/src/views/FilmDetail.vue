<template>
  <div class="film-page">

    <div class="container">
      <div style="text-align: center;">
          <img :src="film.photo" class="film-photo" />
      </div>
      <h3>{{ film.name }}</h3>
    </div>

    <div class="container page">
      <div class="row ">
        <div class="col-xs-12">

          <div class="film-info">
              <div >Release Date : {{ film.release_date | date }}</div>
              <div >Rating : {{ film.rating }}</div>
              <div >Ticket Price : {{ film.ticket_price }}</div>
              <div >Country : {{ film.country }}</div>

              <div>
                Genre : 
                <ul class="genre-list" >
                  <li
                    v-for="(genre, index) of film.genreList"
                    :key="genre + index">
                    <RwvGenre :name="genre" className=""></RwvGenre>
                  </li>
                </ul>
              </div>
          </div>

          <div v-html="parseMarkdown(film.description)"></div>
        </div>
      </div>
      <hr/>
    
      <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
          <RwvCommentEditor
            v-if="isAuthenticated"
            :slug="slug"
            :userImage="currentUser.image">
          </RwvCommentEditor>
          <p v-else>
            <router-link :to="{name: 'login'}">Sign in</router-link>
            or
            <router-link :to="{ name: 'register' }">sign up</router-link>
            to add comments on this film.
          </p>
          <RwvComment
            v-for="(comment, index) in comments"
            :slug="slug"
            :comment="comment"
            :key="index">
          </RwvComment>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapGetters } from 'vuex'
  import marked from 'marked'
  import store from '@/store'
  import RwvComment from '@/components/Comment'
  import RwvCommentEditor from '@/components/CommentEditor'
  import RwvGenre from '@/components/VGenre'
  import { FETCH_FILM, FETCH_COMMENTS } from '@/store/actions.type'

  export default {
    name: 'rwv-filmdetail',
    props: {
      slug: {
        type: String,
        required: true
      }
    },
    components: {
      RwvComment,
      RwvCommentEditor,
      RwvGenre
    },
    mounted: function () {
      this.$nextTick(function () {
      })
    },
    beforeRouteEnter (to, from, next) {
      console.log('to=', to)
      if (to.path !== 'film=detail') {
        Promise.all([
          store.dispatch(FETCH_FILM, to.params.slug),
          store.dispatch(FETCH_COMMENTS, to.params.slug)
        ]).then((data) => {
          next()
        })
      } else {
        this.$router.push({ name: 'film-create' })
      }
    },
    computed: {
      ...mapGetters([
        'film',
        'currentUser',
        'comments',
        'isAuthenticated'
      ])
    },
    methods: {
      parseMarkdown (content) {
        return marked(content)
      }
    }
  }
</script>

<style lang="css">
.film-info {
  font-size: 13px;
  color:#808080;
}
.film-photo {
  width:420px;
  margin: 60px 0px;
}
</style>