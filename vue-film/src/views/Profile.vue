<template>
  <div class="settings-page">
    <div class="container page">
      <div class="row">
        <div class="col-md-6 offset-md-3 col-xs-12">
          <h1 class="text-xs-center">Your Profile</h1>
          <form @submit.prevent="updateProfile()">
            <fieldset>
              <fieldset class="form-group">
                <input class="form-control form-control-lg" type="text"
                  v-model="currentUser.username"
                  placeholder="Your username">
              </fieldset>
              <fieldset class="form-group">
                <input class="form-control form-control-lg" type="text"
                  v-model="currentUser.email"
                  placeholder="Email">
              </fieldset>
              <fieldset class="form-group">
                <input class="form-control form-control-lg" type="password"
                  v-model="currentUser.password"
                  placeholder="Password">
              </fieldset>
              <button class="btn btn-lg btn-primary pull-xs-right">
                Update Profile
              </button>
            </fieldset>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import { mapGetters } from 'vuex'
  import { UPDATE_USER } from '@/store/actions.type'

  export default {
    name: 'RwvSettings',
    computed: {
      ...mapGetters([
        'currentUser'
      ])
    },
    methods: {
      updateProfile () {
        this.$store.dispatch(UPDATE_USER, this.currentUser)
          .then(() => {
            // this.$router.push({ name: 'home' })
          })
      }
    }
  }
</script>
