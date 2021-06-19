<template>
  <div class="place-wrapper">
    <div class="place">
      <PageBreadcrumbs class="place__breadcrumbs" :items="breadcrumbs" />
      <div class="place__place-head place-head">
        <BackButton
          class="place-head__back-button"
          @click.native="$router.push('/inventory/places/')"
        />
        <h1 class="place-head__title">{{ form.place.name }}</h1>
      </div>
      <div class="place-head__upload-wrapper">
        <Upload
          :photos="form.photos"
          :place-id="$route.params.id"
          class="place-head__upload"
          @upload-complete="(file) => handleUploadComplete(file)"
          @delete="handleDeletePhoto"
        />
        <div class="basic-info">
          <div class="basic-info__row">
            <h4 class="basic-info__title">Basic Information</h4>
            <RadioButtonsVar3
              v-model="selectedNameValue"
              class="basic-info__radio-btn"
              :options="langOptions"
              @click="handleClickLang"
            />
          </div>
          <VInputVar3
            v-show="selectedNameValue === 'EN'"
            v-model="form.place.name"
            :inline-label="selectedNameValue"
            class="basic-info__place-name"
            label="Place name"
          />
          <VInputVar3
            v-show="selectedNameValue === 'DE'"
            v-model="form.place.name_de"
            :inline-label="selectedNameValue"
            class="basic-info__place-name"
            label="Place name"
          />
          <VInputVar3
            v-show="selectedNameValue === 'SK'"
            v-model="form.place.name_sk"
            :inline-label="selectedNameValue"
            class="basic-info__place-name"
            label="Place name"
          />
          <VTextArea
            v-show="selectedNameValue === 'EN'"
            v-model="form.place.description"
            class="basic-info__description"
            label="Description"
            :inline-label="selectedLangName"
          />
          <VTextArea
            v-show="selectedNameValue === 'DE'"
            v-model="form.place.description_de"
            class="basic-info__description"
            label="Description"
            :inline-label="selectedLangName"
          />
          <VTextArea
            v-show="selectedNameValue === 'SK'"
            v-model="form.place.description_sk"
            class="basic-info__description"
            label="Description"
            :inline-label="selectedLangName"
          />
        </div>
      </div>
      <Opening
        :place-opening-time.sync="form.place_opening_time"
        :opening-non-stop.sync="form.opening_non_stop"
        :temporarily-closed.sync="form.temporarily_closed"
        class="place-head__opening"
      />
      <div class="place-head__location">
        <div class="location">
          <h1 class="location__title">Location</h1>
          <div class="location__map-wrapper">
            <GmapAutocomplete
              :value="form.map_data.address"
              class="location__autocomplete"
              @place_changed="handleChangeAutoComplete"
            />
            <GmapMap
              :center="gMapCenter"
              :zoom="17"
              style="width: 100%; height: 300px"
            >
              <GmapMarker
                :position="gMapCenter"
                :draggable="true"
                @dragend="handleMarkerDragEnd"
              />
            </GmapMap>
          </div>
        </div>
      </div>
      <div class="place__button-row">
        <BaseButton class="place__button-save" label="Save" @click="submit" />
      </div>
    </div>
  </div>
</template>

<script>
import PageBreadcrumbs from '@/components/breadcrumb/PageBreadcrumbs'
import BackButton from '@/components/button/BackButton'
import BaseButton from '@/components/button/BaseButton'
import Upload from '@/components/page-block/Upload'
import Opening from '@/components/page-block/Opening'
import RadioButtonsVar3 from '@/components/form/RadioButtonsVar3'
import VInputVar3 from '@/components/form/VInputVar3'
import VTextArea from '@/components/form/VTextArea'

