// This will only work on a single block in a page.
// https://www.drupal.org/docs/8/modules/decoupled-blocks-vuejs/simple-per-block-vue-instances

const myDemo = new Vue({
  el: '.my-vue-demo',

  // template: '<div>{{ message }}</div>',

  data: {
    message: 'Hello SiteFarmers!'
  },

  // It can be helpful to get the Block Instance ID that Drupal uses. This ID
  // can be used to fetch data that Drupal has set about the block.
  beforeMount: function () {
    const id = this.$el.id;
    console.log('Vue instance ID: ' + id);
  }

});
