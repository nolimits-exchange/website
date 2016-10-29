var Backbone = require('backbone');
var Slider   = require('bootstrap-slider');

module.exports = Backbone.View.extend({
	el: 'body',
	id: 'ratings',

	events: {
		'click .toggle > a': 'toggleRatingVisibility',
		'click .vote': 'updateVote'
	},

	initialize: function() {
		var downloads = new Slider('input#downloads');
		var ratings   = new Slider('input#ratings');
	}
});
