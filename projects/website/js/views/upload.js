var Backbone = require('backbone');
var FileInput = require('bootstrap-fileinput');

module.exports = Backbone.View.extend({
  el: 'body',
  id: 'upload-form',

  initialize: function() {
    this.$el.find('input[type=file]').fileinput();
  }

});
