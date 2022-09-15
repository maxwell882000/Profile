import verificationConstant from "@/constants/verification/verificationConstant";

export default function ({next, store}) {
    const file = store.getters['verificationModule/' + verificationConstant.PASSPORT];
    if (!Object.entries(file).length) {
        return next({
            name: "second_step"
        })
    }
    return next();
}