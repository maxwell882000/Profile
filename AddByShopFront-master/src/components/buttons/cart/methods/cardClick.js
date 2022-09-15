import {mapActions, mapGetters, mapMutations} from "vuex";

export default {
    data() {
        return {
            isBasket: this.basket || false,
        }
    },
    props: {
        isSvg: {
            type: Boolean,
            default() {
                return false;
            }
        },
        basket: {
            type: Boolean,
            default() {
                return false;
            },
        },
        image: {
            type: String,
        },
        id: {
            type: Number,
            default() {
                return undefined
            }
        }
    },
    computed: {
        ...mapGetters([
            'isAuthenticated'
        ]),
    },
    methods: {
        ...
            mapActions({
                remove: 'backetModule/removeFromBasket',
                add: 'backetModule/addToBasket',
                getOrders: 'prepareBasketModule/getOrders',
                getProducts: "prepareBasketModule/getInteristingProduct",
                showAlert: "showAlert",
            }),
        ...
            mapMutations({
                setLogin: 'authWindow/setLogin',
            }),
        async clicked() {
            if (this.id && this.isAuthenticated) {
                if (this.isBasket) {
                    this.isBasket = false;
                    await this.remove(this.id);
                } else {
                    this.isBasket = true;
                    await this.add(this.id);
                    this.showAlert({
                        image: this.image,
                        text: "Товар добавлен в корзину"
                    });
                }

                if (this.$route.name === "basket") { // if in the basket page
                    await this.getOrders();
                    await this.getProducts();
                }
            } else if (!this.isAuthenticated) {
                this.setLogin();
            }
        }
    }
}
