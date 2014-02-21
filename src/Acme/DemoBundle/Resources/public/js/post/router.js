
Posts.Router.map(function () {
    this.resource('posts', { path: '/' }, function () {
        // additional child routes will go here later
        this.route('active');
        this.route('completed');
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

Posts.PostsActiveRoute = Ember.Route.extend({
    model: function(){
        return this.store.filter('post', function(post) {
            return !post.get('isCompleted');
        });
    },
    renderTemplate: function(controller) {
        this.render('posts/index', {controller: controller});
    }
});


Posts.PostsCompletedRoute = Ember.Route.extend({
    model: function(){
        return this.store.filter('post', function(post) {
            return post.get('isCompleted');
        });
    },
    renderTemplate: function(controller) {
        this.render('posts/index', {controller: controller});
    }
});