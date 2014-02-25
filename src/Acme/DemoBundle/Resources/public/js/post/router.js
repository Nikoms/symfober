
Posts.Router.map(function () {

    this.resource('posts', { path: '/' }, function () {
        this.route('create');
        // additional child routes will go here later
        this.route('active');
        this.route('completed');


        this.resource('post', {path:'/post/:id'}, function(){
            // edit an existing photo
            this.route('edit');
        });

    });
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
Posts.PostsCreateRoute = Ember.Route.extend({
    model: function() {
        return Em.Object.create({});
    }
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