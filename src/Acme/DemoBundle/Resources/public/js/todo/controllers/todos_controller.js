Posts.PostsController = Ember.ArrayController.extend({
    actions: {
        createPost: function() {
            // Get the post title set by the "New Post" text field
            var title = this.get('newTitle');
            if (!title.trim()) { return; }

            // Create the new Post model
            var post = this.store.createRecord('post', {
                title: title,
                isCompleted: false
            });

            // Clear the "New Post" text field
            this.set('newTitle', '');

            // Save the new model
            post.save();
        },
        clearCompleted : function(){
            var completed = this.filterBy('isCompleted', true);
            completed.invoke('deleteRecord');
            completed.invoke('save');
        }
    },
    remaining: function() {
        return this.filterBy('isCompleted', false).get('length');
    }.property('@each.isCompleted'),

    inflection: function() {
        var remaining = this.get('remaining');
        return remaining === 1 ? 'item' : 'items';
    }.property('remaining'),

    hasCompleted: function() {
        return this.get('completed') > 0;
    }.property('completed'),

    completed: function() {
        return this.filterBy('isCompleted', true).get('length');
    }.property('@each.isCompleted'),
    allAreDone: function(key, value) {
        if (value === undefined) {
            return !!this.get('length') && this.everyProperty('isCompleted', true);
        } else {
            this.setEach('isCompleted', value);
            this.invoke('save'); //Nécessaire?!
            return value;
        }
    }.property('@each.isCompleted')
});