import {ref} from "vue";

export default function (cancelStore) {
    const showReason = ref(false);
    const openReason = () => showReason.value = true;
    const closeReason = () => showReason.value = false;

    function cancel(val) {
        cancelStore(val.id === 5 ? val.value : val.text);
        closeReason();
    }

    return {
        showReason: showReason,
        openReason: openReason,
        closeReason: closeReason,
        cancel: cancel
    }


}