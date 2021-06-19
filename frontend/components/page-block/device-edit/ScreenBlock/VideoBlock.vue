<template>
  <div class="video-block">
    <h5 class="video-block__title">Video</h5>
    <p class="video-block__description">
      Supported video lenght. You can select multiple options.
    </p>
    <div class="video-block__row-checkboxes">
      <VCheckBox
        v-model="checkboxValue"
        class="video-block__checkbox"
        label="5 sec."
      />
      <VCheckBox
        v-model="checkboxValue2"
        class="video-block__checkbox"
        label="7.5 sec."
      />
      <VCheckBox
        v-model="checkboxValue3"
        class="video-block__checkbox"
        label="10 sec."
      />
      <VCheckBox
        v-model="checkboxValue4"
        class="video-block__checkbox"
        label="15 sec."
      />
      <VCheckBox
        v-model="checkboxValue5"
        class="video-block__checkbox"
        label="30 sec."
      />
      <VCheckBox
        v-model="checkboxValue6"
        class="video-block__checkbox"
        label="60 sec."
      />
      <VCheckBox
        v-model="checkboxValue7"
        class="video-block__checkbox"
        label="90 sec."
      />
      <VCheckBox
        v-model="checkboxValue8"
        class="video-block__checkbox"
        label="120 sec."
      />
    </div>
  </div>
</template>
<script>
import VCheckBox from '@/components/form/VCheckBox'

export default {
  components: {
    VCheckBox,
  },
  data() {
    return {
      checkboxValue: null,
      checkboxValue2: null,
      checkboxValue3: null,
      checkboxValue4: null,
      checkboxValue5: null,
      checkboxValue6: null,
      checkboxValue7: null,
      checkboxValue8: null,
    }
  },
}
</script>
<style lang="scss" scoped>
.video-block {
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

  &__row-checkboxes {
    display: flex;
    margin-top: 20px;
  }

  &__checkbox:not(:last-child) {
    margin-right: 10px;
  }
}

.video-block-list {
  position: relative;
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  grid-column-gap: 30px;
  grid-row-gap: 15px;
  min-height: 40vh;
  margin-top: 30px;
}
</style>
