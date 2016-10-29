var Backbone = require('backbone');
var MarkdownIt = require('markdown-it');

module.exports = Backbone.View.extend({
    el: 'body',
    id: 'description-text',

    events: {
        'keyup #description-text':'updatePreview'
    },

    initialize: function() {
        this.md = new MarkdownIt();
        this.updatePreview();
    },

    updatePreview: function() {
        this.$el.find('#preview').html(this.md.render(this.$el.find('#' + this.id).val()));
    }

});
