<template>
  <b-col :cols="column">
    <router-link :to="path"><p class="sub_header"> {{ category.name }}</p></router-link>
    <router-link :to="'/category/child/'+ item.slug" v-for="(item, index) in category.children.slice(0,5)"
                 :key="'category_sub_child_' + index + 'slug_' + item.slug">
      <p class="elements"> {{ item.name }}</p>
    </router-link>
    <b-collapse :id="'text_collapse_' + category.slug">
      <router-link to="">
        <p v-for="(item, index) in category.children.slice(5)"
           :key="'category_sub_child_' + index + 'slug_' + item.slug" class="elements">
          {{ item.name }}</p>
      </router-link>
    </b-collapse>
    <p v-if="category.children.length > 5" @click="show = !show" v-b-toggle="'text_collapse_' + category.slug"
       class="elements link">{{ $t("Показать еще") }}
      <span class="bi" :class="show ? 'bi-chevron-up' : 'bi-chevron-down'"></span>
    </p>
    <div class="bottom-margin"></div>
  </b-col>
</template>
<script>
export default {
  props: {
    category: {},
    column: {
      type: Number,
      default() {
        return 4;
      }
    },
  },
  data() {
    return {
      path: '/category/sub/' + this.category.slug,
      show: false
    }
  },
}
</script>
<style scoped>
a {
  color: inherit !important;
  text-decoration: none !important;
}

p {
  margin: 0;
  text-transform: none;
  padding: 0;
  font-style: normal;
}

p:hover {
  color: var(--violet);
}

.link {
  color: var(--violet) !important;
  cursor: pointer;
}

.sub_header {
  font-weight: 600;
  font-size: small;
  margin-bottom: 0.7rem;
}

.bottom-margin {
  margin-bottom: 1rem;

}

.elements {
  color: var(--gray);
  font-size: small;
  line-height: 1.6rem;
  margin-bottom: 0.2rem;
}
</style>