<template>
  <nav>
    <ul class="pagination">
      <li :class="paginationClass(0)" @click.prevent="prev()"><a class="page-link" href> << </a></li>
      <li
        v-for="page in pages"
        :key="page"
        :class="paginationClass(page)"
        @click.prevent="changePage(page)"
      >
        <a class="page-link" href>{{page}}</a>
      </li>
      <li :class="paginationClass(0)" @click.prevent="next()"><a class="page-link" href> >> </a></li>
    </ul>
  </nav>
</template>

<script>
export default {
  name: 'Pagination',
  props: {
    pages: {
      type: Array,
      required: true
    },
    currentPage: {
      type: Number,
      required: true
    }
  },
  methods: {
    prev () {
      if (this.currentPage < 2) return
      this.changePage(this.currentPage - 1)
    },
    next () {
      if (this.currentPage > this.pages.length - 1) return
      this.changePage(this.currentPage + 1)
    },
    changePage (goToPage) {
      if (goToPage === this.currentPage) return
      this.$emit('update:currentPage', goToPage)
    },
    paginationClass (page) {
      return {
        'page-item': true,
        active: this.currentPage === page
      }
    }
  }
}
</script>
