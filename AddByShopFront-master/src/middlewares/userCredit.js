export default function userCredit({next, route, store}) {
    const isUserData = store.getters['isUserData'];
    if (!isUserData) {
        return route({
            name: "start_verify"
        })
    }
    return next();
}