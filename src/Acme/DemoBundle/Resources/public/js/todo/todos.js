Posts.Post = DS.Model.extend({
    title: DS.attr('string'),
    body: DS.attr('string'),
    isCompleted: DS.attr('boolean')
});


Posts.Post.FIXTURES = [
    {
        id: 1,
        title: 'Learn Ember.js',
        body: 'body',
        isCompleted: true
    },
    {
        id: 2,
        title: '...',
        body: 'body',
        isCompleted: false
    },
    {
        id: 3,
        title: 'Profit!',
        body: 'body',
        isCompleted: false
    }
];