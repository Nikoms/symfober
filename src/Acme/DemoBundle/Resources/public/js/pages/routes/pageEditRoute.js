Pages.PageEditRoute = Ember.Route.extend({
    model: function() {
        return this.modelFor('page');
    }
});