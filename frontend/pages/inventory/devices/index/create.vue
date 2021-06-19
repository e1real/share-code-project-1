<template>
  <b-modal
    :active="true"
    :width="584"
    class="device-modal"
    @close="$router.back()"
  >
    <div class="device-modal-content">
      <h5 class="device-modal-content__title">New inventory</h5>
      <div class="device-modal-content__form device-form">
        <VInput
          v-model="form.name"
          class="device-form__item"
          label="Inventory Name"
          :errors="formErrors.name"
          @input="formErrors.name = ''"
        />
        <VSelectVar2
          v-model="form.place"
          class="device-form__item device-form__item-place"
          label="Inventory Place"
          placeholder="Select..."
          title-key="name"
          list-position="top"
          :options="formSelectOptions.placeList"
          :errors="formErrors.place_id"
          searchable
          @change="formErrors.place_id = ''"
        />
        <VSelectVar2
          v-model="form.group"
          class="device-form__item device-form__item-group"
          label="Inventory Group"
          placeholder="Select..."
          title-key="name"
          list-position="top"
          :options="formSelectOptions.screenGroupList"
          :errors="formErrors.screen_group_id"
          searchable
          @change="formErrors.screen_group_id = ''"
        />
        <BaseButton
          label="Create"
          class="device-form__button"
          @click="submit"
        />
      </div>
    </div>
  </b-modal>
</template>

<script>
import { mapActions } from 'vuex'
import VInput from '@/components/form/VInput'
import VSelectVar2 from '@/components/form/VSelectVar2'
import BaseButton from '@/components/button/BaseButton'

export default {
  components: {
    VInput,
    VSelectVar2,
    BaseButton,
  },
  data() {
    return {
      form: {
        name: '',
        place: null,
        group: null,
      },
      formErrors: {
        name: '',
        place_id: '',
        screen_group_id: '',
      },
      formSelectOptions: {
        screenGroupList: [],
        placeList: [],
      },
    }
  },
  computed: {},
  async mounted() {
    try {
      const placesRes = await this.$api('places/?per_page=-1')
      const screenGroupsRes = await this.$api('screen-groups/?per_page=-1')

      this.formSelectOptions.placeList = placesRes.data
      this.formSelectOptions.screenGroupList = screenGroupsRes.data
    } catch (e) {
      window.console.log(e)
    }
  },
  methods: {
    ...mapActions({
      fetchScreens: 'screens/fetchScreens',
    }),
    /**
     * Submit form
     */
    async submit() {
      const formatedData = this.prepareFormData()
      try {
        await this.$api.post('screens/', formatedData)
        await this.fetchScreens()

        await this.$router.push('/inventory/devices')
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
        screen_group_id: this.form.group ? this.form.group.screen_group_id : '',
        place_id: this.form.place ? this.form.place.place_id : '',
      }
    },
  },
}
</script>

<style lang="scss" scoped>
.device-modal-content {
  width: 584px;
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

.device-form {
  &__item {
    &:not(:last-child) {
      margin-bottom: 20px;
    }
  }

  &__item-place,
  &__item-group {
    max-width: 316px;
  }

  &__button {
    margin-top: 30px;
    margin-left: auto;
  }
}
</style>
