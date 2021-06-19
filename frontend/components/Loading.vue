<template>
  <div class="loading-wrapper">
    <svg
      xmlns="http://www.w3.org/2000/svg"
      class="loading-animated"
      width="200px"
      height="200px"
      viewBox="0 0 100 100"
      preserveAspectRatio="xMidYMid"
    >
      <path
        d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50"
        fill="#F26339"
        stroke="none"
      >
        <animateTransform
          attributeName="transform"
          type="rotate"
          dur="0.6896551724137931s"
          repeatCount="indefinite"
          keyTimes="0;1"
          values="0 50 51;360 50 51"
        ></animateTransform>
      </path>
    </svg>
  </div>
</template>
<style lang="scss" scoped>
.loading-wrapper {
  position: absolute;
  top: 0;
  left: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 100%;
  height: 100%;
  z-index: 20;
}

.loading-animated {
  background: transparent;
  display: block;
  shape-rendering: auto;
}
</style>
