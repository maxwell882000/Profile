import {createApp} from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
import VueSplide from '@splidejs/vue-splide';
import BootstrapVue3 from 'bootstrap-vue-3'
import axios from 'axios'
import VueAxios from 'vue-axios'
import {createVueWait} from 'vue-wait'
import VueClickAway from "vue3-click-away";
import VueLazyLoad from 'vue3-lazyload'
import VueVirtualScroller from 'vue-virtual-scroller'
import "@egjs/vue3-flicking/dist/flicking.css";
import {Vue3Mq} from "vue3-mq";

// bootstrap css
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue-3/dist/bootstrap-vue-3.css'
import 'bootstrap-icons/font/bootstrap-icons.css'
// global scss
import "./fonts.scss";
import "./styles.scss";
import "./override.scss";
import i18n from './i18n'
import Flicking from "@egjs/vue3-flicking";

const VueWait = createVueWait({useVuex: true, registerDirective: true})
createApp(App)
    .use(VueVirtualScroller)
    .use(store)
    .use(router)
    .use(Vue3Mq)
    .use(VueClickAway)
    .use(VueSplide)
    .use(VueLazyLoad)
    .use(VueWait)
    .use(BootstrapVue3)
    .use(VueAxios, axios)
    .use(i18n)
    .component("Flicking", Flicking)
    .directive('click-outside', {
        mounted(el, binding) {
            el.clickOutsideEvent = function (event) {
                if (!(el === event.target || el.contains(event.target))) {
                    binding.value(event, el);
                }
            };
            document.body.addEventListener('click', el.clickOutsideEvent);
        },
        unmounted(el) {
            document.body.removeEventListener('click', el.clickOutsideEvent);
        }
    }).mount("#app");

