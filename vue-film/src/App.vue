<template>
  <div id="app">
    <rwv-header></rwv-header>
    <div class="home-page">
      <div class="banner">
        <div class="container">
          <h1 class="logo-font">Codeline</h1>
          <p>Codeline is designed to deliver exactly what you need.</p>
        </div>
      </div>
      <div class="container page">
        <div class="row">
          <div class="col-md-12">
            <router-view></router-view>
          </div>
        </div>
      </div>
    </div>
    <rwv-footer></rwv-footer>
  </div>
</template>

<script>
import RwvHeader from '@/components/TheHeader'
import RwvFooter from '@/components/TheFooter'

export default {
  name: 'App',
  components: {
    RwvHeader,
    RwvFooter
  }
}
</script>

<style>
</style>
