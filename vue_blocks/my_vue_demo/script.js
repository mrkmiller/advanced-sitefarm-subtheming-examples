// This will only work on a single block in a page.
// https://www.drupal.org/docs/8/modules/decoupled-blocks-vuejs/simple-per-block-vue-instances

var myDemo = new Vue({
  el: '.my-vue-demo',

  data: {
    people: [],
  },

  // It can be helpful to get the Block Instance ID that Drupal uses. This ID
  // can be used to fetch data that Drupal has set about the block.
  beforeMount: function () {
    var id = this.$el.id;
    console.log('Vue instance ID: ' + id);
  },

  created: function () {
    this.getPeople();
  },

  methods: {
    getPeople: function () {
      var url = 'http://sitefactory-demo.local/jsonapi/node/sf_person';

      var params = {
        sort: 'field_sf_last_name',
        include: 'field_sf_primary_image'
      };

      var self = this;

      jQuery.get(url, params, function (data) {
        self.people = window.jsonapi.parse(data).data;
      });
    }
  }

});
