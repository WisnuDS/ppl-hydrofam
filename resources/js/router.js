import AllPosts from './views/AllPosts';

export default [
    {
        path: '/',
        name: 'posts',
        component: AllPosts,
    },
    {
        path: '*',
        name: 'catch-all',
        redirect: '/blog',
    },
];
