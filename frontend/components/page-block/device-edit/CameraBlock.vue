<template>
  <div class="camera">
    <h5 class="camera__title">Camera</h5>
    <p class="camera__description">Does the device include a camera?</p>
    <div class="camera__radio">
      <RadioButtonsVar2
        v-model="cameraValue"
        class="frame__frame-radio"
        :options="cameraOptions"
      />
    </div>
    <hr class="camera__line" />
    <div class="camera__setting">
      <h5 class="camera__title">Setting</h5>
      <p class="camera__description">Settings for camera streaming.</p>
      <div class="camera__right-switch">
        <span class="camera__right-switch-text">Camera stream</span>
        <b-switch
          type="is-success"
          :left-label="false"
          passive-type="is-danger"
          class="camera__right-switch-check"
        />
      </div>
      <VSelectMultiple label="Rotation" class="camera__select" />
      <VSelectMultiple label="Resolution" class="camera__select-1" />
      <VSelectMultiple label="Frame rate" class="camera__select-1" />
    </div>
  </div>
</template>

<script>
import RadioButtonsVar2 from '@/components/form/RadioButtonsVar2'
import VSelectMultiple from '@/components/form/VSelectMultiple'

export default {
  components: {
    VSelectMultiple,
    RadioButtonsVar2,
  },
  data() {
    return {
      cameraValue: 'Yes',
      cameraOptions: ['No', 'Yes'],
    }
  },
}
</script>

<style lang="scss" scoped>
.camera {
  background: #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  padding: 30px;

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
    margin-bottom: 15px;
  }

  &__line {
    margin: 29px -30px 26px -30px;
    background: #d7e1ea;
    height: 1px;
  }

  &__right-switch {
    display: flex;
    align-items: center;
    padding: 6px 6px 6px 16px;
    width: 240px;
    height: 48px;
    background: #fff;
    border-radius: 8px;
    border: 1px solid #d7e1ea;
    box-sizing: border-box;
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 100%;
    color: #000638;
    margin-top: 15px;
  }

  &__right-switch-check {
    margin-left: auto;
    margin-right: 0;

    ::v-deep > .control-label {
      padding-left: 0;
    }
  }
  &__select {
    width: 240px;
    height: 38px;
    margin-top: 15px;
  }
}
.camera__select-1 {
  margin-top: 30px;
  width: 240px;
  height: 38px;
}
</style>
