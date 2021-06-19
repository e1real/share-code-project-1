<template>
  <div class="charts">
    <div class="charts__device-grpaph"></div>
    <div class="charts__temp temp">
      <h5 class="temp__title">CPU Temperature</h5>
      <span class="temp__value">67.2 °C</span>
      <div class="temp__minmax">
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">min</span>
          <span class="temp__minmax-txt">56.2</span>
        </div>
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">max</span>
          <span class="temp__minmax-txt">14</span>
        </div>
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">avg</span>
          <span class="temp__minmax-txt">22</span>
        </div>
      </div>
    </div>
    <div class="charts__temp temp">
      <h5 class="temp__title">GPU Temperature</h5>
      <span class="temp__value">67.2 °C</span>
      <div class="temp__minmax">
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">min</span>
          <span class="temp__minmax-txt">56.2</span>
        </div>
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">max</span>
          <span class="temp__minmax-txt">14</span>
        </div>
        <div class="temp__minmax-col">
          <span class="temp__minmax-txt">avg</span>
          <span class="temp__minmax-txt">22</span>
        </div>
      </div>
    </div>
    <div class="charts__ram-use">
      <h5 class="temp__title">CPU Usage</h5>
    </div>
    <div class="charts__ram-use">
      <h5 class="temp__title">CPU Usage</h5>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      chartdata: {
        datasets: [
          {
            label: 'A',
            data: [
              { x: '2020-06-07 08:51:22', y: -0.1 },
              { x: '2020-06-07 09:22:01', y: 0.9 },
              { x: '2020-06-07 09:37:28', y: -0.1 },
              { x: '2020-06-07 10:10:51', y: 0.9 },
              { x: '2020-06-07 11:42:54', y: 0.9 },
            ],
            borderColor: 'green',
            fill: false,
            steppedLine: 'before',
          },
          {
            label: 'B',
            data: [
              { x: '2020-06-07 08:45:17', y: 0 },
              { x: '2020-06-07 09:30:17', y: 1 },
              { x: '2020-06-07 10:15:16', y: 0 },
              { x: '2020-06-07 11:00:17', y: 1 },
              { x: '2020-06-07 12:15:16', y: 0 },
            ],
            borderColor: 'red',
            fill: false,
            steppedLine: 'before',
          },
          {
            label: 'C',
            data: [
              { x: '2020-06-07 09:00:28', y: 1.1 },
              { x: '2020-06-07 09:15:44', y: 0.1 },
              { x: '2020-06-07 10:41:05', y: 1.1 },
              { x: '2020-06-07 11:22:18', y: 0.1 },
              { x: '2020-06-07 12:33:54', y: 1.1 },
            ],
            borderColor: 'blue',
            fill: false,
            steppedLine: 'before',
          },
        ],
      },
      options: {
        tooltips: {
          callbacks: {
            label: (tooltipItem) =>
              tooltipItem.value < 0.5 ? 'false' : 'true',
          },
        },
        scales: {
          xAxes: [
            {
              type: 'time',
              time: {
                unit: 'minute',
                displayFormats: {
                  minute: 'HH:mm',
                },
                tooltipFormat: 'HH:mm',
              },
              ticks: {
                source: 'data',
                minRotation: 45,
              },
              gridLines: {
                drawOnChartArea: false,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                min: -0.3,
                max: 1.3,
                fontSize: 16,
                fontStyle: 'bold',
                callback: (value) => {
                  if (value === 0) {
                    return 'off'
                  } else {
                    return value === 1 ? 'on' : ''
                  }
                },
              },
              gridLines: {
                display: false,
              },
            },
          ],
        },
      },
    }
  },
}
</script>
<style lang="scss" scoped>
.charts {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  grid-template-rows: repeat(2, 147px);
  gap: 30px;

  &__device-grpaph {
    width: 730px;
    height: 324px;
    background: #000638;
    border-radius: 8px;
    grid-row: 1/3;
  }

  &__temp,
  &__gpu,
  &__cpu-use,
  &__ram-use {
    display: flex;
    width: 160px;
    height: 147px;
    background: #000638;
    border-radius: 8px;
    align-items: center;
    justify-content: center;
  }
}

.temp {
  display: flex;
  flex-direction: column;
  justify-content: center;

  &__title {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 12px;
    line-height: 100%;
    text-align: center;
    color: #f4f7fc;
  }
  &__value {
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
    font-size: 24px;
    line-height: 100%;
    text-align: center;
    color: #00bc8a;
    margin-top: 10px;
  }

  &__minmax {
    display: flex;
    min-width: 96px;
    justify-content: space-between;
    margin-top: 14px;
  }

  &__minmax-col {
    display: flex;
    flex-direction: column;
    font-size: 11px;
    color: #f4f7fc;
    font-family: Inter, sans-serif;
    font-style: normal;
    font-weight: bold;
  }
}
</style>
