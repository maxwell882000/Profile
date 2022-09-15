import verificationConstant from "@/constants/verification/verificationConstant";

export default function ({next, store}) {
    const file = store.getters['verificationModule/' + verificationConstant.PASSPORT_REVERSE];
    if (!Object.entries(file).length) {
        return next({
            name: "third_step"
        })
    }
    return next();
}