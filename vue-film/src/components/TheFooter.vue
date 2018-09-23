<template>
  <footer>
    <div class="container">
      <router-link class="logo-font"
        :to="{ name: 'home', params: {} }">
        codeline
      </router-link>
      <span class="attribution">
        Copyright 2018
        <a target="blank" href="https://codeline.io">Codeline</a>. 
      </span>
    </div>
  </footer>
</template>
<script>
export default {
  name: 'rwvFooter'
}
</script>
