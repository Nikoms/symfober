Posts.PostController = Ember.ObjectController.extend({
    isCompleted: function(key, value){
        var model = this.get('model');

        if (value === undefined) {
            // property being used as a getter
            return model.get('isCompleted');
        } else {
            // property being used as a setter
            model.set('isCompleted', value);
            model.save();
            return value;
        }
    }.property('model.isCompleted'),

    actions: {
        editPost: function() {
            this.set('isEditing', true);
        },
        acceptChanges: function() {
            var model = this.get('model');
            this.set('isEditing', false);

            if (Ember.isEmpty(this.get('model.title'))) {
                this.send('removePost');
            } else {
                var onSuccess = function(post) {
                    console.log('Tout va bien :)');
                    console.log(post);
                };

                var onFail = function(response) {
                    console.error('onfail de acceptChanges');
                    //CA CA FONCTIONNE :)
                    model.rollback();
                    console.error(response);
                };

                this.get('model').save().then(onSuccess, onFail);
            }
        },
        removePost: function(){
            var todo = this.get('model');
            todo.deleteRecord();

            var onSuccess = function(post) {
                console.log('Tout va bien :)');
                console.log(post);
            };

            var onFail = function() {
                console.error('removePost failed');
                console.log(todo);
                //MARCHE PAS ? A cause du return?
//                todo.rollback();
//                todo.transaction.rollback();
                //Faire une transitionRoute?



            };
            todo.save().then(onSuccess, onFail);


        }
    },

    isEditing: false
});