AppAdmin.Router.map(function () {
    this.resource('posts', { path: '/admin/posts' }, function () {
        this.route('create');
        this.resource('post', {path:'/post/:id'}, function(){
            // edit an existing photo
            this.route('edit');
        });
    });
});
