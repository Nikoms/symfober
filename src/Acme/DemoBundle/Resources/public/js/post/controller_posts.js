Posts.PostsController = Ember.ArrayController.extend({
    actions: {
        dd:function(){
            alert('PostsController');
        },
        create: function() {
            // Get the post title set by the "New Post" text field
            var title = this.get('newTitle');
            if (!title.trim()) { return; }

            // Create the new Post model
            var post = this.store.createRecord('post', {
                title: title,
                body: 'Body of ' + title
            });

            // Clear the "New Post" text field
            this.set('newTitle', '');

            // Save the new model
            post.save();
        }
    }
});