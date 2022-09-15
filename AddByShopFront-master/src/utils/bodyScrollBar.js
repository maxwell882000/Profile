// import Vue from 'vue';

const head = document.getElementsByTagName('head')[0]
const styleTag = document.createElement('style')
styleTag.innerHTML = `.no-scroll { overflow-y: hidden !important; }`
head.appendChild(styleTag);



const html = document.documentElement
export function disableScrollBar(el) {
    if(el)
        document.querySelector(el).classList.add('no-scroll')
    else
        html.classList.add('no-scroll')
}
export function enableScrollBar(el) {
    if(el)
        document.querySelector(el).classList.remove('no-scroll')
    else
        html.classList.remove('no-scroll')
}

// Vue.prototype.enableScrollBar = enableScrollBar
// Vue.prototype.disableScrollBar = disableScrollBar

// export default {
//     disableScrollBar,
//     enableScrollBar,
// }