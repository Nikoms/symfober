Posts.PostController = Ember.ObjectController.extend({
    actions: {
        editMode: function() {
            this.set('isEditing', true);
        },
        save: function() {
            var model = this.get('model');
            this.set('isEditing', false);

            if (Ember.isEmpty(this.get('model.title'))) {
                this.send('removePost');
            } else {
                this.get('model').save().then(
                    function(post) {
                        console.log('Tout va bien (acceptChanges) :)');
                        console.log(post);
                    },
                    function(response) {
                        console.error('onfail de acceptChanges');
                        //CA CA FONCTIONNE :)
                        model.rollback();
                        console.error(response);
                    }
                );
            }
        },
        remove: function(){
            var model = this.get('model');
            model.deleteRecord();

            model.save().then(
                function(model) {
                    console.log('Tout va bien. (removePost) :)');
                    console.log(model);
                },
                function() {
                    console.error('removePost failed');
                    console.log(model);
                    todo.rollback();
                    //Comment le faire reapparaitre dans la liste?
                });


        }
    },

    isEditing: false
});