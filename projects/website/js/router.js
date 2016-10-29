var CoasterView     = require('./views/coaster');
var SearchView      = require('./views/search');
var UploadView      = require('./views/upload');
var EditCoasterView = require('./views/editCoaster');
var AdminView       = require('./views/adminView');

var AppRouter = Backbone.Router.extend({
	routes: {
		'search': 'search',
		'coaster(/:slug)/:id': 'coaster',
		'edit/coaster/:id': 'editCoaster',
		'exchange': 'exchange',
		'upload': 'upload',
		'admin/*path': 'admin'
	}
});

module.exports = {
	initialize: function() {
		var app_router = new AppRouter;

		app_router.on('route:search', function() {
			var searchView = new SearchView;
			searchView.render();
		});

		app_router.on('route:coaster', function(name, id) {
			var coasterView = new CoasterView;
			coasterView.render();
		});

		app_router.on('route:editCoaster', function(id) {
			var editCoasterView = new EditCoasterView;
			editCoasterView.render();
		});

		app_router.on('route:upload', function() {
			var uploadView = new UploadView;
			uploadView.render();
		});

		app_router.on('route:admin', function() {
			var adminView = new AdminView;
			adminView.render();
		});

		Backbone.history.start({
			hashChange: false
		});
	}
};
