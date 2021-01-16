import { expr } from "jquery";

import date from "./date"
import gender from "./gender"
export default {
    install(Vue) {
        Vue.filter('date', date)
        Vue.filter('gender', gender)
    }
}