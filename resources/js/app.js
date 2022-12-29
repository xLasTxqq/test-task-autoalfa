import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import PrimeVue from 'primevue/config';
import "primevue/resources/themes/saga-blue/theme.css";
import "primevue/resources/primevue.min.css";
import "primeicons/primeicons.css";
// import LaravelPermissionToVueJS from 'laravel-permission-to-vuejs'
// import { abilitiesPlugin } from '@casl/vue';
// import { Abilities } from '@casl/ability';
// import ability from './services/ability';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(ZiggyVue, Ziggy)
            .use(PrimeVue, {
                ripple: true,
                locale: {
                  startsWith: "Starts with",
                  contains: "Contains",
                  notContains: "Not contains",
                  endsWith: "Ends with",
                  equals: "Equals",
                  notEquals: "Not equals",
                  noFilter: "No Filter",
                  lt: "Less than",
                  lte: "Less than or equal to",
                  gt: "Greater than",
                  gte: "Greater than or equal to",
                  dateIs: "Date is",
                  dateIsNot: "Date is not",
                  dateBefore: "Date is before",
                  dateAfter: "Date is after",
                  clear: "Очистить",
                  apply: "Применить",
                  matchAll: "Match All",
                  matchAny: "Match Any",
                  addRule: "Add Rule",
                  removeRule: "Remove Rule",
                  accept: "Да",
                  reject: "Нет",
                  choose: "Choose",
                  upload: "Upload",
                  cancel: "Cancel",
                  dayNames: [
                    "Sunday",
                    "Monday",
                    "Tuesday",
                    "Wednesday",
                    "Thursday",
                    "Friday",
                    "Saturday",
                  ],
                  dayNamesShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
                  dayNamesMin: ["Вс", "Пн", "Вт", "Ср", "Чт", "Пт", "Сб"],
                  monthNames: [
                    "Января",
                    "Февраль",
                    "Март",
                    "Апрель",
                    "Май",
                    "Июнь",
                    "Июль",
                    "Август",
                    "Сентябрь",
                    "Октябрь",
                    "Ноябрь",
                    "Декабрь",
                  ],
                  monthNamesShort: [
                    "Jan",
                    "Feb",
                    "Mar",
                    "Apr",
                    "May",
                    "Jun",
                    "Jul",
                    "Aug",
                    "Sep",
                    "Oct",
                    "Nov",
                    "Dec",
                  ],
                  today: "Today",
                  weekHeader: "Wk",
                  firstDayOfWeek: 1,
                  dateFormat: "mm.dd.yy",
                  weak: "Weak",
                  medium: "Medium",
                  strong: "Strong",
                  passwordPrompt: "Enter a password",
                  emptyFilterMessage: "No results found",
                  emptyMessage: "No available options",
                },
              })
              // .use(LaravelPermissionToVueJS)
              // .use(abilitiesPlugin, ability)
            .mount(el);
    },
});

InertiaProgress.init({ color: '#4B5563' });
