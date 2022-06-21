require('./bootstrap');

window.Vue = require('vue').default;

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('jocs', require('./components/JocsComponent.vue').default);
Vue.component('sales', require('./components/SalaComponent.vue').default);
Vue.component('reserves', require('./components/ReservaComponent.vue').default);
Vue.component('valoracions', require('./components/ValoracioComponent.vue').default);

const app = new Vue({
    el: '#app',
});
