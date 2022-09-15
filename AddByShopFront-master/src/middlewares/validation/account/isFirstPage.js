export default function ({next, store}) {
    const validate = () => store.dispatch('verificationModule/validation');
    const errors = store.getters['verificationModule/errorData'];
    validate();
    if (Object.entries(errors).length) {
        return next({
            name: "start_verify"
        })
    }
    return next();
}