(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-799ce3da"],{1963:function(e,t,n){"use strict";n.r(t);var c=n("7a23"),o=n("8fc4"),r=n("9bd1"),a=n("be60"),l=n("5502"),s=n("47e2"),u={class:"container mb-3"},i={class:"mb-3 text-header-32"},p={class:"d-flex flex-wrap",style:{gap:"0.714rem"}},b={setup:function(e){var t=Object(s["b"])().t,n=[{name:t("Главная"),path:"/"},{name:t("Все магазины"),path:"/shop_all"}],b=Object(l["f"])(),d=function(){return b.dispatch("shopModule/getAllShop")};d();var j=Object(c["computed"])((function(){return b.getters["shopModule/shop_all"]}));return function(e,t){return Object(c["openBlock"])(),Object(c["createBlock"])(Object(c["unref"])(o["a"]),{waiting:"shop_all_loaded"},{default:Object(c["withCtx"])((function(){return[Object(c["createElementVNode"])("section",u,[Object(c["createVNode"])(Object(c["unref"])(r["a"]),{path:n}),Object(c["createElementVNode"])("h5",i,Object(c["toDisplayString"])(e.$t("Все магазины")),1),Object(c["createElementVNode"])("div",p,[(Object(c["openBlock"])(!0),Object(c["createElementBlock"])(c["Fragment"],null,Object(c["renderList"])(Object(c["unref"])(j),(function(e){return Object(c["openBlock"])(),Object(c["createBlock"])(Object(c["unref"])(a["a"]),{key:"all_shop_items"+e.slug,shop:e},null,8,["shop"])})),128))])])]})),_:1})}}};const d=b;t["default"]=d},5090:function(e,t,n){},6148:function(e,t,n){"use strict";n("5090")},"9bd1":function(e,t,n){"use strict";n("b0c0");var c=n("7a23"),o=function(e){return Object(c["pushScopeId"])("data-v-3d42a0f7"),e=e(),Object(c["popScopeId"])(),e},r=o((function(){return Object(c["createElementVNode"])("svg",{width:"8",height:"12",viewBox:"0 0 8 12",fill:"none",xmlns:"http://www.w3.org/2000/svg"},[Object(c["createElementVNode"])("path",{d:"M1.5 1L6.5 6L1.5 11",stroke:"#9499A5","stroke-width":"1.25","stroke-linecap":"round","stroke-linejoin":"round"})],-1)}));function a(e,t,n,o,a,l){var s=Object(c["resolveComponent"])("router-link"),u=Object(c["resolveComponent"])("ResponsiveLayout");return Object(c["openBlock"])(),Object(c["createBlock"])(u,null,{desktop:Object(c["withCtx"])((function(){return[Object(c["createElementVNode"])("div",Object(c["mergeProps"])(e.$attrs,{class:"d-flex flex-nowrap badge p-0"}),[(Object(c["openBlock"])(!0),Object(c["createElementBlock"])(c["Fragment"],null,Object(c["renderList"])(n.path,(function(e){return Object(c["openBlock"])(),Object(c["createElementBlock"])("div",{key:e.name,class:"link"},[r,Object(c["createVNode"])(s,{to:e.path},{default:Object(c["withCtx"])((function(){return[Object(c["createTextVNode"])(Object(c["toDisplayString"])(e.name),1)]})),_:2},1032,["to"])])})),128))],16)]})),_:1})}var l=n("b5e1"),s={components:{ResponsiveLayout:l["a"]},inheritAttrs:!1,props:{path:Array}},u=(n("6148"),n("6b0d")),i=n.n(u);const p=i()(s,[["render",a],["__scopeId","data-v-3d42a0f7"]]);t["a"]=p}}]);
//# sourceMappingURL=chunk-799ce3da.830cb645.js.map