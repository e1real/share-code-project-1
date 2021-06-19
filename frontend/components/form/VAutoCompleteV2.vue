<template>
  <div class="base-autocomplete">
    <p class="base-autocomplete__top-label">{{ topLabel }}</p>
    <b-autocomplete
      class="base-autocomplete__input"
      :data="responseData"
      placeholder="Search"
      icon="magnify"
      clearable
      :value="value"
      :loading="isLoading"
      open-on-focus
      @select="(option) => (selected = option)"
      @input="$emit('input', $event)"
    >
      <template #default="props">
        <div
          :class="[
            'base-autocomplete-item',
            { 'base-autocomplete-item--exist': props.option.exist },
          ]"
          @click="$emit('click-item', props.option)"
        >
          <span class="base-autocomplete-item__label">
            {{ props.option.name }}
          </span>
        </div>
      </template>

      <template #empty>No results found</template>
    </b-autocomplete>
  </div>
</template>

<script>
export default {
  model: {
    event: 'input',
    prop: 'value',
  },
  props: {
    value: {
      type: [Number, String, Array],
      default: '',
    },
    isLoading: {
      type: Boolean,
      default: false,
    },
    responseData: {
      type: Array,
      default: () => [],
    },
    topLabel: {
      type: String,
      default: 'label',
    },
  },
  emits: ['input', 'click-item', 'focus'],
}
</script>
<style lang="scss" scoped>
.base-autocomplete {
  &__top-label {
    font-family: 'Inter', sans-serif;
    font-size: 14px;
    line-height: 100%;
    color: #000638;
    margin-bottom: 10px;
  }

  &__input {
    ::v-deep .icon.is-left {
      background-color: #000638;
      border-top-left-radius: 8px;
      border-bottom-left-radius: 8px;

      i {
        color: #fff;
      }
    }

    ::v-deep .input {
      padding-left: calc(2.5em + 12px);

      &:focus,
      &:hover {
        border: 1px solid rgb(210, 220, 229);
      }
    }

    ::v-deep .dropdown-item {
      padding: 0;
    }
  }
}

.base-autocomplete-item {
  display: flex;
  align-items: center;
  width: 100%;
  padding: 6px 8px;

  &__icon {
    width: 40px;
    height: 40px;
    margin-right: 12px;
  }
  &__label {
    flex-grow: 1;
  }
  &--exist {
    background-color: #00c2ff33;
  }
}
</style>
