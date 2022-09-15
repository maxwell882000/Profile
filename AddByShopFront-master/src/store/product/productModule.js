// import productService from "@/services/product/productService";

import productService from "@/services/product/productService";

export const productModule = {
    namespaced: true,
    state() {
        return {
            currentImage: "",
            imageList: [],
            credit: {
                "id": 0,
                "percent": 0,
                "month": 0,
                "main_credit_id": 0
            },
            product: {
                "id": 0,
                "installment": {
                    "name": "",
                    "credits": [
                        // {
                        //     "id": 1,
                        //     "percent": 12,
                        //     "month": 2,
                        //     "main_credit_id": 1
                        // }
                    ]
                },
                "images": [
                    // {
                    //     "image": "http://127.0.0.1:8000/storage/product/image/Vector9.png"
                    // }
                ],
                "category": [
                    // {
                    //     "name": "ГЛАВНЫЙ",
                    //     "slug": "asdsad"
                    // },
                ],
                "colors": [
                    // {
                    //     "image": "http://127.0.0.1:8000/storage/product/main/color/Vector11.png",
                    //     "color_name": "черный",
                    //     "images": [
                    //         "http://127.0.0.1:8000/storage/product/many/color/banner111.png"
                    //     ]
                    // }
                ],
                "shop": {
                    "name": "",
                    "slug": "",
                    "logo": "",
                },
                "key_with_values": [
                    // {
                    //     "text": "Название хедера",
                    //     "values": [
                    //         "23",
                    //         "32",
                    //         "21"
                    //     ]
                    // }
                ],
                "about_product": {
                    "id": 0,
                    "header": "",
                    "body": ""
                },
                "characteristics": [
                    // {
                    //     "header": "Большие Характеристики",
                    //     "values": [
                    //         {
                    //             "key": "Число Пи",
                    //             "value": "12"
                    //         },
                    //         {
                    //             "key": "Число ЗЕТ",
                    //             "value": "32"
                    //         }
                    //     ]
                    // }
                ],
                "image": "",
                "title": "",
                "favourite": false,
                "basket": false,
                "price": 0,
                "discount": 0,
                "real_price": "",
                "mark": 0,
                "num_comment": 0,
                "credit": {
                    "month": 0,
                    "price": "",
                    "name": ""
                }
            }
        }
    },
    actions: {
        // eslint-disable-next-line no-unused-vars
        setOrder({commit}, product) {
            if (product.order) {
                if (product.order.additional)
                    commit("backetModule/setOrder", {
                        id: product.id,
                        key: 'additional',
                        value: product.order.additional
                    }, {root: true})
                if (product.order.colors) {
                    commit("backetModule/setOrder", {
                        id: product.id,
                        key: 'colors',
                        value: product.order.colors
                    }, {root: true})
                }
            }
        },
        async loadProduct({commit, dispatch}, id) {
            commit('wait/START', 'product', {root: true});
            let product = await productService.getProduct(id);
            commit("setProduct", product);
            dispatch("setOrder", product);
            commit('setImageList', product.images);
            if (product.installment && product.installment.credits.length !== 0)
                commit('setCredit', product.installment.credits[0])
            commit("wait/END", 'product', {root: true});
        }
    },
    mutations: {
        setProductOrder(state, order_id) { // used when basket changed in product view
            if (state.product) {
                state.product.order = {
                    'id': order_id
                };
            }
        },
        setProduct(state, product) {
            state.product = product;
        },
        setCurrentImage(state, image) {
            state.currentImage = image;
        },
        setImageList(state, imageList) {
            state.imageList = imageList;
            if (imageList.length !== 0)
                state.currentImage = imageList[0]
        },
        setCredit(state, credit) {
            state.credit = credit;
        }
    },
    getters: {
        credit(state) {
            return state.credit;
        },
        shop(state) {
            return state.product.shop
        },
        selectComponent(state) {
            return state.product.key_with_values;
        },
        colors(state) {
            return state.product.colors;
        },
        currentImage(state) {
            return state.currentImage;
        },
        imageList(state) {
            return state.imageList;
        },
        reviews(state) {
            return state.product.num_comment;
        },
        image(state) {
            return state.product.image;
        },
        name(state) {
            return state.product.title;
        },
        rating(state) {
            return state.product.mark;
        },
        favourite(state) {
            return {
                favourite: state.product.favourite,
                id: state.product.id
            }
        },
        path(state) {
            let response = [
                {
                    name: "Главная",
                    path: "/"
                }
            ];
            let category = state.product.category;
            if (category.length !== 0) {
                category.forEach(function (elem) {
                    let path = "";
                    switch (elem.depth) {
                        case 2:
                            path = "/category/sub/" + elem.slug;
                            break;
                        case 3:
                            path = "/category/child/" + elem.slug;
                            break;
                        default:
                            path = '/category/parent/' + elem.slug;
                    }
                    response.push({
                        name: elem.name,
                        path: path
                    })
                });
                // let last = category.slice(-1)[0]
                response.push({
                    name: state.product.title,
                    path: "/item/" + state.product.id
                })
            }
            return response
        },
        order_id(state) {
            if (state.product.order)
                return state.product.order.id || 0
            return 0;
        },
        product(state) {
            return state.product;
        }
    }
}