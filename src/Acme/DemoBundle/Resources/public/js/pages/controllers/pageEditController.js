Pages.PageEditController = Ember.ObjectController.extend({
    actions: {
        save: function(){
            alert('called twice :(');
//            var page = this.get('model');
//            var controller = this;
//            page.save().then(
//                function() {
//                    controller.transitionToRoute('pages');
//                },
//                function(response) {
//                    page.rollback();
//                    alert('error while saving');
//                }
//            );

        },
        close: function(){
            this.transitionToRoute('page');
        }
    }
});