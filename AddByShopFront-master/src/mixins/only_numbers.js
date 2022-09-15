import remove_space from "@/mixins/remove_space";

export default function (event) {
    event.target.value = remove_space(event.target.value).replace(/[^0-9.]/gi, '');
}