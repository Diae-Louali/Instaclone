<template>
    <div class="profile">
        <div class="flex items-center justify-center my-3"> 
            <div class="flex flex-col items-center justify-center w-full">
                <div v-if="sessionUser" class="">
                    <div class="w-content profile_avatar_wrapper flex flex-col items-center sm:flex-row ">
                        <img v-b-modal.image_modal @click="showImage" class="slider-image sm:w-32 sm:h-32 lg:w-40 lg:h-40 lg:mr-10" :src="user.pfp" />
                        <span class="sm:hidden my-2 text-center username font-weight-bold position-relative">{{user.username}}                    
                            <button :id="'userId'+user.id" :data-followerId="user.id" @click="followUnfollow" class="btn btn-light profile_follow_btn" 
                                v-text="`${sessionUser.followed.includes(user.id) ? 'Unfollow' : 'Follow'}`">
                            </button>                      
                        </span>
                        <div class="max-w-sm">
                            <div class="hidden sm:flex flex-col px-3 ">
                                <div class="flex justify-between ">
                                    <span class="hidden sm:inline-block self-center text-xl lg:text-3xl lg:mr-3 ">{{user.username}}</span>
                                    <div v-if="sessionUserId == userId" @click="goToProfile" class="edit_profile cursor-pointer w-content text-xs py-1 pl-1 pr-2 lg:mr-3 rounded">
                                        <svg aria-label="Options"  fill="#262626" height="18" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M46.7 20.6l-2.1-1.1c-.4-.2-.7-.5-.8-1-.5-1.6-1.1-3.2-1.9-4.7-.2-.4-.3-.8-.1-1.2l.8-2.3c.2-.5 0-1.1-.4-1.5l-2.9-2.9c-.4-.4-1-.5-1.5-.4l-2.3.8c-.4.1-.8.1-1.2-.1-1.4-.8-3-1.5-4.6-1.9-.4-.1-.8-.4-1-.8l-1.1-2.2c-.3-.5-.8-.8-1.3-.8h-4.1c-.6 0-1.1.3-1.3.8l-1.1 2.2c-.2.4-.5.7-1 .8-1.6.5-3.2 1.1-4.6 1.9-.4.2-.8.3-1.2.1l-2.3-.8c-.5-.2-1.1 0-1.5.4L5.9 8.8c-.4.4-.5 1-.4 1.5l.8 2.3c.1.4.1.8-.1 1.2-.8 1.5-1.5 3-1.9 4.7-.1.4-.4.8-.8 1l-2.1 1.1c-.5.3-.8.8-.8 1.3V26c0 .6.3 1.1.8 1.3l2.1 1.1c.4.2.7.5.8 1 .5 1.6 1.1 3.2 1.9 4.7.2.4.3.8.1 1.2l-.8 2.3c-.2.5 0 1.1.4 1.5L8.8 42c.4.4 1 .5 1.5.4l2.3-.8c.4-.1.8-.1 1.2.1 1.4.8 3 1.5 4.6 1.9.4.1.8.4 1 .8l1.1 2.2c.3.5.8.8 1.3.8h4.1c.6 0 1.1-.3 1.3-.8l1.1-2.2c.2-.4.5-.7 1-.8 1.6-.5 3.2-1.1 4.6-1.9.4-.2.8-.3 1.2-.1l2.3.8c.5.2 1.1 0 1.5-.4l2.9-2.9c.4-.4.5-1 .4-1.5l-.8-2.3c-.1-.4-.1-.8.1-1.2.8-1.5 1.5-3 1.9-4.7.1-.4.4-.8.8-1l2.1-1.1c.5-.3.8-.8.8-1.3v-4.1c.4-.5.1-1.1-.4-1.3zM24 41.5c-9.7 0-17.5-7.8-17.5-17.5S14.3 6.5 24 6.5 41.5 14.3 41.5 24 33.7 41.5 24 41.5z" fill-rule="evenodd"></path></svg>
                                        <span>Edit profile </span> 
                                    </div>
                                    <button :id="'userId'+user.id" :data-followerId="user.id" @click="followUnfollow" class="edit_profile w-content text-xs py-1 px-3 rounded font-semibold" 
                                        v-text="`${sessionUser.followed.includes(user.id) ? 'Unfollow' : 'Follow'}`">
                                        
                                    </button>    
                                </div>
                                <div v-if="user" class="flex my-2">
                                    <div class="flex profile_info">
                                        <div class="mr-4 flex items-center justify-center">
                                            <span class=" font-weight-bold pr-1">{{user.posts.length}}</span>
                                            <span class="font-weight-light">Posts</span>
                                        </div>
                                        <div v-b-modal="'my-followers'" class="mx-4 flex items-center justify-center">
                                            <span  class=" font-weight-bold pr-1">{{user.following.length}}</span>
                                            <span class="font-weight-light">Followers</span>
                                        </div>
                                        <div v-b-modal="'my-following'" class="ml-4 flex items-center justify-center">
                                            <span  class=" font-weight-bold pr-1">{{user.followedUsers.length}}</span>
                                            <span class="font-weight-light">Following</span>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="px-3 mt-2">
                                <span class="description text-justify text-xs lg:text-sm font-light">{{user.bio}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:hidden">
                    <div v-if="sessionUserId == userId" @click="goToProfile" class="edit_profile w-full btn btn-light">
                        <svg aria-label="Options" class="_8-yf5 " fill="#262626" height="20" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M46.7 20.6l-2.1-1.1c-.4-.2-.7-.5-.8-1-.5-1.6-1.1-3.2-1.9-4.7-.2-.4-.3-.8-.1-1.2l.8-2.3c.2-.5 0-1.1-.4-1.5l-2.9-2.9c-.4-.4-1-.5-1.5-.4l-2.3.8c-.4.1-.8.1-1.2-.1-1.4-.8-3-1.5-4.6-1.9-.4-.1-.8-.4-1-.8l-1.1-2.2c-.3-.5-.8-.8-1.3-.8h-4.1c-.6 0-1.1.3-1.3.8l-1.1 2.2c-.2.4-.5.7-1 .8-1.6.5-3.2 1.1-4.6 1.9-.4.2-.8.3-1.2.1l-2.3-.8c-.5-.2-1.1 0-1.5.4L5.9 8.8c-.4.4-.5 1-.4 1.5l.8 2.3c.1.4.1.8-.1 1.2-.8 1.5-1.5 3-1.9 4.7-.1.4-.4.8-.8 1l-2.1 1.1c-.5.3-.8.8-.8 1.3V26c0 .6.3 1.1.8 1.3l2.1 1.1c.4.2.7.5.8 1 .5 1.6 1.1 3.2 1.9 4.7.2.4.3.8.1 1.2l-.8 2.3c-.2.5 0 1.1.4 1.5L8.8 42c.4.4 1 .5 1.5.4l2.3-.8c.4-.1.8-.1 1.2.1 1.4.8 3 1.5 4.6 1.9.4.1.8.4 1 .8l1.1 2.2c.3.5.8.8 1.3.8h4.1c.6 0 1.1-.3 1.3-.8l1.1-2.2c.2-.4.5-.7 1-.8 1.6-.5 3.2-1.1 4.6-1.9.4-.2.8-.3 1.2-.1l2.3.8c.5.2 1.1 0 1.5-.4l2.9-2.9c.4-.4.5-1 .4-1.5l-.8-2.3c-.1-.4-.1-.8.1-1.2.8-1.5 1.5-3 1.9-4.7.1-.4.4-.8.8-1l2.1-1.1c.5-.3.8-.8.8-1.3v-4.1c.4-.5.1-1.1-.4-1.3zM24 41.5c-9.7 0-17.5-7.8-17.5-17.5S14.3 6.5 24 6.5 41.5 14.3 41.5 24 33.7 41.5 24 41.5z" fill-rule="evenodd"></path></svg>
                        Edit profile 
                    </div>
                    <div class="flex justify-center profile_info_wrapper w-full">
                        <div v-if="user" class="flex profile_info">
                            <div class="mr-4 flex items-center justify-center flex-col">
                                <span class=" font-weight-bold">{{user.posts.length}}</span>
                                <span class="font-weight-light">Posts</span>
                            </div>
                            <div v-b-modal="'my-followers'" class="mx-4 flex items-center justify-center flex-col">
                                <span  class=" font-weight-bold">{{user.following.length}}</span>
                                <span class="font-weight-light">Followers</span>
                            </div>
                            <div v-b-modal="'my-following'" class="ml-4 flex items-center justify-center flex-col">
                                <span  class=" font-weight-bold">{{user.followedUsers.length}}</span>
                                <span class="font-weight-light">Following</span>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div> 
            
            <b-modal id="my-followers" centered modal-class="sharePost_Modal"  hide-header hide-footer >
                <ul class="sharePostUl position-relative">
                    <span  @click="$bvModal.hide('my-followers')" class="close_icon"></span> 
                    <searchComponent :users="user.following" :sessionUser="sessionUser" ></searchComponent>
                </ul>
            </b-modal>

            <b-modal id="my-following" centered  modal-class="sharePost_Modal"  hide-header hide-footer >
                <ul class="sharePostUl position-relative">
                    <span  @click="$bvModal.hide('my-following')" class="close_icon"></span> 
                    <searchComponent :users="user.followedUsers" :sessionUser="sessionUser"></searchComponent>
                </ul>            
            </b-modal>
        </div>
       
        <div class="mb-5 sm:mx-auto sm:w-3/4">
            <b-tabs active-nav-item-class="active_svg" fill lazy>
                <b-tab active >
                    <template v-slot:title>
                        <svg aria-label="Posts" class="_8-yf5 " fill="#8e8e8e" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M45 1.5H3c-.8 0-1.5.7-1.5 1.5v42c0 .8.7 1.5 1.5 1.5h42c.8 0 1.5-.7 1.5-1.5V3c0-.8-.7-1.5-1.5-1.5zm-40.5 3h11v11h-11v-11zm0 14h11v11h-11v-11zm11 25h-11v-11h11v11zm14 0h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11zm14 28h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11z" fill-rule="evenodd"></path></svg>
                        <div class="tooltip_notif">
                            <span class="tooltip_text">Posts</span>
                        </div>
                    </template>
                    <div class="post_history_wrapper">
                        <div v-for="(post, key) in user.postsType" :key="key" class="post_history" >
                            <img v-b-modal.image_modal @click="showImage" v-if="post.media_type == 'image'"  :src="post.media_file" :data-postId="post.id" class="w-full h-100"/>
                            <video v-else-if="post.media_type == 'video'" controls muted class="w-full h-100">
                            <source :src="post.media_file"  />
                            </video>
                        </div>
                    </div>
                </b-tab>
                <b-tab>
                    <template v-slot:title>
                        <svg aria-label="Tagged" class="_8-yf5 " fill="#8e8e8e" height="24" viewBox="0 0 48 48" width="24"><path d="M41.5 5.5H30.4c-.5 0-1-.2-1.4-.6l-4-4c-.6-.6-1.5-.6-2.1 0l-4 4c-.4.4-.9.6-1.4.6h-11c-3.3 0-6 2.7-6 6v30c0 3.3 2.7 6 6 6h35c3.3 0 6-2.7 6-6v-30c0-3.3-2.7-6-6-6zm-29.4 39c-.6 0-1.1-.6-1-1.2.7-3.2 3.5-5.6 6.8-5.6h12c3.4 0 6.2 2.4 6.8 5.6.1.6-.4 1.2-1 1.2H12.1zm32.4-3c0 1.7-1.3 3-3 3h-.6c-.5 0-.9-.4-1-.9-.6-5-4.8-8.9-9.9-8.9H18c-5.1 0-9.4 3.9-9.9 8.9-.1.5-.5.9-1 .9h-.6c-1.7 0-3-1.3-3-3v-30c0-1.7 1.3-3 3-3h11.1c1.3 0 2.6-.5 3.5-1.5L24 4.1 26.9 7c.9.9 2.2 1.5 3.5 1.5h11.1c1.7 0 3 1.3 3 3v30zM24 12.5c-5.3 0-9.6 4.3-9.6 9.6s4.3 9.6 9.6 9.6 9.6-4.3 9.6-9.6-4.3-9.6-9.6-9.6zm0 16.1c-3.6 0-6.6-2.9-6.6-6.6 0-3.6 2.9-6.6 6.6-6.6s6.6 2.9 6.6 6.6c0 3.6-3 6.6-6.6 6.6z"></path></svg>
                        <div class="tooltip_notif">
                            <span class="tooltip_text">Stories</span>
                        </div>
                    </template>
                    <div class="post_history_wrapper">
                        <div v-for="(story, key) in user.storiesType" :key="key" class="post_history" >
                            <img v-b-modal.image_modal @click="showImage"  v-if="story.media_type == 'image'"  :src="story.media_file" class="w-full h-100"/>
                            <video v-else-if="story.media_type == 'video'" controls muted class="w-full h-100">
                            <source :src="story.media_file"  />
                            </video>
                        </div>
                    </div>
                </b-tab>
                <b-tab>
                    <template v-slot:title>
                        <svg aria-label="Saved" class="_8-yf5 " fill="#8e8e8e" height="24" viewBox="0 0 48 48" width="24"><path d="M43.5 48c-.4 0-.8-.2-1.1-.4L24 29 5.6 47.6c-.4.4-1.1.6-1.6.3-.6-.2-1-.8-1-1.4v-45C3 .7 3.7 0 4.5 0h39c.8 0 1.5.7 1.5 1.5v45c0 .6-.4 1.2-.9 1.4-.2.1-.4.1-.6.1zM24 26c.8 0 1.6.3 2.2.9l15.8 16V3H6v39.9l15.8-16c.6-.6 1.4-.9 2.2-.9z"></path></svg>                        
                        <div class="tooltip_notif">
                            <span class="tooltip_text">Saved</span>
                        </div>
                    </template>
                    <div class="post_history_wrapper">
                        <div v-for="(favoritedPost, key) in user.favorite_posts" :key="key" class="post_history" >
                            <img v-b-modal.image_modal @click="showImage"  v-if="favoritedPost.media_type == 'image'"  :src="favoritedPost.media_file" :data-postId="favoritedPost.id" class="w-full h-100"/>
                            <video v-else-if="favoritedPost.media_type == 'video'" controls muted class="w-full h-100">
                            <source :src="favoritedPost.media_file"  />
                            </video>
                        </div>
                    </div>
                </b-tab>
                <b-tab>
                    <template v-slot:title>
                        <svg aria-label="Activity" class="_8-yf5 " fill="#8e8e8e" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>
                        <div class="tooltip_notif">
                            <span class="tooltip_text">Liked</span>
                        </div>
                    </template>

                    <b-tabs active-nav-item-class="active_svg"  fill lazy>
                        <b-tab active >
                            <template v-slot:title>
                                <svg aria-label="Posts" class="_8-yf5 " fill="#8e8e8e" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M45 1.5H3c-.8 0-1.5.7-1.5 1.5v42c0 .8.7 1.5 1.5 1.5h42c.8 0 1.5-.7 1.5-1.5V3c0-.8-.7-1.5-1.5-1.5zm-40.5 3h11v11h-11v-11zm0 14h11v11h-11v-11zm11 25h-11v-11h11v11zm14 0h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11zm14 28h-11v-11h11v11zm0-14h-11v-11h11v11zm0-14h-11v-11h11v11z" fill-rule="evenodd"></path></svg>
                                <div class="tooltip_notif">
                                    <span class="tooltip_text nowrap">♡ Posts</span>
                                </div>
                            </template>
                            <div class="post_history_wrapper">
                                <div v-for="(likedPost, key) in user.liked_posts" :key="key" class="post_history" >
                                    <img v-b-modal.image_modal @click="showImage"  v-if="likedPost.media_type == 'image'"  :src="likedPost.media_file" :data-postId="likedPost.id" class="w-full h-100"/>
                                    <video v-else-if="likedPost.media_type == 'video'" controls muted class="w-full h-100">
                                    <source :src="likedPost.media_file"  />
                                    </video>
                                </div>
                            </div>
                        </b-tab>
                        <b-tab>
                            <template v-slot:title>
                                <svg aria-label="Comment" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path clip-rule="evenodd" d="M47.5 46.1l-2.8-11c1.8-3.3 2.8-7.1 2.8-11.1C47.5 11 37 .5 24 .5S.5 11 .5 24 11 47.5 24 47.5c4 0 7.8-1 11.1-2.8l11 2.8c.8.2 1.6-.6 1.4-1.4zm-3-22.1c0 4-1 7-2.6 10-.2.4-.3.9-.2 1.4l2.1 8.4-8.3-2.1c-.5-.1-1-.1-1.4.2-1.8 1-5.2 2.6-10 2.6-11.4 0-20.6-9.2-20.6-20.5S12.7 3.5 24 3.5 44.5 12.7 44.5 24z" fill-rule="evenodd"></path></svg>
                                <div class="tooltip_notif">
                                    <span class="tooltip_text">♡ Comments</span>
                                </div>
                            </template>
                            <div class="liked_comments flex mt-2 pb-2 border-bottom"  v-for="(likedComment, key) in user.liked_comments" :key="key"  >
                                <img class="pfp rounded-circle" :src="likedComment.user.pfp"/>
                                <div class="pr-3 pl-1">
                                    <span class="username font-weight-bold pb-2">{{likedComment.user.username}}</span>
                                    <span >{{likedComment.content}}</span>  
                                </div> 
                            </div>                     
                        </b-tab>
                    </b-tabs>
                </b-tab>
            </b-tabs>
        </div>

        <b-modal id="image_modal" body-class="relative" hide-header hide-footer centered>
            <!----><img :src="clickedImgSrc" alt="" class="Modal_image w-full h-100 hover:brightness-75 cursor-pointer">
            <router-link :to="'/post/'+postId" class="go_to_post hover:text-white"><i class="fas fa-long-arrow-alt-right"></i> Go to Post</router-link>
        </b-modal>
    </div>
</template>

<script>
import SearchComponent from './SearchComponent';

export default {
    data(){
        return {
            publicPath: 'http://localhost:8000/',
            user:'',
            sessionUserId: this.$sessionUserId,
            sessionUser: '',
            userId: '',
            postId:'',
            clickedImgSrc:'',
        }
    },

    watch: {
        '$route': {
            handler: 'updateProfile',
            immediate: true
        }
    },

    created: function () {
        if (this.sessionUserId) {
        axios
        .get(this.publicPath+"users/"+this.sessionUserId)
        .then((data) => { 
            this.sessionUser = data.data;
            if (!this.sessionUser.followed) {
                this.sessionUser.followed = [];
            }
        })
        .catch((err) => {});
        }

        this.userId = window.location.href.split("/")[3];
        // console.log(this.userId);
        // this.followUnfollow = _.debounce(this.followUnfollow, 300)
        axios
        .get(this.publicPath+"users/"+this.userId)
        .then((data) => { 
            this.user= data.data
                this.user.storiesType = [];
                this.user.postsType = [];
            this.user.posts.forEach(post => {
            if (post.type == "post") {
              this.user.postsType.push(post);
            } else if (post.type == "story") {
              this.user.storiesType.push(post);
            } else if (post.type == "post/story" || post.type == "story/post") {
              this.user.postsType.push(post);
              this.user.storiesType.push(post);
            }
                
            });
        })
        .catch((err) => {});
    },
    

    methods: {
        updateProfile(){
            if (this.sessionUserId) {
            axios
            .get(this.publicPath+"users/"+this.sessionUserId)
            .then((data) => { 
                this.sessionUser = data.data;
                if (!this.sessionUser.followed) {
                    this.sessionUser.followed = [];
                }
            })
            .catch((err) => {});
            }

            this.userId = window.location.href.split("/")[3];
            // console.log(this.userId);
            // this.followUnfollow = _.debounce(this.followUnfollow, 300)
            axios
            .get(this.publicPath+"users/"+this.userId)
            .then((data) => { 
                this.user= data.data
                    this.user.storiesType = [];
                    this.user.postsType = [];
                this.user.posts.forEach(post => {
                if (post.type == "post") {
                this.user.postsType.push(post);
                } else if (post.type == "story") {
                this.user.storiesType.push(post);
                } else if (post.type == "post/story" || post.type == "story/post") {
                this.user.postsType.push(post);
                this.user.storiesType.push(post);
                }
                    
                });
            })
            .catch((err) => {});
        },

        showImage(event) {
            // console.log(event.target.attributes['data-postId'].nodeValue);
            this.clickedImgSrc=event.target.attributes.src.nodeValue
            this.postId=event.target.attributes['data-postId'].nodeValue
        },

        followUnfollow(event) {
            let userFollowId;
            let userFollowAttrId;
          
            if (typeof $(event.target).attr("id") == 'undefined') {
                // console.log($(event.target.parentElement));
                userFollowAttrId = $(event.target.parentElement);
                userFollowId = $(event.target.parentElement).attr("id").replace(/[^0-9]/g, '');;
            } else {
                // console.log($(event.target));
                userFollowAttrId = $(event.target).attr("id");
                userFollowId = $(event.target).attr("id").replace(/[^0-9]/g, '');;
            }

            //  check if the post is already liked by the user
            if (this.sessionUser.followed.includes(parseInt(userFollowId))) {
                // apply the laravel unlike function
                axios
                    .get(this.publicPath+"users/" +userFollowId +"/" 
                    +this.sessionUser.id +"/unfollow")
                    .then((response) => {
                    
                    // get the index of the user id we want to delete
                    let index = this.sessionUser.followed.indexOf(
                        parseInt(userFollowId)
                    );

                    if (this.sessionUser.followed.includes(parseInt(userFollowId))){
                        //  remove it from the followedUsersId array
                        this.sessionUser.followed.splice(index, 1)
                        $("#" + userFollowAttrId)[0].innerHTML = 'Follow' 
                    
                    }
                    
                    
                    });
            } else {
                // apply the laravel follow function
                axios
                .get(this.publicPath+"users/" + userFollowId + "/" + this.sessionUser.id + "/follow" )
                .then((response) => {
                    
                    if (!this.sessionUser.followed.includes(parseInt(userFollowId))){
                        // add the user id to the followedUsersId array
                        this.sessionUser.followed.push(
                        parseInt(userFollowId)
                        )
                        $("#" + userFollowAttrId)[0].innerHTML = 'Unfollow' 
                                    

                    }
                    
                });
                        
                
                
            }
        },

        goToProfile(){
            this.$router.push({path : '/profile/edit'})
            // window.location.replace('http://localhost:8000/profile/edit')
        }
        
    },

    components: {
        SearchComponent,
        
    }

}
</script>