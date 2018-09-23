<template>
  <nav class="navbar navbar-light">
    <div class="container">
      <router-link class="navbar-brand"
        :to="{ name: 'home' }">
        Codeline
      </router-link>
      <ul v-if="!isAuthenticated" class="nav navbar-nav pull-xs-right">
        <li class="nav-item">
          <router-link class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'home' }">
            <i class="ion-home"></i>&nbsp;Home
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'login' }">
            <i class="ion-log-in"></i>Sign in
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'register' }">
            <i class="ion-compose"></i>Sign up
          </router-link>
        </li>
      </ul>
      <ul v-else class="nav navbar-nav pull-xs-right">
        <li class="nav-item">
          <router-link
            class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'home' }">
            <i class="ion-home"></i>&nbsp;Home
          </router-link>
        </li>
        <li class="nav-item">
          <router-link
            class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'films' }">
            <i class="ion-laptop"></i>&nbsp;Films
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link"
            active-class="active"
            :to="{ name: 'film-create' }">
            <i class="ion-compose"></i>&nbsp;New Film
          </router-link>
        </li>
        <li class="nav-item">
          <router-link class="nav-link"
            active-class="active"
            exact
            :to="{ name: 'profile' }">
            <i class="ion-person"></i>&nbsp;Profile
          </router-link>
        </li>

        <li class="nav-item">
            <a href="#/home" class="nav-link" @click="logout()"> <i class="ion-log-out"></i>&nbsp; Sign Out </a>
        </li>
      </ul>
    </div>
  </nav>

  
</template>
<script>
  import { mapGetters } from 'vuex'
  import { LOGOUT } from '@/store/actions.type'

  export default {
    name: 'RwvHeader',
    computed: {
      ...mapGetters([
        'currentUser',
        'isAuthenticated'
      ])
    },
    methods: {
      logout () {
        this.$store.dispatch(LOGOUT).then(() => { this.$router.push({ name: 'login' }) })
      }
    }
  }
</script>
