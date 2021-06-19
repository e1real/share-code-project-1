<template>
  <div class="layout-resolution">
    <h5 class="layout-resolution__title">Layout and resolution</h5>
    <p class="layout-resolution__description">
      Select layout and resolution screen or add your custom resolution.
    </p>
    <div class="layout-resolution__list layout-resolution-list">
      <ResolutionRadioCard
        v-for="(resolution, index) in resolutions"
        :key="index"
        :resolution="resolution"
      />
    </div>
  </div>
</template>
<script>
import ResolutionRadioCard from '@/components/cards/ResolutionRadioCard'

export default {
  components: {
    ResolutionRadioCard,
  },
  data() {
    return {
      resolutions: [
        {
          active: false,
          description: 'Poster Horizontal',
          resolution: '16:9',
        },
        {
          active: true,
          description: 'Poster Vertical',
          resolution: '9:16',
        },
        {
          active: false,
          description: 'Poster Horizontal ',
          resolution: '16:10',
        },
        {
          active: false,
          description: 'Poster Vertical',
          resolution: '10:16',
        },
        {
          active: false,
          description: 'Poster Horizontal',
          resolution: '4:3',
        },
        {
          active: false,
          description: 'Square',
          resolution: '1:1',
        },
        {
          active: false,
          description: 'Rectangle',
          resolution: '1:2',
        },
        {
          active: false,
          description: 'Rectangle',
          resolution: '2:1',
        },
        {
          active: false,
          description: 'Cinemascope',
          resolution: '21:9',
        },
      ],
    }
  },
}
</script>
<style lang="scss" scoped>
.layout-resolution {
  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__description {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: 100%;
    color: #778699;
    margin-top: 8px;
  }
}

.layout-resolution-list {
  position: relative;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-column-gap: 30px;
  grid-row-gap: 15px;
  min-height: 40vh;
  margin-top: 30px;
}
</style>
