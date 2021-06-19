<template>
  <div class="opening-wrapper">
    <div class="opening">
      <h5 class="opening__title">Opening times</h5>
      <div class="opening__open-row">
        <VCheckBox
          :value="openingNonStop"
          class="opening__check opening__non-stop"
          label="Open nonstop"
          @change="$emit('update:opening-non-stop', $event)"
        />
        <VCheckBox
          :value="temporarilyClosed"
          class="opening__check"
          label="Temporarily closed"
          @change="$emit('update:temporarily-closed', $event)"
        />
      </div>
      <div class="opening__week-table opening-week-table">
        <div
          v-for="(day, index) in placeOpeningTime"
          :key="index"
          class="opening-week-table__row"
        >
          <div class="opening-week-table__row-item opening-week-table__day">
            {{ day.day_name }}
          </div>
          <div
            :class="[
              'opening-week-table__row-item',
              'opening-week-table__time',
              { 'opening-week-table__time--disabled': !day.open },
            ]"
          >
            <b-timepicker
              v-model="day.open"
              size="is-small"
              class="opening-week-table__time-label"
              placeholder="Open time"
              :increment-minutes="5"
              hour-format="24"
            >
            </b-timepicker>

            <svg
              class="opening-week-table__time-icon"
              width="16"
              height="16"
              viewBox="0 0 16 16"
              fill="#000638"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M7.9999 4.66665C8.88395 4.66665 9.7318 5.01784 10.3569 5.64296C10.982 6.26808 11.3332 7.11592 11.3332 7.99998C11.3332 8.88403 10.982 9.73188 10.3569 10.357C9.7318 10.9821 8.88395 11.3333 7.9999 11.3333C7.11584 11.3333 6.26799 10.9821 5.64287 10.357C5.01775 9.73188 4.66656 8.88403 4.66656 7.99998C4.66656 7.11592 5.01775 6.26808 5.64287 5.64296C6.26799 5.01784 7.11584 4.66665 7.9999 4.66665ZM7.9999 5.99998C7.46946 5.99998 6.96075 6.21069 6.58568 6.58577C6.21061 6.96084 5.9999 7.46955 5.9999 7.99998C5.9999 8.53041 6.21061 9.03912 6.58568 9.41419C6.96075 9.78927 7.46946 9.99998 7.9999 9.99998C8.53033 9.99998 9.03904 9.78927 9.41411 9.41419C9.78918 9.03912 9.9999 8.53041 9.9999 7.99998C9.9999 7.46955 9.78918 6.96084 9.41411 6.58577C9.03904 6.21069 8.53033 5.99998 7.9999 5.99998ZM7.9999 1.33331L9.59323 3.61331C9.0999 3.43331 8.5599 3.33331 7.9999 3.33331C7.4399 3.33331 6.8999 3.43331 6.40656 3.61331L7.9999 1.33331ZM2.22656 4.66665L4.9999 4.43331C4.5999 4.77331 4.2399 5.18665 3.9599 5.66665C3.66656 6.15998 3.4999 6.66665 3.40656 7.19331L2.22656 4.66665ZM2.2399 11.3333L3.41323 8.81998C3.50656 9.33331 3.68656 9.85331 3.96656 10.3333C4.24656 10.8266 4.60656 11.24 4.9999 11.58L2.2399 11.3333ZM13.7666 4.66665L12.5866 7.19331C12.4932 6.66665 12.3132 6.15331 12.0332 5.66665C11.7532 5.18665 11.3999 4.76665 10.9999 4.42665L13.7666 4.66665ZM13.7599 11.3333L10.9999 11.5733C11.3932 11.2333 11.7466 10.8133 12.0266 10.3333C12.3066 9.84665 12.4866 9.33331 12.5799 8.80665L13.7599 11.3333ZM7.9999 14.6666L6.39323 12.3733C6.88656 12.5533 7.42656 12.6666 7.9999 12.6666C8.54656 12.6666 9.08656 12.5533 9.5799 12.3733L7.9999 14.6666Z"
              />
            </svg>
          </div>
          <div
            :class="[
              'opening-week-table__row-item',
              'opening-week-table__time',
              { 'opening-week-table__time--disabled': !day.close },
            ]"
          >
            <b-timepicker
              v-model="day.close"
              size="is-small"
              class="opening-week-table__time-label"
              placeholder="Close time"
              :increment-minutes="5"
              hour-format="24"
            >
            </b-timepicker>
            <svg
              class="opening-week-table__time-icon"
              width="16"
              height="16"
              viewBox="0 0 16 16"
              fill="#000638"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                d="M11.8334 2.72669L10.1467 4.02002L10.7534 6.06002L9.00005 4.85335L7.24671 6.06002L7.85338 4.02002L6.16671 2.72669L8.29338 2.66669L9.00005 0.666687L9.70671 2.66669L11.8334 2.72669ZM14.1667 7.33335L13.0734 8.16669L13.4667 9.48669L12.3334 8.70669L11.2 9.48669L11.5934 8.16669L10.5 7.33335L11.8734 7.30002L12.3334 6.00002L12.7934 7.30002L14.1667 7.33335ZM12.6467 10.6334C13.2 10.58 13.7934 11.3667 13.44 11.8667C13.2267 12.1667 13 12.4467 12.72 12.7134C10.1134 15.3334 5.89338 15.3334 3.29338 12.7134C0.686712 10.1134 0.686712 5.88669 3.29338 3.28669C3.56005 3.02002 3.84005 2.78002 4.14005 2.56669C4.64005 2.21335 5.42671 2.80669 5.37338 3.36002C5.19338 5.26669 5.83338 7.24669 7.30005 8.70669C8.76005 10.1734 10.7334 10.8134 12.6467 10.6334ZM11.5534 11.98C9.66671 11.8734 7.80005 11.0934 6.35338 9.66669C4.90671 8.20669 4.13338 6.33335 4.02671 4.45335C2.15338 6.54669 2.22671 9.76002 4.23338 11.7734C6.24671 13.78 9.46005 13.8534 11.5534 11.98Z"
              />
            </svg>
          </div>
          <VCheckBox
            v-model="day.is_closed"
            class="opening-week-table__row-item opening__check"
            label="Closed"
          />
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import VCheckBox from '@/components/form/VCheckBox'

