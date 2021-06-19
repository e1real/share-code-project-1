<template>
  <div class="playing-now-wrapper">
    <div class="playing-now">
      <h5 class="playing-now__text">Playing Now</h5>
      <div class="playing-now__card"></div>
      <div class="playing-now__cam">
        <h6 class="cam__small">Compaing Name</h6>
        <h6 class="cam__bold">Lorem ipsum dolor</h6>
      </div>
      <div class="playing-now__cam">
        <h6 class="cam__small">Company</h6>
        <h6 class="cam__bold">Lorem ipsum dolor</h6>
      </div>
      <div class="playing-now__cam">
        <h6 class="cam__small">Impression</h6>
        <h6 class="cam__bold">12 946</h6>
      </div>
      <div class="playing-mac">
        <div class="playing-mac__var1">
          <h6 class="cam__small">Start date</h6>
          <h6 class="cam__bold">10.02.2021</h6>
        </div>
        <div class="playing-mac__var2">
          <h6 class="cam__small">Start date</h6>
          <h6 class="cam__bold">10.02.2021</h6>
        </div>
      </div>
      <div class="playing-now__progress-wrapper">
        <div
          class="playing-now__progress"
          :style="{ width: `${progress}%` }"
        ></div>
        <h4 class="playing-now__progress-days">26 days remaining to ending</h4>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      progress: 42,
    }
  },
}
</script>

<style lang="scss" scoped>
.playing-now {
  width: 255px;
  height: 565px;
  background: #fff;
  border: 1px solid #fff;
  box-shadow: 0 3px 5px rgba(0, 0, 0, 0.05);
  border-radius: 8px;
  font-family: Inter, sans-serif;

  &__text {
    font-size: 24px;
    color: #000638;
    margin-left: 15px;
    margin-top: 15px;
    font-weight: bold;
  }
  &__card {
    background-color: #000638;
    width: 255px;
    height: 255px;
    margin-top: 15px;
  }
  &__cam {
    margin-top: 15px;
    margin-left: 15px;
  }

  &__progress-wrapper {
    position: relative;
    width: 225px;
    height: 6px;
    margin-left: 15px;
    margin-top: 16px;
  }

  &__progress {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background: #000638;
    border-radius: 8px;
  }

  &__progress-days {
    font-size: 11px;
    color: #000638;
    font-style: normal;
    font-weight: normal;
    padding: 8px 0 4px;
  }
}

.cam__small {
  color: #778699;
  font-size: 12px;
}

.cam__bold {
  font-size: 12px;
  color: #000638;
}

.playing-mac {
  display: flex;
  margin-left: 15px;
  &__var2 {
    margin-left: 38px;
  }
}
</style>
