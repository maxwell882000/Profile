import i18n from '@/i18n'

const t = i18n.global.t;
export default function (data, error, key, label) {
    if (!data[key]) {
        console.log(label);
        console.log(t);
        console.log(t("обязательное поле"))
        error[key] = label + " " + t("обязательное поле");
    } else {
        delete error[key];
    }
}