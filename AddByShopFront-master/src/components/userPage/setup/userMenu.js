import {shallowRef} from "vue";
import UserProfile from "@/components/icons/userProfile";
import UserOrders from "@/components/icons/userOrders";
import UserPayment from "@/components/icons/userPayment";
import UserQuestions from "@/components/icons/userQuestions";
import i18n from '@/i18n'

export default function () {
    const t = i18n.global.t;
    return [
        {
            pathName: "profile",
            title: t("Главная"),
            icon: shallowRef(UserProfile),
        },
        {
            pathName: "orders",
            title: t("Мои заказы"),
            icon: shallowRef(UserOrders),
        },
        {
            pathName: "credit",
            secondName: "insert_card",
            title: t("Оплата"),
            icon: shallowRef(UserPayment),
        },
        // {
        //   pathName: "documents",
        //   title: "Мои документы",
        //   icon: "file-earmark-text-fill",
        // },
        // {
        //   pathName: "notification",
        //   title: "Уведомления",
        //   icon: "bell-fill",
        // },
        {
            pathName: "questionAndAnswers",
            title: t("Вопросы и ответы"),
            icon: shallowRef(UserQuestions),
        },
    ]
}