export default function ({next, route, store}) {
    const takenCreditId = store.getters['verificationModule/takenCreditID'];
    if (!takenCreditId) {
        return route({
            name: "orders"
        })
    }
    return next();
}