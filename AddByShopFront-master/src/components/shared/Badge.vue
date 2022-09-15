<template>
  <ResponsiveLayout>
    <template #desktop>
      <div v-bind="$attrs" class="d-flex flex-nowrap badge p-0">
        <div v-for="pathPart in path" :key="pathPart.name" class="link">
          <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M1.5 1L6.5 6L1.5 11" stroke="#9499A5" stroke-width="1.25" stroke-linecap="round"
                  stroke-linejoin="round"/>
          </svg>
          <router-link :to="pathPart.path">{{ pathPart.name }}</router-link>
        </div>
      </div>
    </template>
  </ResponsiveLayout>

</template>

<script>
import ResponsiveLayout from "@/components/responsive/ResponsiveLayout";

export default {
  components: {ResponsiveLayout},
  inheritAttrs: false,
  props: {
    path: Array,
  }
}
</script>

<style lang="scss" scoped>
.badge {
  width: 100%;
  font-size: 1rem !important;
  overflow: hidden;
  font-weight: 400 !important;
  @media (max-width: 767px) {
    flex-wrap: wrap !important;
  }

}


.badge .link:last-child a {
  color: var(--gray200);
}

.link {
  display: flex;
  align-items: center;
}

.link:first-child > svg {
  display: none;
}

a {
  margin: 10px;
  text-decoration: none;
  color: var(--dark);
}

a:hover {
  color: grey;
}

.link:first-child a {
  margin-left: 0;
}
</style>