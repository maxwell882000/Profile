<template>
  <div class="rounded-st border-input  w-100 main-block" ref="container">
    <div ref="back" :style="back"
         class="back-move"></div>
    <div style="position: relative" class="d-flex  justify-content-between m-0 align-items-center">
      <div>
        <button :class="!isRight ? 'enable' : 'disable'" ref="left" @click="onLeft" class="button-blue">
          {{ $t("Самовывоз") }}
        </button>
      </div>
      <div>
        <button :class="isRight ? 'enable' : 'disable'" ref="right" @click="onRight" class="button-blue">
          {{ $t("Доставка курьером") }}
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SwitchButton",
  data() {
    return {
      back: {},
      isRight: true
    }
  },
  methods: {
    onStart() {
      let right = this.$refs.right;
      let offset = this.getOffset(this.$refs.container.parentNode);
      this.back.left = right.getBoundingClientRect().left + offset.left + 'px';
      if (this.isRight)
        this.onRight();
      else {
        this.onLeft();
      }
    },
    onRight() {
      let right = this.$refs.right;
      this.back.width = right.clientWidth + 'px';
      this.isRight = true;
      this.back.transform = `translateX(0px)`;
      this.calculateHeight()
    },
    getOffset(el) {
      var _x = 0;
      var _y = 0;
      while (el && !isNaN(el.offsetLeft) && !isNaN(el.offsetTop)) {
        let padding = getComputedStyle(el)
        _x -= parseFloat(padding.paddingLeft) + parseFloat(padding.marginLeft);
        _y -= parseFloat(padding.paddingTop) + parseFloat(padding.marginTop);
        el = el.parentNode;
      }
      return {top: _y, left: _x};
    },
    getDifference() {
      return this.$refs.left.getBoundingClientRect().left - this.$refs.right.getBoundingClientRect().left;
    },
    onLeft() {
      let left = this.$refs.left;
      this.back.width = left.clientWidth + 'px';
      let difference = this.getDifference();
      this.back.transform = `translateX(${difference}px)`;
      this.isRight = false;
      this.calculateHeight();
    },
    calculateHeight() {
      let container = this.$refs.container;
      let computedStyle = getComputedStyle(container);
      let padding = parseFloat(computedStyle.paddingTop);
      this.back.top = padding / 2 + 'px';
      this.back.height = container.clientHeight - padding + 'px';
      this.$emit("changed", this.isRight);
    }
  },
  created() {
    window.addEventListener("resize", this.onStart);
  },
  unmounted() {
    window.removeEventListener("resize", this.onStart);
  },
  mounted() {
    setTimeout(this.onStart, 100);
  }
}
</script>
<style scoped>
.back-move {
  background-color: var(--blue);
  border-radius: var(--borderRadius);
  position: absolute;
  transition: transform 500ms;
}

.enable {
  color: white;
}

.main-block {
  padding: 0.8rem;
  position: relative;
  width: 100%
}

.disable {
  color: var(--gray200);
}

.button-blue {
  border: none;
  background-color: transparent;
}

</style>