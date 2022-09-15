<template>
  <empty-base :image="image" :title="title" :desc="desc">
    <router-link :to="link" class="mt-2 goto-catalogue btn btn-primary">
      {{ buttonText }}
    </router-link>
  </empty-base>
</template>

<script>
import EmptyBase from "@/components/helper/empty/emptyBase";

export default {
  components: {EmptyBase},
  inheritAttrs: false,
  props: ['image', 'title', 'desc', 'buttonText', 'link']
}
</script>
