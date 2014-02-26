Posts.Router.map(function () {
    this.resource('posts', { path: '/' }, function () {
        this.route('create');
        this.resource('post', {path:'/post/:id'}, function(){
            // edit an existing photo
            this.route('edit');
        });

    });
});

Posts.PostsRoute = Ember.Route.extend({
    model: function() {
        return this.store.find('post');
    }
});
Posts.PostsIndexRoute = Ember.Route.extend({
    model: function() {
        return this.modelFor('posts');
    }
});
Posts.PostsCreateRoute = Ember.Route.extend({
    model: function() {
        return Em.Object.create({});
    }
});


Posts.PostRoute = Ember.Route.extend({
    model: function(params) {
        return this.store.find('post', params.id);
    }
});
Posts.PostEditRoute = Ember.Route.extend({
    model: function() {
        return this.modelFor('post');
    }
});