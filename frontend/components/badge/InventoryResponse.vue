<template>
  <div class="inventory-warning-wrapper">
    <div class="inventory-warning">
      <div class="inventory-warning__icon">
        <svg
          width="16"
          height="16"
          viewBox="0 0 16 16"
          fill="none"
          xmlns="http://www.w3.org/2000/svg"
        >
          <path
            d="M14.0002 6.74667H9.48017L11.3068 4.86667C9.48683 3.06667 6.54017 3 4.72017 4.8C2.90017 6.60667 2.90017 9.52 4.72017 11.3333C6.54017 13.1333 9.48683 13.1333 11.3068 11.3333C12.2135 10.4333 12.6668 9.38667 12.6668 8.06667H14.0002C14.0002 9.38667 13.4135 11.1 12.2402 12.26C9.90017 14.58 6.10017 14.58 3.76017 12.26C1.42683 9.94667 1.40683 6.18667 3.74683 3.87333C6.08683 1.56 9.84017 1.56 12.1802 3.87333L14.0002 2V6.74667ZM8.3335 5.33333V8.16667L10.6668 9.55333L10.1868 10.36L7.3335 8.66667V5.33333H8.3335Z"
            fill="white"
          />
        </svg>
      </div>
      <div class="inventory-warning__text">
        Last response: <b>2 minutes ago</b>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
.inventory-warning {
  display: flex;
  align-items: center;
  background: rgba(0, 6, 56, 0.1);
  flex-direction: row;
  width: 228px;
  height: 40px;
  border-radius: 8px;

  &__icon {
    background: #000638;
    display: flex;
    border-radius: 8px;
    justify-content: center;
    align-items: center;
    width: 40px;
    height: 40px;
  }
  &__text {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 100%;
    color: #000638;
    margin-left: 10px;
  }
}
</style>
