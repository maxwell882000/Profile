<template>
  <div class="toggle-btn" id="_3rd-toggle-btn">
    <input v-model="model" @click="clicked" type="checkbox">

    <span></span>
  </div>
</template>

<script>
export default {
  props: ['helperText', 'initial', "toggled"],
  components: {},
  data() {
    return {
      model: this.initial || false,
    }
  },
  methods: {
    clicked(val) {
      this.$emit("toggled", val.target.checked);
    }
  }
}

</script>
<style scoped lang="scss">
$height: 25px;
$width: 50px;
$circle: calc($width / 2 + 5px);
.toggle-btn {
  position: relative;
  width: $width;
  height: $height;
  border-radius: 40px;
}

input[type="checkbox"] {
  width: 100%;
  height: 100%;
  position: absolute;
  cursor: pointer;
  opacity: 0;
  z-index: 2;
}

/* Second toggle btn completed */

/* Third toggle btn */

#_3rd-toggle-btn span {
  display: block;
  width: 100%;
  height: 100%;
  background-color: #c7c7c7;
  border-radius: 20px;
  transition: 0.5s ease background-color;
}

#_3rd-toggle-btn span:before {
  content: "";
  position: absolute;
  width: $circle;
  height: $circle;
  left: 0;
  top: -3px;
  background-color: #fff;
  border-radius: 50%;
  //box-shadow: 2px 6px 25px #d7d7d7;
  transform: translate(0px, 0px);
  border: 2px solid var(--gray200);
  transition: 0.6s ease transform, 0.6s box-shadow;
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span:before {
  //box-shadow: 7px 6px 25px #e6e6e6;
  border: 2px solid var(--blue);
  transform: translate($width * 0.42, 0px);
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span:after {
  width: 24px;
  border-radius: 50%;
  transform: translate(30px, 0px);
}

#_3rd-toggle-btn input[type="checkbox"]:checked + span {
  background-color: var(--blue);
}

/* Third toggle btn completed */
</style>