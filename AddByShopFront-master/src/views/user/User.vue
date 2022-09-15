<template>
  <section class="container pt-3 pb-5">
    <badge :path="path"/>
    <b-tabs
        pills
        card
        vertical
        nav-class="user-sheet"
        v-model="currentTab"
        nav-wrapper-class="bg-transparent border-0 w-max"
        active-nav-item-class="bg-white transparent-nav-active text-nowrap"
        class="user-tabs">
      <b-tab lazy
             :key="'user_item_tab_' + index" v-for="(item , index) in tabs"
             title-link-class="transparent-tab-passive">
        <template #title>
          <div>
            <span class="pr-2" style="font-size: 1.2rem">
              <component :is="item.icon"></component>
            </span>
            <span>
              {{ item.title }}
            </span>
          </div>
        </template>
        <router-view></router-view>
      </b-tab>
    </b-tabs>
  </section>
</template>

<script>
import Badge from "../../components/shared/Badge.vue";
import UserSettings from "../../components/userPage/settings/userSettings.vue";
import OrderUser from "@/components/userPage/orders/ordersUser";
import ChooseCard from "@/components/userPage/payments/chooseCard";
import Documents from "@/components/userPage/documents/documents";
import Notification from "@/components/userPage/notification/notification";
import Questions from "@/components/userPage/question/questions";
import {mapActions, mapGetters, mapMutations} from "vuex";
import UserPayment from "@/components/icons/userPayment";
import i18n from '@/i18n'
import userMenu from "@/components/userPage/setup/userMenu";

const t = i18n.global.t;
export default {
  data: () => ({
    path: [
      {
        name: t("Главная"),
        path: "/",
      },
      {
        name: t("Профиль"),
        path: "/user",
      },
    ],
    currentTab: 3,
    tabs: userMenu()
  }),
  // eslint-disable-next-line vue/no-unused-components
  components: {UserPayment, Questions, Notification, Documents, ChooseCard, OrderUser, Badge, UserSettings},
  computed: {
    ...mapGetters({
      isAuthenticated: "isAuthenticated"
    })
  },
  watch: {
    isAuthenticated(val) {
      if (!val) {
        this.$router.replace("/");
      }
    },
    $route() {
      this.tabs.forEach((e, i) => {
        if (this.check(e)) {
          this.currentTab = i;
        }
      });
    },
    currentTab(val) {
      this.tabs.forEach((e, i) => {
        if (i === val && e.secondName !== this.$route.name)
          this.$router.push({
            name: e.pathName
          })
      });
    }
  },
  methods: {
    ...mapActions({
      getPurchases: "purchaseModule/getPurchases",
      getCard: "plasticCardModule/getCards",
      getQuestions: "questionModule/getQuestions"
    }),
    ...mapMutations({
      cleanCard: "purchaseModule/clean"
    }),
    check(item) {
      return item.secondName === this.$route.name || item.pathName === this.$route.name
    },
    setCorrectTab() {
      this.tabs.forEach((e, i) => {
            if (this.check(e)) {
              this.currentTab = i;
            }
          }
      );
    },
  },
  created() {
    this.setCorrectTab();
    if (!this.isAuthenticated) {
      this.$router.replace("/");
    }
    this.getPurchases();
    this.getCard();
    this.getQuestions();
  },
  unmounted() {
    this.cleanCard();
  }
};
</script>
<style lang="scss">
.user-tabs {
  .card-header {
    padding: 0.5rem 1rem 0.5rem 0 !important;
  }

  .tab-content .tab-pane {
    padding: 5px 0 !important;
  }
}


.user-sheet {
  .nav-item {
    white-space: nowrap;
    margin-bottom: 0.2rem;
    margin-top: 0.2rem;
    min-width: min-content !important;
  }
}

</style>
<style scoped>


.container {
  min-height: 800px;
}
</style>