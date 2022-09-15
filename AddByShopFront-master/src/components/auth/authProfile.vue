<template>
  <div v-click-outside="close">
    <div @click="open()" id="cities">
      <slot></slot>
    </div>
  </div>
  <div v-if="isOpen" style="top: -5px; padding: 8px 8px 0px 8px"
       class="absolute w-100 bg-white  shadow-md rounded-st container-profile">
    <router-link @click="close" :to="{name:'profile'}" class="remove-link block d-flex bg-color avatar-cont">
      <div style="padding-right: 0.643rem">
        <b-avatar :src="user.avatar" size="lg"></b-avatar>
      </div>
      <div class=" w-100 d-flex justify-content-between align-items-center">
        <div>
          <h6 class="text-600 p-0 m-0" style="font-size: 1.143rem">{{ user.name }}</h6>
          <span :class="user.user_credit ? 'text-green' : 'text-red' ">{{
              user.user_credit ? $t("Верифицирован") : $t("Не верефицированный")
            }}</span>
        </div>
        <div>
          <span class="bi-chevron-right"></span>
        </div>
      </div>
    </router-link>
    <div class="user-routers" :key="'user-routers_key' + index" v-for="(item, index) in tabs.slice(1)">
      <router-link @click="()=>{close(); if (item.isLogout) exitAccount()}" style=" display: flex;
    align-items: end;" class="remove-link" :to="item.isLogout === true ? '': {name: item.pathName}">
        <span :class="item.isLogout ? '' :check(item) ? 'transparent-nav-active' :'transparent-tab-passive'"
              style="padding-right: 1.036rem">
            <component :is="item.icon"></component>
        </span>
        <span>
          {{ item.title }}
        </span>
      </router-link>
    </div>
  </div>
</template>
<script>

import {mapActions, mapGetters, mapMutations, mapState} from "vuex";
import userMenu from "@/components/userPage/setup/userMenu";
import {shallowRef} from "vue";
import i18n from "@/i18n";
import Logout from "@/components/icons/logout";

const t = i18n.global.t;
export default {
  computed: {
    ...mapGetters({
      isAuthenticated: 'isAuthenticated',
      user: "user"
    }),
    ...mapState({
      token: state => state.auth.token
    })

  }, data() {
    return {
      isOpen: false,
      tabs: [
        ...userMenu(),
        {
          isLogout: true,
          pathName: "logout",
          click: this.exitAccount,
          title: t("Выход"),
          icon: shallowRef(Logout),
        },
      ]
    }
  },
  methods: {
    ...mapMutations({
      setLogin: "authWindow/setLogin",
    }),
    ...mapActions({
      logout: "logout",
      getUser: "getUser"
    }),
    check(item) {

      return this.$route.name && item.secondName === this.$route.name || item.pathName === this.$route.name
    },
    open() {
      if (!this.isAuthenticated) {
        this.setLogin();
      } else {
        this.isOpen = true;
      }
    },
    close() {
      if (this.isOpen === true) {
        console.log("opened");
        this.isOpen = false;
      }
    },
    async exitAccount() {
      await this.logout();
    },
    toProfile() {
      this.getUser();
      this.$router.push("/user");
    }
  }
}
</script>
<style>
.user-routers {
  padding: 0.976rem 1.179rem;
}

.container-profile {
  padding: 0.571rem;
}

.avatar-cont {
  border-radius: 8px;
  padding: 0.786rem 1rem;
}
</style>

