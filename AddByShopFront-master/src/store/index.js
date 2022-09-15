import {createStore} from "vuex";
import {authModule} from "@/store/auth/authModule";
import {authWindow} from "@/store/auth/authWindow";
import {langModule} from "@/store/general/langModule";
import {passwordModule} from "@/store/auth/passwordModule";
import {commonModule} from "@/store/common/commonModule";
import {mainModule} from "@/store/main/mainModule";
import {favouriteModule} from "@/store/favourite/favouriteModule";
import {backetModule} from "@/store/backet/backetModule";
import {productModule} from "@/store/product/productModule";
import {navbarModule} from "@/store/general/navbarModule";
import {prepareBasketModule} from "@/store/backet/prepareBasketModule";
import {commentModule} from "@/store/product/commentModule";
import {rateModule} from "@/store/product/rateModule";
import {categoryModule} from "@/store/category/categoryModule";
import {productFilterByModule} from "@/store/product/productFilterByModule";
import {searchModule} from "@/store/search/searchModule";
import {shopModule} from "@/store/shop/shopModule";
import {deliveryInfoModule} from "@/store/backet/registration/deliveryInfoModule";
import {registrationOrderModule} from "@/store/backet/registration/registrationOrderModule";
import {wayOfPaymentModule} from "@/store/backet/registration/wayOfPaymentModule";
import {verificationModule} from "@/store/verification/verificationModule";
import {plasticCardModule} from "@/store/plasticCard/plasticCardModule";
import {purchaseModule} from "@/store/purchase/purchaseModule";
import {policyModule} from "@/store/policy/policyModule";
import {questionModule} from "@/store/question/questionModule";
import {baseAlertModule} from "@/store/alert/baseAlertModule";

export default createStore({
    modules: {
        passwordModule: passwordModule,
        auth: authModule,
        authWindow: authWindow,
        langModule: langModule,
        commonModule: commonModule,
        mainModule: mainModule,
        favouriteModule: favouriteModule,
        backetModule: backetModule,
        navbarModule: navbarModule,
        productModule: productModule,
        prepareBasketModule: prepareBasketModule,
        commentModule: commentModule,
        rateModule: rateModule,
        categoryModule: categoryModule,
        productFilterByModule: productFilterByModule,
        searchModule: searchModule,
        shopModule: shopModule,
        deliveryInfoModule: deliveryInfoModule,
        registrationOrderModule: registrationOrderModule,
        wayOfPaymentModule: wayOfPaymentModule,
        verificationModule: verificationModule,
        plasticCardModule: plasticCardModule,
        purchaseModule: purchaseModule,
        policyModule: policyModule,
        questionModule: questionModule,
        baseAlertModule: baseAlertModule
    }
});
