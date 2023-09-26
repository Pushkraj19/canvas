import Dashboard from '@/pages/Dashboard.vue'
import PostList from '@/pages/PostList.vue'
import Settings from '@/pages/Settings.vue'
import ShowPost from '@/pages/ShowPost.vue'
import ShowTag from '@/pages/ShowTag.vue'
import ShowTopic from '@/pages/ShowTopic.vue'
import ShowUser from '@/pages/ShowUser.vue'
import TagList from '@/pages/TagList.vue'
import TopicList from '@/pages/TopicList.vue'
import UserList from '@/pages/UserList.vue'
import { store } from '@/store'
import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/dashboard',
    name: 'dashboard',
    component: Dashboard
  },
  {
    path: '/posts',
    name: 'posts',
    component: PostList,
    props: route => ({
      author: route.query?.author,
      page: route.query?.page,
      sort: route.query?.sort,
      type: route.query?.type
    })
  },
  {
    path: '/posts/create',
    name: 'create-post',
    component: ShowPost
  },
  {
    path: '/posts/:id',
    name: 'show-post',
    component: ShowPost
  },
  {
    path: '/tags',
    name: 'tags',
    component: TagList,
    props: route => ({
      page: route.query?.page,
      sort: route.query?.sort,
      usage: route.query?.usage
    })
  },
  {
    path: '/tags/create',
    name: 'create-tag',
    component: ShowTag
  },
  {
    path: '/tags/:id',
    name: 'show-tag',
    component: ShowTag
  },
  {
    path: '/topics',
    name: 'topics',
    component: TopicList,
    props: route => ({
      page: route.query?.page,
      sort: route.query?.sort,
      usage: route.query?.usage
    })
  },
  {
    path: '/topics/create',
    name: 'create-topic',
    component: ShowTopic
  },
  {
    path: '/topics/:id',
    name: 'show-topic',
    component: ShowTopic
  },
  {
    path: '/users',
    name: 'users',
    component: UserList,
    props: route => ({
      role: route.query?.role,
      page: route.query?.page,
      sort: route.query?.sort
    })
  },
  {
    path: '/users/create',
    name: 'create-user',
    component: ShowUser
  },
  {
    path: '/users/:id',
    name: 'show-user',
    component: ShowUser
  },
  {
    path: '/settings',
    name: 'settings',
    component: Settings
  },
  {
    path: '/:catchAll(.*)',
    redirect: 'dashboard'
  }
]

const router = createRouter({
  history: createWebHistory(store.state.config.path),
  routes
})

export default router