export default {
  components: {
    PageBreadcrumbs,
    BackButton,
    BaseButton,
    Upload,
    Opening,
    RadioButtonsVar3,
    VInputVar3,
    VTextArea,
  },
  data() {
    return {
      isNewRecord: true,
      breadcrumbs: [
        {
          title: 'Inventory',
          to: '/',
        },
        {
          title: 'Places',
          to: '/',
        },
      ],
      selectedNameValue: 'EN',
      langOptions: ['EN', 'DE', 'SK'],
      langOptionsName: ['English', 'German', 'Slovak'],
      selectedLangName: 'English',
      form: {
        place: {
          name: '',
          name_de: '',
          name_sk: '',
          description: '',
          description_de: '',
          description_sk: '',
          place_url: '',
          opening_non_stop: false,
          temporarily_closed: false,
        },
        photos: [],
        place_opening_time: [
          {
            name: 'Monday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Tuesday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Wednesday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Thursday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Friday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Saturday',
            open: null,
            close: null,
            is_closed: false,
          },
          {
            name: 'Sunday',
            open: null,
            close: null,
            is_closed: false,
          },
        ],
        map_data: {
          address: '',
          lat: 0,
          lon: 0,
        },
      },
    }
  },
  computed: {
    gMapCenter() {
      if (this.form.map_data) {
        return { lat: this.form.map_data.lat, lng: this.form.map_data.lon }
      }
      return { lat: 10, lng: 10 }
    },
  },
  async mounted() {
    if (typeof this.$route.params.id !== 'undefined') {
      try {
        const { data } = await this.$api.get('/places/' + this.$route.params.id)
        this.form.place = data.place

        if (data.place_opening_time) {
          this.form.place_opening_time = data.place_opening_time.map((el) => {
            return {
              ...el,
              close: el.close ? new Date(el.close) : null,
              open: el.open ? new Date(el.open) : null,
            }
          })
        }
        this.form.map_data = data.map_data
        this.form.photos = data.photos.map((el) => {
          return {
            ...el,
            completed: true,
          }
        })
        this.isNewRecord = false
      } catch (e) {
        window.console.log(e)
      }
    }
    // await this.fetchPlaceById(this.route.params.id)
  },
  methods: {
    /**
     * Click language handler
     *
     * @param {number} index - index of selected
     */
    handleClickLang(index) {
      this.selectedLangName = this.langOptionsName[index]
      this.selectedNameValue = this.langOptions[index]
    },
    submit() {
      try {
        const placeOpeningTime = this.form.place_opening_time.map((el) => {
          return {
            ...el,
            open: el.open ? el.open.toLocaleString() : null,
            close: el.close ? el.close.toLocaleString() : null,
          }
        })

        const form = { ...this.form, place_opening_time: placeOpeningTime }

        const { data } = this.$api.patch(
          '/places/' + this.$route.params.id,
          form
        )
        window.console.log(data)
      } catch (e) {
        window.console.log(e)
      }
    },
    handleMarkerDragEnd(e) {
      this.form.map_data.lat = e.latLng.lat()
      this.form.map_data.lon = e.latLng.lng()
      const geocoder = new window.google.maps.Geocoder()
      geocoder.geocode(
        {
          latLng: e.latLng,
        },
        (responses) => {
          this.form.map_data.address = responses[0].formatted_address
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
      this.form.map_data.address = place.formatted_address
      this.form.map_data.lat = place.geometry.location.lat()
      this.form.map_data.lon = place.geometry.location.lng()
    },
    /**
     *
     * @param {Object} file
     */
    handleUploadComplete(file) {
      this.form.photos.push({
        ...file,
      })
    },
    async handleDeletePhoto(photoIndex) {
      try {
        const photoId = this.form.photos[photoIndex].place_photo_id
        await this.$api.delete(`/place-photos/${photoId}`)
        this.form.photos.splice(photoIndex, 1)
      } catch (e) {
        window.console.log(e)
      }
    },
  },
}
</script>
<style lang="scss" scoped>
.place-wrapper {
  padding: 0 20px;
}
.place__breadcrumbs {
  margin-top: 10px;
}
.place-head {
  padding: 10px 0;
  display: flex;
  font-family: 'Inter', sans-serif;
  margin-top: 33px;
  align-items: center;

  &__back-button {
    margin-right: 16px;
  }

  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__upload-wrapper {
    background-color: #fff;
    font-family: Inter, sans-serif;
    line-height: 100%;
    color: #000638;
    border: 1px solid #fff;
    height: 100%;
    box-sizing: border-box;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    padding: 30px 30px 24px;
  }

  &__opening {
    background: #fff;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    padding: 30px;
    margin-top: 39px;
  }

  &__location {
    background: #fff;
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
    border-radius: 8px;
    padding: 30px;
    margin-top: 39px;
  }
}

.basic-info {
  &__title {
    font-family: 'Inter', sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    color: #000638;
  }

  &__place-name {
    margin-top: 30px;
  }

  &__description {
    margin-top: 15px;
  }

  &__place-url {
    margin-top: 15px;
    max-width: 543px;
  }
}

.place {
  &__button-row {
    margin: 30px 0;
  }
  &__button-save {
    min-width: 178px;
    margin-left: auto;
  }
}

.location {
  &__autocomplete {
    width: 100%;
    outline: none;
    border: 0;
    padding: 4px 6px;
    height: 40px;
  }

  &__map-wrapper {
    border: 1px solid #d7e1ea;
  }
}
</style>
