<template>
<!--    <section>-->
<!--        <page-header />-->

<!--        <div v-if="isReady" class="mt-5">-->
<!--            <div class="col-xl-8 offset-xl-2 col-lg-10 offset-lg-1 col-md-12 mt-3">-->
<!--                <h1 class="font-serif">Canvas</h1>-->
<!--                <p class="lead text-secondary">A Laravel Publishing Platform</p>-->

<!--                <main role="main" class="mt-5">-->
<!--                    <div>-->
<!--                        <h4 class="my-4 border-bottom mt-5 pb-2">-->
<!--                            <span class="border-bottom border-dark pb-2">Posts</span>-->
<!--                        </h4>-->

<!--                        <div :key="`${index}-${post.id}`" v-for="(post, index) in posts">-->
<!--                            <router-link-->
<!--                                :to="{ name: 'show-post', params: { slug: post.slug } }"-->
<!--                                class="text-decoration-none"-->
<!--                            >-->
<!--                                <div class="card mb-4 shadow">-->
<!--                                    <div class="card-body px-0">-->
<!--                                        <div class="container d-lg-inline-flex align-items-center">-->
<!--                                            <div v-if="post.featured_image" class="col-12 col-lg-3 p-0">-->
<!--                                                <img-->
<!--                                                    :src="post.featured_image"-->
<!--                                                    :alt="post.featured_image_caption"-->
<!--                                                    class="rounded w-100"-->
<!--                                                />-->
<!--                                            </div>-->
<!--                                            <section-->
<!--                                                class="col-12 mt-3 mt-lg-0 px-0 px-lg-3"-->
<!--                                                :class="post.featured_image ? 'col-lg-9' : ''"-->
<!--                                            >-->
<!--                                                <h5 class="card-title text-truncate mb-0">{{ post.title }}</h5>-->
<!--                                                <p class="card-text text-truncate">{{ post.summary }}</p>-->
<!--                                                <p class="card-text mb-0 text-secondary">-->
<!--                                                    {{ post.user.name }}-->
<!--                                                    <span v-if="post.topic.length"> in {{ post.topic[0].name }} </span>-->
<!--                                                </p>-->
<!--                                                <p class="card-text text-secondary">-->
<!--                                                    {{ moment(post.published_at).format('MMM D, Y') }} —-->
<!--                                                    {{ post.read_time }}-->
<!--                                                </p>-->
<!--                                            </section>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </router-link>-->
<!--                        </div>-->

<!--                        <infinite-loading spinner="spiral" @infinite="fetchPosts">-->
<!--                            <span slot="no-more" />-->
<!--                            <div slot="no-results" class="text-left">-->
<!--                                <div class="my-5">-->
<!--                                    <p class="lead text-center text-muted mt-5">You have no published posts</p>-->
<!--                                    <p class="lead text-center text-muted mt-1">-->
<!--                                        Write on the go with our mobile-ready app!-->
<!--                                    </p>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </infinite-loading>-->
<!--                    </div>-->
<!--                </main>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
    <section class="ftco-section ftco-degree-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ftco-animate">
                    <div class="row">
                        <!-- post start-->
                        <div class="col-md-12 d-flex ftco-animate" :key="`${index}-${post.id}`" v-for="(post, index) in posts">
                            <div class="blog-entry align-self-stretch d-md-flex">
                                <a href="blog-single.html" class="block-20" style="background-image: url('images/image_1.jpg');">
                                </a>
                                <div class="text d-block pl-md-4">
                                    <div class="meta mb-3">
                                        <div><a href="#">July 20, 2019</a></div>
                                        <div><a href="#">Admin</a></div>
                                        <div><a href="#" class="meta-chat"><span class="icon-chat"></span> 3</a></div>
                                    </div>
                                    <h3 class="heading"><a href="#">Even the all-powerful Pointing has no control about the blind
                                        texts</a></h3>
                                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live
                                        the blind texts.</p>
                                    <p><a href="blog-single.html" class="btn btn-primary py-2 px-3">Read more</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- post end-->
                    </div>
                </div>
                <!-- .col-md-8 -->
                <div class="col-lg-4 sidebar ftco-animate">
                    <div class="sidebar-box">
                        <form action="#" class="search-form">
                            <div class="form-group">
                                <span class="icon ion-ios-search"></span>
                                <input type="text" class="form-control" placeholder="Search...">
                            </div>
                        </form>
                    </div>
                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Categories</h3>
                        <ul class="categories">
                            <li><a href="#">Vegetables <span>(12)</span></a></li>
                            <li><a href="#">Fruits <span>(22)</span></a></li>
                            <li><a href="#">Juice <span>(37)</span></a></li>
                            <li><a href="#">Dries <span>(42)</span></a></li>
                        </ul>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Recent Blog</h3>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_1.jpg);"></a>
                            <div class="text">
                                <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind
                                    texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_2.jpg);"></a>
                            <div class="text">
                                <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind
                                    texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="block-21 mb-4 d-flex">
                            <a class="blog-img mr-4" style="background-image: url(images/image_3.jpg);"></a>
                            <div class="text">
                                <h3 class="heading-1"><a href="#">Even the all-powerful Pointing has no control about the blind
                                    texts</a></h3>
                                <div class="meta">
                                    <div><a href="#"><span class="icon-calendar"></span> April 09, 2019</a></div>
                                    <div><a href="#"><span class="icon-person"></span> Admin</a></div>
                                    <div><a href="#"><span class="icon-chat"></span> 19</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Tag Cloud</h3>
                        <div class="tagcloud">
                            <a href="#" class="tag-cloud-link">fruits</a>
                            <a href="#" class="tag-cloud-link">tomatoe</a>
                            <a href="#" class="tag-cloud-link">mango</a>
                            <a href="#" class="tag-cloud-link">apple</a>
                            <a href="#" class="tag-cloud-link">carrots</a>
                            <a href="#" class="tag-cloud-link">orange</a>
                            <a href="#" class="tag-cloud-link">pepper</a>
                            <a href="#" class="tag-cloud-link">eggplant</a>
                        </div>
                    </div>

                    <div class="sidebar-box ftco-animate">
                        <h3 class="heading">Paragraph</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate
                            quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos
                            fugit cupiditate numquam!</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
</template>

<script>
import InfiniteLoading from 'vue-infinite-loading';
import NProgress from 'nprogress';
import PageHeader from '../components/PageHeaderComponent';
import isEmpty from 'lodash/isEmpty';

export default {
    name: 'all-posts',

    components: {
        InfiniteLoading,
        PageHeader,
    },

    metaInfo() {
        return {
            title: 'Canvas',
        };
    },

    data() {
        return {
            page: 1,
            posts: [],
            isReady: false,
        };
    },

    async created() {
        await Promise.all([this.fetchPosts()]);
        this.isReady = true;
        NProgress.done();
    },

    methods: {
        fetchPosts($state) {
            if ($state) {
                return this.request()
                    .get('/api/posts', {
                        params: {
                            page: this.page,
                        },
                    })
                    .then(({ data }) => {
                        if (!isEmpty(data) && !isEmpty(data.data)) {
                            this.page += 1;
                            this.posts.push(...data.data);

                            $state.loaded();
                        } else {
                            $state.complete();
                        }

                        if (isEmpty($state)) {
                            NProgress.inc();
                        }
                    })
                    .catch(() => {
                        NProgress.done();
                    });
            }
        },
    },
};
</script>
