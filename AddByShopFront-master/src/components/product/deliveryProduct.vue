<template>
  <div class="delivery">
          <span class="d-flex align-items-center">
            {{ $t("Доставка в") }} <button class="btn btn-link p-0 mx-1">{{ $t("Ташкент") }}</button>
          </span>
    <p class="d-flex align-items-center mt-2 mb-2">
      <img src="@/assets/icons/delivery-icon.png" alt="delivery icon"/>
      <span class="mx-3">Доставка от <b>15 000 сум</b></span>
    </p>
    <p class="d-flex align-items-center mb-2">
      <img src="@/assets/icons/time.png" alt="time icon"/>
      <span class="mx-3">Доставка ожидается 07.11 - 08.11</span>
    </p>
    <p class="d-flex align-items-center mb-2">
      <img src="@/assets/icons/box.png" alt="box icon"/>
      <span class="mx-3">До двери через <b>Fargo</b></span>
    </p>
    <p class="d-flex align-items-center mt-3 delivery-calculation">
      <img src="@/assets/icons/box-clock.png" alt="delivery icon"/>
      <span class="mx-2"
      >Стоимость и предполагаемая дата доставки рассчитывается на основе
              вашего адреса по умолчанию</span
      >
    </p>
  </div>
</template>
<style lang="scss">
.delivery {
  background-color: white;
  border-radius: 12px;
  margin-top: 20px;
  padding: 20px 0 20px 20px;

  p {
    font-size: 12px;
  }

  .delivery-calculation {
    font-size: 10px;
  }

}
</style>