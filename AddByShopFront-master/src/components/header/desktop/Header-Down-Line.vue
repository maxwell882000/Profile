<template>
  <div v-if="showCategoryLine" class="down-line">
    <div class="container full">
      <div class="d-flex align-items-center justify-content-between links-row">
        <div class="d-none d-md-block">
          <b-button
              @click="toggle()"
              variant="primary"
              class="d-flex align-items-center"
          >
            <img
                v-if="!categoriesOpened"
                src="@/assets/icons/burger.svg"
                alt="burger icon"
                class="burger"
            />
            <img
                v-else
                src="@/assets/icons/x.svg"
                alt="x icon"
                class="burger"
            />
            {{ $t("Каталог товаров") }}
          </b-button>
          <b-collapse
              id="categories"
              :visible="categoriesOpened"
              class="categories h-100"
          >
            <div class="filter-tabs bottom-border bg-white mt-1">
              <div class="container mt-3 ">
                <FilterTabs/>
              </div>
            </div>
          </b-collapse>
        </div>
        <div v-for="item in nav_bar" :key="item.slug" class="header-link">
          <router-link :to="'/category/parent/' + item.slug">{{ item.name }}
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {disableScrollBar, enableScrollBar} from "@/utils/bodyScrollBar";
import FilterTabs from "@/components/header/desktop/Filter-Tabs";
import {mapGetters, mapMutations, mapState} from "vuex";

export default {
  name: "Header-Down-Line",
  components: {
    FilterTabs,
  },
  computed: {
    ...mapState({
      categoriesOpened: state => state.categoriesOpened
    }),
    ...mapGetters([
      'nav_bar',
      'categoriesOpened',
      'showCategoryLine'
    ])
  },
  methods: {
    ...mapMutations([
      'toggleCategoryOpened'
    ]),
    toggle() {
      this.toggleCategoryOpened();
    }
  },
  watch: {
    categoriesOpened() {
      window.scroll(0, 0);
      if (this.categoriesOpened) {
        disableScrollBar();
      } else {
        enableScrollBar();
      }
    },
  },
};
</script>

<style scoped lang="scss">
.down-line {
  background-color: white;
}

.links-row {
  overflow-x: auto;
  overflow-y: hidden;
  padding: 0.3rem 0;

  .btn-primary {
    white-space: nowrap;
    border-radius: 8px;
    padding: 9px 15px;
    border: none;
    box-shadow: none !important;

    img {
      margin-right: 10px;
      width: 22px;
    }
  }

  .categories {
    position: fixed;
    z-index: 667;
    width: 100%;
    left: 0;
    background-color: white;
    transition: all 0.3s;
    height: calc(100vh - 170px);

    .bottom-border {
      border-top: 1px solid #f2f2f2;
    }

    &.collapsing {
      height: 0 !important;
    }
  }

  .filter-tabs {
    height: 100%;
  }
}

.header-link {
  padding: 10px;

  a {
    white-space: nowrap;
    display: block;
    color: black;
    text-decoration: none;

    &::after {
      transition: all 0.3s ease-in-out;
      content: "";
      display: block;
      width: 0;
      height: 2.5px;
      left: 50%;
      background-color: var(--blue);
      border-radius: 50% 50% 0 0;
      opacity: 0;
      visibility: hidden;
      position: relative;
      bottom: -16px;
    }

    &:hover::after {
      left: 0;
      width: 100%;
      visibility: visible;
      opacity: 1;
    }
  }
}
</style>