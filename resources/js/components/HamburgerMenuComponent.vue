<template>
    <div id ="menu">
        <header class="container mx-auto text-teal-400 w-full relative">
            <div class="flex justify-between items-center w-full">
                <div>
                    <button @click="isOpen = !isOpen" class="navItems:outline-none relative">
                        <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                            <path v-show="!isOpen" d="M24 6h-24v-4h24v4zm0 4h-24v4h24v-4zm0 8h-24v4h24v-4z" fill="#FFDDFF" />
                            <path v-show="isOpen" d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" fill="#FFDDFF"/>
                        </svg>                       
                    </button>
                </div>
            </div>
            <div :class="isOpen ? 'block hamburgerOpen' : 'hidden'" class="bg-rose-200 absolute">
                <ul class="items-center text-center text-[#FF6347]">
                    <li class="border-b border-white md:border-none"><a :href="mypage" class="block px-8 py-2 my-4 rounded md:font-medium">マイページ</a></li>
                    <li class="border-b border-white md:border-none"><a :href="sharedPlans" class="block px-8 py-2 my-4 rounded md:font-medium">投稿</a></li>
                    <li class="border-b border-white md:border-none"><a :href="inquiryForm" class="block px-8 py-2 my-4 rounded md:font-medium">お問い合わせ</a></li>
                </ul>
            </div>
        </header>
    </div>
</template>
<script>
    export default {
        name: "HamburgerMenuComponent",
        data () {
            return {
                isOpen: false,
                mypage: '/users/showMypage',
                sharedPlans: '/users/sharedPlans',
                inquiryForm: '/users/inquiry',
            }
        },
    }
</script>