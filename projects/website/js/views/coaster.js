var Backbone = require('backbone');
var RatingsModel = require('../models/rating');

module.exports = Backbone.View.extend({
	el: 'body',
	id: 'ratings',

	events: {
		'click .toggle > a': 'toggleRatingVisibility',
		'click .vote': 'updateVote'
	},

	updateVote: function(event) {

		event.preventDefault();

		// Allow us to call view methods in callbacks.
		var view = this;

		// Vote button
		$button = $(event.target);

		var id, hash, dir;

		// Rating ID
		id   = $button.parent('p').attr('id');

		// CSRF token.
		hash = $button.data('hash');

		// Calculate direction.
		dir = $button.hasClass('up') ? 1 : -1;

		// If the user has already selected this button then set the score to 0.
		dir = $button.hasClass('selected') ? 0 : dir;

		// Update the existing rating model.
		var model = new RatingsModel({
			id: id,
			hash: hash,
			direction: dir
		});

		// Save the ratings model.
		model.save({}, {
			success: function(model, response) {
				view.updateVoteScore(model, response, $button);
			}
		});
	},

	/**
	 * After the vote has been sent to the server, update the score display
	 * with the new score.
	 */
	updateVoteScore: function(model, response, button) {

		// Get the rating header container.
		var header = button.parent('.header');

		// Update the points value.
		header.find('.points').html(response.points);

		// Remove the selected class from all the vote buttons except the one that
		// was pressed.
		header.find('.vote').not(button).removeClass('selected');

		// Toggle button CSS
		button.toggleClass('selected');
	},

	/**
	 * Toggle a ratings visibility.
	 */
	toggleRatingVisibility: function(event) {
		event.preventDefault();

		// jQuery object of collapse button pressed.
		$button = $(event.target);

		// Rating ID
		var id = $button.parents('p').attr('id');

		// Comment container
		$comment = this.el.find('#comment-'+id);

		// Toggle CSS class
		$comment.toggleClass('collapsed');

		// Update anchor text based on visibility.
		var label = $comment.is(':hidden') ? '+' : '-';

		$button.html('[ '+label+' ]');
	}

});