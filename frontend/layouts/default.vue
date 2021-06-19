<template>
  <div class="main-layout-wrapper">
    <Navbar />
    <section class="main-content">
      <nuxt />
    </section>
  </div>
</template>

<script>
import Navbar from '~/components/nav/Navbar'

export default {
  components: {
    Navbar,
  },
  data() {
    return {
      items: [
        {
          title: 'Home',
          icon: 'home',
          to: { name: 'index' },
        },
        {
          title: 'Inspire',
          icon: 'lightbulb',
          to: { name: 'inspire' },
        },
      ],
    }
  },
}
</script>

<style lang="scss" scoped>
.main-layout-wrapper {
  background-color: #f4f7fc;
}
</style>
