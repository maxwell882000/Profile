<template>
  <div class="mb-4 pl-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <div>
        <h5 class="category-sub">{{ name }}</h5>
      </div>
      <div>
        <show-all :link="link"></show-all>
      </div>
    </div>
    <slot></slot>
  </div>
</template>
<script>
import ShowAll from "@/components/helper/button/showAll";

export default {
  components: {ShowAll},
  props: ['name', 'link']
}
</script>
<style scoped lang="scss">
.category-sub {
  font-size: 2.1rem;
  line-height: 2.3rem;
}
</style>