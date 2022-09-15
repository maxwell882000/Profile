export default function ({next, store}) {
    const isAuthenticated = store.getters['isAuthenticated'];
    if (!isAuthenticated) {
        store.commit('authWindow/setLogin');
        return ;
    }
    return next();
}