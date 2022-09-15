import {useStore} from "vuex";
import {computed} from "vue";

export default function (prefix) {

    const store = useStore();
    const fileUpload = (data) => store.dispatch("verificationModule/fileUpload", data);
    const files = computed(() => store.getters['verificationModule/' + prefix]);
    const isNext = computed(() =>
        Object.entries(files.value).length); // prefix = {'passport', 'passport_reverse', 'user_passport'}
    function getImage(url, fileList) {
        fileUpload({prefix: prefix, file: fileList, img: url});
    }

    return {
        getImage: getImage,
        isNext: isNext,
        initialImage: files.value.image
    }
}