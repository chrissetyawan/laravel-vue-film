<template>
  <div class="card">
    <div class="card-block">
      <p class="card-text">
        {{ comment.body }}
      </p>
    </div>
    <div class="card-footer">
      <span class="comment-author">{{ comment.author.username }}</span>
      <span class="date-posted">{{ comment.createdAt | date }}</span>
      <span v-if="isCurrentUser" class="mod-options">
        <i class="ion-trash-a" v-on:click="destroy(slug, comment.id)"></i>
      </span>
    </div>
  </div>
</template>
<script>
  import { mapGetters } from 'vuex'
  import { COMMENT_DESTROY } from '@/store/actions.type'

  export default {
    name: 'RwvComment',
    props: {
      slug: { type: String, required: true },
      comment: { type: Object, required: true }
    },
    computed: {
      isCurrentUser () {
        if (this.currentUser.username && this.comment.author.username) {
          return this.comment.author.username === this.currentUser.username
        }
        return false
      },
      ...mapGetters([
        'currentUser'
      ])
    },
    methods: {
      destroy (slug, commentId) {
        this.$store.dispatch(COMMENT_DESTROY, { slug, commentId })
      }
    }
  }
</script>
