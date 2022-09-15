import categoryService from "@/services/category/categoryService";

export const categoryModule = {
    namespaced: true,
    state() {
        return {
            parent: {
                "side_category": {},
                "discounts": {
                    "filter": "discount",
                    "items": []
                },
                "product_in_categories": [
                    // {
                    //     "id": 4,
                    //     "name": "Sub",
                    //     "slug": "sub",
                    //     "children": [
                    //         {
                    //             "id": 5,
                    //             "name": "This",
                    //             "slug": "this"
                    //         }
                    //     ],
                    //     "products": [
                    //         {
                    //             "id": 1,
                    //             "image": "http://127.0.0.1:8000/storage/card/image/car.svg",
                    //             "title": "first product",
                    //             "favourite": false,
                    //             "basket": false,
                    //             "price": "0",
                    //             "discount": 3,
                    //             "real_price": " 0",
                    //             "mark": "2.0",
                    //             "num_comment": 3,
                    //             "credit": []
                    //         }
                    //     ]
                    // }
                ],
                "depth": undefined
            },
            sub: {
                // "side_category": {},
                // "sub_categories": [
                //     {
                //         "id": 5,
                //         "name": "This",
                //         "slug": "this",
                //         "product": [
                //             {
                //                 "id": 1,
                //                 "image": "http://127.0.0.1:8000/storage/card/image/car.svg",
                //                 "title": "first product",
                //                 "favourite": false,
                //                 "basket": false,
                //                 "price": " 0",
                //                 "discount": 3,
                //                 "real_price": " 0",
                //                 "mark": "2.0",
                //                 "num_comment": 3,
                //                 "credit": []
                //             }
                //         ]
                //     },
                //     {
                //         "id": 6,
                //         "name": "4sad",
                //         "slug": "fourth",
                //         "product": [
                //             {
                //                 "id": 2,
                //                 "image": "http://127.0.0.1:8000/storage/card/image/funel.svg",
                //                 "title": "asdfdf",
                //                 "favourite": false,
                //                 "basket": false,
                //                 "price": " 123",
                //                 "discount": 1,
                //                 "real_price": " 121",
                //                 "mark": "0.0",
                //                 "num_comment": 0,
                //                 "credit": []
                //             }
                //         ]
                //     }
                // ],
                // "pop_products": {
                //     "current_page": 1,
                //     "data": [],
                //     "first_page_url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //     "from": null,
                //     "last_page": 1,
                //     "last_page_url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //     "links": [
                //         {
                //             "url": null,
                //             "label": "&laquo; Previous",
                //             "active": false
                //         },
                //         {
                //             "url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //             "label": "1",
                //             "active": true
                //         },
                //         {
                //             "url": null,
                //             "label": "Next &raquo;",
                //             "active": false
                //         }
                //     ],
                //     "next_page_url": null,
                //     "path": "http://127.0.0.1:8000/api/category/sub",
                //     "per_page": 30,
                //     "prev_page_url": null,
                //     "to": null,
                //     "total": 0
                // },
                // "discount_products": {
                //     "current_page": 1,
                //     "data": [],
                //     "first_page_url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //     "from": null,
                //     "last_page": 1,
                //     "last_page_url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //     "links": [
                //         {
                //             "url": null,
                //             "label": "&laquo; Previous",
                //             "active": false
                //         },
                //         {
                //             "url": "http://127.0.0.1:8000/api/category/sub?page=1",
                //             "label": "1",
                //             "active": true
                //         },
                //         {
                //             "url": null,
                //             "label": "Next &raquo;",
                //             "active": false
                //         }
                //     ],
                //     "next_page_url": null,
                //     "path": "http://127.0.0.1:8000/api/category/sub",
                //     "per_page": 30,
                //     "prev_page_url": null,
                //     "to": null,
                //     "total": 0
                // },
                // "depth": 2
            },
            category: {},
            productInCategory: {}
        }
    },
    getters: {
        productInCategory(state) {
            return state.productInCategory;
        },
        parent(state) {
            return state.parent
        },
        sub(state) {
            return state.sub;
        },
        category(state) {
            return state.category;
        },
    },
    actions: {
        async getCategory({commit}, slug) {
            commit("wait/START", "category_view", {root: true});
            try {
                let result = await categoryService.getCategory(slug);
                commit("setCategory", result);
                if (result.depth === 3) {
                    console.log(result);
                    console.log("FILTER CAN BE APPLIED");
                    commit("productFilterByModule/setFilterCanBeApplied", result, {root: true}) // set the filter
                }
                // namely , which value could exist in filter
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "category_view", {root: true});
        },
        async getProductCategory({commit}, slug) {
            commit("wait/START", "category_product" + slug, {root: true});
            try {
                let result = await categoryService.getProductOfCategoryInSub(slug);
                commit("setProductCategory", {slug: slug, product: result});
            } catch (e) {
                console.log(e);
            }
            commit("wait/END", "category_product" + slug, {root: true});
        }
    },
    mutations: {
        setProductCategory(state, {product, slug}) {
            state.productInCategory[slug] = product;
        },
        setCategory(state, category) {
            switch (category.depth) {
                case 1:
                    state.parent = category;
                    if (!category.product_in_categories) {
                        category.product_in_categories = [];
                    }
                    category.product_in_categories.filter(e => e.children.length !== 0)
                        .forEach(item => state.productInCategory[item.children[0].slug] = item.products);
                    break;
                case 2:
                    state.sub = category;
                    break;
                case 3:
                    state.category = category;
                    break;
            }
        },
    }
}