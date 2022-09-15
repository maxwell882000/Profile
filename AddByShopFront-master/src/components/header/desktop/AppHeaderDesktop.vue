<template>

  <section :class="[scrolled ? 'fixed' : '']">
    <headerUpperLine/>
    <nav>
      <div class="container">
        <div class="d-flex justify-content-between align-items-center py-3">
          <router-link to="/">
            <img src="@/assets/logo.svg" alt="buy-shop logo"/>
          </router-link>
          <div class="d-none d-sm-none d-md-block">
            <search-header></search-header>
          </div>
          <div class="btns-row relative">
            <button class="search-button">
              <span class="bi bi-search text-dark"></span>
            </button>
            <router-link class="relative" to="/favourite">
              <img src="@/assets/icons/heart.svg" alt="heart icon"/>
              <badge-header class="badge-favourite" :counter="user.favourite_counter"></badge-header>
              {{ $t('Избранное') }}
            </router-link>
            <router-link class="relative" to="/cart">
              <img src="@/assets/icons/cart.svg" alt="cart icon"/>
              <badge-header :counter="user.basket_counter"></badge-header>
              {{ $t('Корзина') }}
            </router-link>
            <AuthProfile>
              <a href="#">
                <img src="@/assets/icons/user.svg" alt="cart icon"/>
                {{ $t('Профиль') }}
              </a>
            </AuthProfile>

          </div>
        </div>
        <div class="d-block d-sm-block d-md-none">
          <div v-show="!scrolled">
            <search-header class="justify-content-center w-100"></search-header>
          </div>
        </div>
      </div>
    </nav>
    <headerDownLine class="down-line"/>
  </section>

</template>

<script>
import HeaderUpperLine from "./Header-Upper-Line";
import HeaderDownLine from "./Header-Down-Line";
import AuthProfile from "@/components/auth/authProfile";
import SearchHeader from "@/components/header/search/component/searchHeader";
import {mapGetters} from "vuex";
import BadgeHeader from "@/components/header/badge-header/badgeHeader";

export default {
  components: {BadgeHeader, SearchHeader, AuthProfile, HeaderUpperLine, HeaderDownLine},
  data() {
    return {
      scrolled: false,
    };
  },
  computed: {
    ...mapGetters({
      user: "user",
      basketCounter: "prepareBasketModule/count",
    })
  },
  watch: {
    basketCounter(newVal) { //when user will be in the basket so correct counter about the product will be
      if (this.$route.name === "basket") {
        this.user.basket_counter = newVal;
      }
    },
  },
  mounted() {
    window.onscroll = () => {
      if (window.scrollY > 100 && !this.scrolled) {
        this.scrolled = true;
      } else if (window.scrollY < 100 && this.scrolled) {
        this.scrolled = false;
      }
    };
  },
};
</script>

<style scoped lang="scss">


.badge-favourite {
  right: 26px;
}

nav {
  transition: all 0.3s;
  background-color: white;
  border-bottom: 1px solid #f2f2f2;
  width: 100%;
  position: sticky;
  top: -120px;
  z-index: 2;
}

.fixed {
  nav {
    position: fixed;
    top: 0px;
  }

  .down-line {
    margin-top: 80px;
  }
}

input,
.dropdown button,
button {
  padding-left: 20px;
  padding-right: 20px;
  background: #f5f5f5;
  border: none;
  outline: none;
  height: 44px;
}

.dropdown {
  button {
    border-radius: 8px 0 0 8px;
    font-weight: 500;
  }
}

form {
  display: flex;

  .line {
    height: 100%;
    width: 1px;
    background-color: #f5f5f5;
    display: flex;
    align-items: center;

    &::after {
      content: "";
      display: block;
      width: 100%;
      height: 60%;
      background-color: #e0e0e0;
    }
  }

  input {
    color: black;
    font-weight: 500;
    width: 700px;

    &::placeholder {
      color: black;
      font-weight: 300;
    }
  }

  button {
    border-radius: 0 8px 8px 0;
  }
}

.btns-row {
  display: flex;

  justify-content: space-between;
  width: 25%;
  @media (min-width: 768px) {
    //width: 23.3%;
  }

  .search-button {
    display: none;
  }

  a {
    color: black;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: 300;
    text-decoration: none;
    padding: 0 10px;

    &:hover {
      color: #535963;

      img {
        opacity: 0.7;
      }
    }
  }
}

@media (max-width: 1400px) {
  form > input {
    width: 450px;
  }
}

@media (max-width: 992px) {
  form > input {
    width: 200px;
    font-size: 14px;
  }
  .dropdown {
    button {
      font-size: 14px;
    }
  }
  .btns-row {
    a {
      font-size: 10px !important;
    }
  }
}

//@media (max-width: 767px) {
//  .search-form {
//    display: none !important;
//  }
//  .search-button {
//    display: block !important;
//    margin-top: -6px;
//    padding: 0 10px;
//    background-color: transparent !important;
//  }
//}
</style>