import mainService from "@/services/main/mainService";

function addZero(time) {
    if (time < 10) {
        return "0" + time;
    }
    return time;
}

export const mainModule = {
    namespaced: true,
    state() {
        return {
            lenta: {
                // "text": "Third",
                // "products": [
                //     {
                //         "id": 1,
                //         "image": "http://127.0.0.1:8000/storage/card/image/car.svg",
                //         "title": "first product",
                //         "favourite": false,
                //         "basket": false,
                //         "price": " 0",
                //         "discount": 3,
                //         "real_price": " 0",
                //         "mark": "2.0",
                //         "num_comment": 3,
                //         "credit": []
                //     }
                // ],
                // left_image
            },
            showFooterAndHeader: true,
            banners: [
                //elements
                // id:int, link:string , image:string
            ],
            discount: {
                filter: "",
                items: [
                    // elements
                    // filter
                    // id
                    // mob_image
                    // des_image
                ],
            },
            category_in_home: [
                // {
                //     "category": {
                //         "id": 1,
                //         "name": "asdg agdsgasdg dsgdas g",
                //         "slug": "qtr",
                //         "image": "http://127.0.0.1:8000/storage/category/super_icon/banner(2).png"
                //     },
                //     "color": "#9a2828",
                //     "back_color": "#775050"
                // },
            ],
            popular_category: [],
            hit_products: [],
            shop_list: [],
            product_of_day: {
                hours: 23,
                minutes: 59,
                seconds: 59,
                items: [
                    // elements
                    // image
                    // title
                    // price
                    // favourite
                    // basket
                    // discount
                    // real_price
                    // mark
                    // num_comment
                    // credit : {
                    //  month
                    //  price
                    //  name
                    // }
                ],
            }
        }
    },
    getters: {
        lenta(state) {
            return state.lenta;
        },
        hit_products(state) {
            return state.hit_products;
        },
        category_in_home(state) {
            return state.category_in_home;
        },
        popular_category(state) {
            return state.popular_category;
        },
        banners(state) {
            return state.banners;
        },
        discount(state) {
            return state.discount;
        },
        shop_list(state) {
            console.log(state.shop_list);
            return state.shop_list;
        },
        first_product(state) {
            if (state.product_of_day.items.length !== 0)
                return state.product_of_day.items[0]
            return {}
        },
        showFooterAndHeader: (state) => state.showFooterAndHeader,
        product_of_day(state) {
            return state.product_of_day;
        },
        product_of_day_rest(state) {
            return state.product_of_day.items.slice(1);
        },
        timeObject(state) {
            return {
                hours: addZero(state.product_of_day.hours),
                minutes: addZero(state.product_of_day.minutes),
                seconds: addZero(state.product_of_day.seconds)
            }
        },
        getTime(state) {
            return addZero(state.product_of_day.hours) +
                ":" + addZero(state.product_of_day.minutes) +
                ":" + addZero(state.product_of_day.seconds);
        },
    },
    actions: {
        async getMain({commit}) {
            commit("wait/START", "main", {root: true});
            let result = await mainService.main();
            commit('setMain', result);
            commit("wait/END", "main", {root: true});
        },
        async getLenta({commit}) {
            let result = await mainService.lenta();
            commit('setLenta', result);
        },
        async getCategoryInHome({commit}) {
            const result = await mainService.category_in_home();
            console.log(result.slice(0, 6));
            console.log(result.slice(6));
            commit('setCategoryInHome', result);
        },
        countDownSecond({commit, state}) {
            commit('decreaseSecond');
            if (state["product_of_day"].seconds < 0) {
                commit('decreaseMinutes');
                if (state["product_of_day"].minutes < 0) {
                    commit('decreaseHours');
                    if (state["product_of_day"].hours < 0) {
                        commit('initialStateHours');
                    }
                    commit('initialStateMinutes');
                }
                commit("initialStateSecond");
            }
        },
    },
    mutations: {
        setLenta(state, lenta) {
            state.lenta = lenta;
        },
        decreaseSecond(state) {
            state.product_of_day.seconds--;
        },
        initialStateSecond(state) {
            state.product_of_day.seconds = 59;
        },
        decreaseMinutes(state) {
            state.product_of_day.minutes--;
        },
        initialStateMinutes(state) {
            state.product_of_day.minutes = 59;
        },
        decreaseHours(state) {
            state.product_of_day.hours--;
        },
        initialStateHours(state) {
            state.product_of_day.hours = 23;
        },
        toggleFooterAndHeader(state) {
            state.showFooterAndHeader = !state.showFooterAndHeader;
        },
        openFooterAndHeader(state) {
            state.showFooterAndHeader = true;
        },
        hideFooterAndHeader(state) {
            state.showFooterAndHeader = false;
        },
        setCategoryInHome(state, category) {
            state.category_in_home = category;
            console.log(console.log(state.category_in_home));
        },
        setMain(state, result) {
            state.banners = result.banners;
            state.product_of_day = result.product_of_day;
            state.product_of_day.seconds = 10;
            state.discount = result.discount;
            state.popular_category = result.popular_category;
            state.hit_products = result.hit_products;
            state.shop_list = result.shop_list;
        }
    },


}