export default {
  components: {
    VCheckBox,
  },
  props: {
    placeOpeningTime: {
      type: Array,
      default: () => [],
    },
    openingNonStop: {
      type: [Number, String, Boolean],
      default: false,
    },
    temporarilyClosed: {
      type: [Number, String, Boolean],
      default: false,
    },
  },
}
</script>
<style lang="scss" scoped>
.opening {
  background: #fff;

  &__title {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__open-row {
    display: flex;
    margin: 30px 0;
  }

  &__non-stop {
    margin-right: 6px;
  }
}

.opening-week-table {
  font-family: Inter, sans-serif;
  font-style: normal;
  font-weight: normal;
  font-size: 16px;
  line-height: 100%;
  color: #000638;

  &__row {
    display: flex;
    align-items: center;

    &:not(:last-child) {
      margin-bottom: 10px;
    }
  }

  &__row-item:not(:last-child) {
    margin-right: 6px;
  }

  &__day {
    min-width: 121px;
    padding: 11px 16px;
  }

  &__time {
    display: flex;
    align-items: center;
    justify-content: space-between;
    min-height: 38px;
    padding: 0 12px 0 15px;
    background: #fff;
    border: 1px solid #d7e1ea;
    border-radius: 8px;

    .opening-week-table__time-label {
      max-width: 142px;

      ::v-deep {
        .input {
          font-family: Inter, sans-serif;
          font-style: normal;
          font-weight: normal;
          font-size: 16px;
          line-height: 100%;
          color: #000638;
          border: 0;
          padding: 0;

          &::placeholder {
            font-family: Inter, sans-serif;
            font-style: normal;
            font-weight: normal;
            font-size: 16px;
            line-height: 100%;
            opacity: 0.5;
            color: #000638;
          }

          &:focus {
            box-shadow: unset;
          }
        }
      }
    }

    &--disabled {
      .opening-week-table__time-label {
        color: #778699;
      }

      .opening-week-table__time-icon {
        fill: #778699;
      }
    }
  }
}
</style>
