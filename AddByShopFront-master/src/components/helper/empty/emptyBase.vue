<template>
  <section class="container py-3">
    <div class="card empty-card">
      <img :src="require('@/assets/'  + image)" alt="basket image"/>
      <h4>{{ title }}</h4>
      <p>
        {{ desc }}
      </p>
      <slot></slot>
    </div>
  </section>
</template>

<script>
export default {
  inheritAttrs: false,
  props: ['image', 'title', 'desc']
}
</script>
<style lang="scss">
.card {
  border: none;
  border-radius: 12px;

  display: flex;
  justify-content: flex-end;
  flex-direction: column;

  &.empty-card {
    align-items: center;
    padding: 20px;
  }

  .goto-catalogue {
    padding: 10px 40px;
    border-radius: 12px;
  }

  .line {
    margin: 10px 0;
    background: #f2f2f2;
    width: 100%;
    height: 1px;
  }

  .btn {
    font-size: 14px;

    &[disabled] {
      background-color: #f2f2f2;
      color: var(--grey);
      border-color: transparent;
    }
  }
}
</style>