<template>
  <loader waiting="category_view">
    <section class="container my-4">
      <Badge :path="info.path"></Badge>
      <h5 class="text-header-32 py-2 mb-3">{{ info.name }}</h5>
      <router-view></router-view>
    </section>
  </loader>
</template>
<script>
import {mapActions, mapGetters, mapMutations} from "vuex";
import Loader from "@/components/loading/loader";
import Badge from "@/components/shared/Badge";

export default {
  components: {Badge, Loader},
  data() {
    return {

      unwatch: undefined,
      info: {
        path: [],
        name: ""
      }
    }
  },
  computed: {
    ...mapGetters({
      drop_bar: "drop_bar",
    })
  },
  watch: {
    drop_bar() {
      this.setPath();
    }
  },
  methods: {
    ...mapActions({
      getCategory: 'categoryModule/getCategory'
    }),
    ...mapMutations([
      'closeCategoryOpened',
    ]),
    setPath(sluggable) {
      this.info.path = [ // set path can be called several times, so we rest every time it is called
        {
          name: this.$t("Главная"),
          path: "/"
        }
      ];
      let slug = sluggable || this.$route.params.slug;
      let info = this.info;
      this.drop_bar.filter(parent => parent.slug === slug
          || parent.children.filter(sub => sub.slug === slug // checking slug for all levels
              || sub.children.filter(child => child.slug === slug).length !== 0).length !== 0).forEach(e => {
        info.name = e.name; // setting name of the page from here, we can remove checking because name will be overwritten
        // if we in the sub category page
        info.path.push({
          name: e.name,
          path: '/category/parent/' + e.slug // putting first level breadcrumbs  for parent
        });

        e.children.filter(ch => ch.slug === slug || ch.children.filter(child => child.slug === slug).length !== 0).forEach(sub => { // if the slug was used for children
          info.path.push({
            name: sub.name,
            path: "/category/sub/" + sub.slug // setting second level breadcrumbs
          });
          info.name = sub.name; // if the second level breadcrubms was used it implies that we are in the second page
          // so name set properly
          sub.children.filter(child => child.slug === slug).forEach(child => {// the same rule applies here as above
            info.path.push({
              name: child.name,
              path: "/category/child/" + child.slug
            });
            info.name = child.name;
          })
        })
      })
    },
  },
  created() {
    this.unwatch = this.$watch(
        () => this.$route.params,
        (val) => {
          if (val.slug) {
            this.getCategory(val.slug);
            this.closeCategoryOpened();
            this.setPath(val.slug)
          }
        },
        // fetch the data when the view is created and the data is
        // already being observed
        {
          immediate: true
        }
    )
    ;
  },
  beforeUnmount() {
    this.unwatch();
  }
}
</script>
