export default function ({next, route, store}) {
    const orders = store.getters['prepareBasketModule/selectedOrders'];
    if (Object.entries(orders).length === 0) {
        console.log("USER CREDIT NOT MUST BE SHOWN");
        return route({
            name: "basket"
        })
    }
    return next();
}