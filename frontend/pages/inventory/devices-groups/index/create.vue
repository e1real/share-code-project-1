<template>
  <b-modal
    :active="true"
    :width="768"
    class="screen-groups-modal"
    @close="$router.back()"
  >
    <div class="screen-groups-modal-content">
      <h5 class="screen-groups-modal-content__title">Create new group</h5>
      <div class="screen-groups-modal-content__form screen-groups-form">
        <div class="screen-groups-form__row">
          <VInput
            v-model="form.name"
            class="screen-groups-form__item screen-groups-form__item-name"
            label="Group name"
            :errors="formErrors.name"
            @input="formErrors.name = ''"
          />
          <VInput
            v-model="form.default_price"
            placeholder="€"
            class="screen-groups-form__item screen-groups-form__item-price"
            label="Default price"
            :errors="formErrors.default_price"
            @input="formErrors.default_price = ''"
          />
        </div>
        <VTextAreaVar2
          v-model="form.description"
          placeholder="€"
          class="screen-groups-form__item screen-groups-form__item-description"
          top-label="Default price"
          :errors="formErrors.description"
          @input="formErrors.description = ''"
        />
        <BaseButton
          label="Create"
          class="screen-groups-form__button"
          @click="submit"
        />
      </div>
    </div>
  </b-modal>
</template>

<script>
import { mapActions } from 'vuex'
import VInput from '@/components/form/VInput'
import VTextAreaVar2 from '@/components/form/VTextAreaVar2'
import BaseButton from '@/components/button/BaseButton'

export default {
  components: {
    VInput,
    VTextAreaVar2,
    BaseButton,
  },
  data() {
    return {
      form: {
        name: '',
        default_price: null,
        description: null,
      },
      formErrors: {
        name: '',
        default_price: '',
        description: '',
      },
    }
  },
  methods: {
    ...mapActions({
      fetchScreenGroups: 'screen_groups/fetchScreenGroups',
    }),
    /**
     * Submit form
     */
    async submit() {
      const formatedData = this.prepareFormData()
      try {
        await this.$api.post('screen-groups/', formatedData)

        await this.fetchScreenGroups()
        await this.$router.push('/inventory/devices-groups')
      } catch (e) {
        if (e.response.status === 422) {
          for (const field in e.response.data.errors) {
            if (typeof this.formErrors[field] !== 'undefined') {
              this.formErrors[field] = e.response.data.errors[field][0]
            }
          }
        }
      }
    },
    /**
     * Normarlize data for backend payload
     * @returns {Object} prepared data
     */
    prepareFormData() {
      return {
        name: this.form.name,
        default_price: this.form.default_price ? this.form.default_price : '',
        description: this.form.description ? this.form.description : '',
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.screen-groups-modal-content {
  background-color: white;
  border-radius: 8px;
  padding: 30px;

  &__title {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 20px;
    line-height: 100%;
    color: #000638;
  }

  &__form {
    margin-top: 26px;
  }
}

.screen-groups-form {
  &__row {
    display: flex;
  }
  &__item {
    width: 100%;

    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }

  &__item-name {
    width: 514px;
    margin-right: 30px;
  }

  &__item-price {
    max-width: 155px;
  }

  &__button {
    margin-top: 30px;
    margin-left: auto;
  }
}
</style>
