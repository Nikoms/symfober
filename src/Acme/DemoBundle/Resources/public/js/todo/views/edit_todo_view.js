Posts.EditPostView = Ember.TextField.extend({
    didInsertElement: function() {
        this.$().focus();
    }
});

Ember.Handlebars.helper('edit-post', Posts.EditPostView);