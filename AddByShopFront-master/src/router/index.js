import {createRouter, createWebHistory,} from "vue-router";
import Home from "../views/home/Home.vue";
import store from "@/store";

import basket from "@/middlewares/basket";
import middlewarePipeline from "@/router/middlewarePipeline";
import userCredit from "@/middlewares/userCredit";
import isFirstPageSuccess from "@/middlewares/validation/isFirstPageSuccess";
import isSecondPageSuccess from "@/middlewares/validation/isSecondPageSuccess";
import isThirdPageSuccess from "@/middlewares/validation/isThirdPageSuccess";
import auth from "@/middlewares/auth";
import checkTakenCredit from "@/middlewares/checkTakenCredit";
import isFirstPage from "@/middlewares/validation/account/isFirstPage";
import isSecondPage from "@/middlewares/validation/account/isSecondPage";
import isThirdPage from "@/middlewares/validation/account/isThirdPage";

const validationChildren = [
    {
        path: "1",
        name: "start_verification",
        component: () => import("../views/verification/firstStep"),
    },
    {
        path: "2",
        name: "second_step",
        component: () => import("../views/verification/secondStep"),
        meta: {
            middleware: [isFirstPageSuccess]
        }
    },
    {
        path: "3",
        name: "third_step",
        component: () => import("../views/verification/thirdStep"),
        meta: {
            middleware: [isFirstPageSuccess, isSecondPageSuccess]
        }
    },
    {
        path: "4",
        component: () => import("../views/verification/fourthStep"),
        meta: {
            middleware: [isFirstPageSuccess, isSecondPageSuccess, isThirdPageSuccess]
        }
    }
];
const routes = [
    {
        path: '/',
        name: "Home",
        component: Home,
    },

    {
        path: "/favourite",
        name: "Favourites",
        component: () => import("../views/favourites/favourites"),
        meta: {
            middleware: [auth]
        }
    },
    {
        path: "/search/:search",
        name: "Search",
        component: () => import("../views/search/searchView")
    },
    {
        path: "/verification/account/",
        name: "VerificationAccount",
        component: () => import("../views/verification/verificationAccount"),
        meta: {
            middleware: [auth]
        },
        children: [
            {
                path: "1",
                name: "start_verify",
                component: () => import("../views/verification/firstStep"),
            },
            {
                path: "2",
                name: "second_verify",
                component: () => import("../views/verification/secondStep"),
                meta: {
                    middleware: [isFirstPage]
                }
            },
            {
                path: "3",
                name: "third_verify",
                component: () => import("../views/verification/thirdStep"),
                meta: {
                    middleware: [isFirstPage, isSecondPage]
                }
            },
            {
                path: "4",
                component: () => import("../views/verification/fourthStep"),
                meta: {
                    middleware: [isFirstPage, isSecondPage, isThirdPage]
                }
            }
        ],
    },
    {
        path: "/verification/surety",
        name: "VerificationAccountSurety",
        component: () => import("../views/verification/verificationAccount"),
        meta: {
            middleware: [auth, checkTakenCredit]
        },
        children: validationChildren
    },
    {
        path: "/item/:id",
        name: "Item",
        component: () => import("../views/product/ItemMain"),
        children: [
            {
                path: "",
                name: "Item",
                component: () =>
                    import("../views/product/Item.vue"),
            },
            {
                path: "comment",
                name: "Comment",
                component: () => import("../views/product/RemainComment.vue"),
                meta: {
                    middleware: [
                        auth
                    ]
                }
            },
            {
                path: "description",
                name: "ItemDescription",
                component: () => import("../views/product/ItemDescription")
            }
        ]
    },
    {
        path: "/category",
        name: "CategoryView",
        component: () => import("../views/category/categoryMain"),
        children: [
            {
                path: "parent/:slug",
                sensitive: true,
                component: () => import("../views/category/categoryParentView")
            },
            {
                path: "sub/:slug",
                component: () => import("../views/category/categorySubView")
            },
            {
                path: "child/:slug",
                name: "CategoryListView",
                component: () => import("../views/category/categoryLastView"),
            },

        ]
    },
    {
        path: "/catalogue",
        name: "catalogue",
        component: () => import("../views/category/categoryCatalogue"),
    },
    {
        path: "/cart",
        component: () =>
            import("../views/takeOrder/BasketMain"),
        meta: {
            middleware: [auth],
        },
        name: "cart",
        children: [
            {
                path: "",
                name: "basket",
                component: () =>
                    import("../views/takeOrder/Basket"),
            },
            {
                path: "selectAddress",
                component: () => import("../views/takeOrder/selectAddress"),
                meta: {
                    middleware: [basket, userCredit]
                }
            },
            {
                path: "plasticCard",
                component: () => import("../views/takeOrder/plasticCard"),
                meta: {
                    middleware: [basket, userCredit]
                }
            },
            {
                path: "prepareOrder",
                component: () => import("../views/takeOrder/prepareOrder"),
                meta: {
                    middleware: [basket, userCredit]
                }
            },
            {
                path: "wayOfPayment",
                name: "WayOfPayment",
                component: () => import('../views/takeOrder/wayOfPayment'),
                meta: {
                    middleware: [basket, userCredit]
                }
            },
        ]
    },
    {
        path: "/shop/:shop",
        name: "Shop",
        component: () =>
            import("../views/shop/Shop.vue"),
    },
    {
        path: "/products/:key/:slug",
        name: "products",
        component: () => import("../views/products/products")
    },
    {
        path: "/shop_all",
        name: "ShopAll",
        component: () =>
            import("../views/shop/ShopAll.vue"),
    },
    {
        path: "/user",
        name: "User",
        component: () => import("../views/user/User.vue"),
        children: [
            {
                path: "",
                name: "profile",
                component: () => import("../components/userPage/settings/userSettings")
            },
            {
                path: "orders",
                name: "orders",
                component: () => import("../components/userPage/orders/ordersUser")
            },
            {
                path: "insertCard",
                name: "insert_card",
                component: () => import("../components/userPage/payments/insertCard")
            },
            {
                path: "plasticCard",
                name: "credit",
                component: () => import("../components/userPage/payments/chooseCard")
            },
            {
                path: "documents",
                name: "documents",
                component: () => import("../components/userPage/documents/documents")
            },
            {
                path: "notification",
                name: "notification",
                component: () => import("../components/userPage/notification/notification")
            },
            {
                path: "questionAndAnswers",
                name: "questionAndAnswers",
                component: () => import("../components/userPage/question/questions")
            },
        ]
    }
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
    scrollBehavior(to, from, savedPosition) {
        if (savedPosition) {
            return savedPosition
        } else {
            return {top: 0}
        }
    }
});
router.beforeEach((to, from, next) => {
    if (!(to.meta.middleware)) {
        return next()
    }
    const middleware = to.meta.middleware;
    console.log("MIDDLEWARE");
    const context = {
        to,
        from,
        next,
        route: next,
        store
    }
    return middleware[0]({
        ...context,
        route: next,
        next: middlewarePipeline(context, middleware, 1)
    })
});
export default router;
