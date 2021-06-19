<template>
  <div class="places-card-wrapper" @click="$emit('click')">
    <div class="places-card">
      <img
        v-if="!place.photos.length"
        class="places-card__img"
        src="https://via.placeholder.com/186"
        alt="place image"
      />
      <img
        v-else
        class="places-card__img"
        :src="place.photos[0].url"
        alt="place image"
      />
      <div class="places-card__body">
        <h5 class="places-card__title">{{ place.name }}</h5>
        <p class="places-card__description">
          {{ place.place_address }}
        </p>
      </div>
      <div class="places-card__footer">
        <div v-for="(day, index) in week" :key="index" class="places-card__day">
          <span class="places-card__day-title">{{ day }}</span>
          <span
            :class="[
              'places-card__day-status',
              'day-status',
              // { 'day-status--is-open': isOpen(place, index) },
              // { 'day-status--is-close': isClose(place, index) },
            ]"
          ></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const IS_OPEN = 1
const IS_CLOSE = 2

export default {
  props: {
    place: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      week: ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'],
    }
  },
  methods: {
    /**
     * Check day is open
     * @param {Object} place
     * @param {number} dayIndex
     */
    isOpen(place, dayIndex) {
      return place.open[dayIndex + 1] === IS_OPEN
    },
    /**
     * Check day if close
     * @param {Object} place
     * @param {number} dayIndex
     */
    isClose(place, dayIndex) {
      return place.open[dayIndex + 1] === IS_CLOSE
    },
  },
}
</script>

<style lang="scss" scoped>
.places-card-wrapper {
  width: 100%;
  height: 328px;
}

.places-card {
  display: flex;
  flex-direction: column;
  background: #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  width: 100%;
  height: 100%;
  cursor: pointer;

  &__img {
    height: 186px;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  &__body {
    padding: 16px 14px 0;
    flex-grow: 1;
  }

  &__title {
    font-family: 'Inter', sans-serif;
    font-weight: 500;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    margin-bottom: 6px;
  }

  &__description {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    line-height: 100%;
    color: #778699;
  }

  &__footer {
    display: flex;
    border-top: 1px solid #d7e1ea;
    height: 51px;
    padding: 16px 0 0 14px;
  }

  &__day {
    display: flex;
    flex-direction: column;
    align-items: center;

    &:not(:last-child) {
      margin-right: 12px;
    }
  }

  &__day-title {
    font-family: 'Inter', sans-serif;
    font-size: 12px;
    line-height: 100%;
    color: #778699;
    text-transform: capitalize;
  }

  &__day-status {
    margin-top: 6px;
  }

  &:hover {
    box-shadow: 0 24px 32px rgba(0, 0, 0, 0.1);
  }
}

.day-status {
  width: 6px;
  height: 6px;
  border-radius: 50%;

  &--is-open {
    border: 1px solid #00bc8a;
  }

  &--is-close {
    border: 1px solid #ef233c;
  }
}
</style>
