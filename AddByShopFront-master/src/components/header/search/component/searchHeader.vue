<template>
  <div class="d-flex relative search-form">
    <div class="dropdown">
      <button
          type="button"
          id="cityDropdown"
          data-bs-toggle="dropdown"
          aria-expanded="false"
      >
      </button>
    </div>
    <form class="w-100" autocomplete="off" @submit.stop.prevent>
      <div class="line"></div>
      <input
          v-model="search"
          v-on:keyup.enter="() => search && $router.push('/search/' + search)"
          autocomplete="false"
          @focus="onFocus = true"
          @focusout="leaveFocus"
          type="text"
          :placeholder="$t('Искать товары')"
      />
      <button class="icon_container" disabled>
        <span class="d-none d-sm-none d-md-inline ">
          <span v-show="search" @click="clearSearch" class="bi bi-x pointer text-gray300"
                style="font-size: 30px"></span>
        </span>
        <!--        <span class="pr-3"></span>-->
        <router-link :to="search ? '/search/' + search : ''" class="remove-link">
          <Search icon="search" class=" text-gray300" variant="secondary"></Search>
        </router-link>
      </button>
    </form>
    <search-results v-show="onFocus && search && isVisible"></search-results>
  </div>
</template>
<script setup>
import useSearch from "@/components/header/search/setup/useSearch";
import SearchResults from "@/components/header/search/component/searchResults";
import useSearchResults from "@/components/header/search/setup/useSearchResults";
import Search from "@/components/icons/search";


const {search, clearSearch, leaveFocus, onFocus} = useSearch();
const {isVisible} = useSearchResults();
</script>
<style scoped lang="scss">


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
  position: relative;

  .line {
    height: 100%;
    width: 1px;
    background-color: #f5f5f5;
    display: flex;
    align-items: center;

    & ::after {
      content: "";
      display: block;
      width: 100%;
      height: 60%;
      background-color: #e0e0e0;
    }

  }

  input {
    color: var(--dark);
    font-weight: 500;
    width: 700px;

    &::placeholder {
      color: var(--dark);
      font-weight: 400 !important;
    }

  }

  button {
    border-radius: 0 8px 8px 0;
  }

}

.btns-row {
  display: flex;

  .search-button {
    display: none;
  }

  a {
    color: black;
    display: flex;
    flex-direction: column;
    align-items: center;
    font-weight: 500;
    text-decoration: none;
    padding: 0 10px;

    &
    :hover {
      color: #535963;

      img {
        opacity: 0.7;
      }

    }
  }
}

.icon_container {
  width: 5.5rem;
  display: flex;
  justify-content: center;
  align-items: center;
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

@media (max-width: 767px) {
  //.search-form {
  //  display: none !important;
  //}
  //.dropdown{
  //  padding-left: 1rem;
  //}
  //form{
  //  padding-right: 1rem;
  //}
  form > input {
    width: 100%;
  }
  .search-button {
    display: block !important;
    margin-top: -6px;
    padding: 0 10px;
    background-color: transparent !important;
  }
}
</style>