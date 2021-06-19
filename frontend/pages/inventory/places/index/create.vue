<template>
  <b-modal
    :active="true"
    :width="603"
    class="place-modal"
    @close="$router.push('/inventory/places')"
  >
    <div class="place-modal-content">
      <h5 class="place-modal-content__title">New place</h5>
      <div class="place-modal-content__form place-form">
        <div class="place-form__name">
          <VInput
            v-model="placeItem.name"
            label="Place name"
            :errors="formErrors.name"
            @keydown="formErrors.name = ''"
          />
        </div>
        <h4 class="gmap-top-label">Place address</h4>
        <div class="gmap">
          <GmapAutocomplete
            :value="placeItem.address"
            :errors="formErrors.address"
            class="gmap__autocomplete"
            @keydown="formErrors.address = ''"
            @place_changed="handleChangeAutoComplete"
          />
          <GmapMap
            :center="gMapCenter"
            :zoom="14"
            style="width: 100%; height: 300px"
          >
            <GmapMarker
              :position="gMapCenter"
              :draggable="true"
              @dragend="handleMarkerDragEnd"
            />
          </GmapMap>
        </div>
        <BaseButton
          label="Create"
          class="place-form__btn"
          @click="handleClickCreate"
        />
      </div>
    </div>
  </b-modal>
</template>

<script>
import { mapActions } from 'vuex'
import VInput from '@/components/form/VInput'
import BaseButton from '@/components/button/BaseButton'

export default {
  components: {
    VInput,
    BaseButton,
  },
  data() {
    return {
      newPlaceItem: {
        name: '',
        long: null,
        lat: null,
        address: '',
      },
      placeItem: {
        name: '',
        long: null,
        lat: null,
        address: '',
      },
      formErrors: {
        name: '',
        address: '',
      },
      placeData: null,
    }
  },
  computed: {
    gMapCenter() {
      if (this.placeItem.lat && this.placeItem.long) {
        return { lat: this.placeItem.lat, lng: this.placeItem.long }
      }
      return { lat: 48.1495846, lng: 17.1044127 }
    },
  },
  methods: {
    ...mapActions({
      createPlace: 'places/createPlace',
    }),
    /**
     * Place form click handler
     */
    async handleClickCreate() {
      try {
        const payload = {
          name: this.placeItem.name,
          address: this.placeItem.address ? this.placeItem.address : null,
          lat: this.placeItem.lat,
          lon: this.placeItem.long,
        }

        try {
          await this.$api.post('places/', {
            ...payload,
          })
          this.$emit('create-place')
          await this.$router.push('/inventory/places')
        } catch (err) {
          if (err.response.status === 422) {
            for (const field in err.response.data.errors) {
              if (typeof this.formErrors[field] !== 'undefined') {
                this.formErrors[field] = err.response.data.errors[field][0]
              }
            }
          }
        }
      } catch (e) {
        window.console.log(e)
      }
    },
    handleMarkerDragEnd(e) {
      this.placeItem.lat = e.latLng.lat()
      this.placeItem.long = e.latLng.lng()
      const geocoder = new window.google.maps.Geocoder()
      geocoder.geocode(
        {
          latLng: e.latLng,
        },
        (responses) => {
          this.placeItem.address = responses[0].formatted_address
        }
      )
    },
    handleChangeAutoComplete(place) {
      if (!place.geometry || !place.geometry.location) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'")
        return
      }
      this.placeItem.address = place.formatted_address
      this.placeItem.lat = place.geometry.location.lat()
      this.placeItem.long = place.geometry.location.lng()
    },
  },
}
</script>

<style lang="scss" scoped>
.place-modal-content {
  width: 603px;
  background-color: white;
  border-radius: 8px;
  padding: 30px;

  &__title {
    font-family: 'Inter', sans-serif;
    font-weight: bold;
    font-size: 20px;
    line-height: 100%;
    color: #000638;
  }

  &__form {
    margin-top: 30px;
  }
}
.place-form {
  &__btn {
    margin-left: auto;
    margin-top: 30px;
  }
}

.gmap-autocomplete-box {
  &__input {
    width: 100%;
    height: 38px;
    border: 0;
    padding: 0;
    font-family: 'Inter', sans-serif;
    font-size: 16px;
    line-height: 100%;

    &::placeholder {
      color: #778699;
    }

    &:focus {
      outline: none;
    }

    ::v-deep .v-input__input-wrapper {
      border-radius: 0;
      padding-right: 0;
    }
  }
}

.gmap {
  border: 1px solid #d7e1ea;

  &__autocomplete {
    width: 100%;
    outline: none;
    border: 0;
    padding: 4px 6px;
    height: 40px;
  }
}
</style>
