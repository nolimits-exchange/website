var Backbone = require('backbone');

module.exports = Backbone.View.extend({
    el: '.js-tabs',

    events: {
        "click a": "changeTab"
    },

    changeTab: function(e) {
        e.preventDefault();
        $(e.currentTarget).tab('show');    },

    initialize: function() {

    }
});
