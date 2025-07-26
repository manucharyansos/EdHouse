<template>
    <header class="w-full header_section z-40 " :class="{ 'scrolled': isScrolled }">
        <div id="particles-js" class="particles-bg"></div>
        <nav class="header w-full text-sm sticky top-0 px-4 lg:px-6 py-2.5 dark:bg-gray-800"
             :class="{ 'bg-opacity-100': isScrolled }">
            <div class="w-full flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <div class="float-left">
                    <Link :href="route('home')">
                        <img src="/logo.png" alt="Logo" class="h-20 rounded-3xl" />
                    </Link>
                </div>

                <div class="flex items-center lg:order-2">
                    <button @click="toggleMenu" type="button"
                            class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                            aria-controls="mobile-menu-2" :aria-expanded="isMenuOpen">
                        <span class="sr-only">Open main menu</span>
                        <svg v-if="!isMenuOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <svg v-else class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                  clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="mobile-menu" :class="{ 'open': isMenuOpen, 'scrolled': isScrolled }" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:mt-0 text-lg font-sans italic">
                        <li>
                            <Link :href="route('services.index')" @click="closeMenu">Ծառայություններ</Link>
                        </li>
                        <li>
                            <Link :href="route('about')" @click="closeMenu">Մեր մասին</Link>
                        </li>
                        <li>
                            <Link :href="route('contact')" @click="closeMenu">Կապ մեզ հետ</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ref, onMounted, onUnmounted } from 'vue';

const isScrolled = ref(false);
const isMenuOpen = ref(false);

const handleScroll = () => {
    isScrolled.value = window.scrollY > 500;
};

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};

onMounted(() => {
    window.addEventListener('scroll', handleScroll);

    if (window.particlesJS) {
        particlesJS.load('particles-js', '/assets/particles.json', () => {
            console.log('Particles.js loaded ✨');
        });
    }
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<style scoped>
.particles-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100px; /* հարմարվող՝ այնքան, ինչքան քո header-ը */
    z-index: -1;
    opacity: 0.6;
    pointer-events: none;
    transition: opacity 0.3s ease-in-out;
}

.header_section.scrolled .particles-bg {
    opacity: 0.9;
}
.header_section {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 999;
    transition: background-color 0.3s ease;
}

.header {
    width: 100%;
    height: 100px;
    background: rgba(28, 28, 26, 0.5);
    display: flex;
    align-items: center;
    z-index: 222;
    transition: background-color 0.3s ease;
}

.header.bg-opacity-100,
.header_section.scrolled .header {
    background: rgba(28, 28, 26, 0.9);
}


/* Mobile menu styles */
.mobile-menu {
    position: fixed;
    top: 100px;
    right: 0;
    width: 75%;
    max-width: 300px;
    height: calc(100vh - 100px);
    background: rgba(28, 28, 26, 0.5);
    transform: translateX(100%);
    transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out, background-color 0.3s ease;
    z-index: 998;
    opacity: 0;
    visibility: hidden;
}

.mobile-menu.open {
    transform: translateX(0); /* Slide in from right */
    opacity: 1;
    visibility: visible;
}

.mobile-menu.scrolled {
    background: rgba(28, 28, 26, 0.9); /* Matches header's scrolled background */
}

.mobile-menu ul {
    flex-direction: column;
    padding: 1.5rem;
}

.mobile-menu li {
    margin: 1.2rem 0;
}

.mobile-menu a {
    color: white;
    font-size: 1.25rem;
    display: block;
    padding: 0.5rem;
    transition: color 0.2s ease;
}

.mobile-menu a:hover {
    color: #60a5fa; /* Tailwind blue-400 */
}

@media (min-width: 1024px) {
    .mobile-menu {
        display: flex;
        justify-content: flex-end; /* Align items to the right */
        position: static;
        transform: none;
        opacity: 1;
        visibility: visible;
        max-width: none;
        height: auto;
        background: transparent;
        width: auto;
        margin-left: auto;
    }

    .mobile-menu.scrolled {
        background: transparent; /* No background on desktop */
    }

    .mobile-menu ul {
        flex-direction: row;
        padding: 0;
        gap: 0.5rem; /* Tight spacing for side-by-side items */
        align-items: center;
    }

    .mobile-menu li {
        margin: 0;
    }

    .mobile-menu a {
        font-size: 1.25rem; /* Slightly smaller for desktop */
        padding: 0.25rem;
    }
}
</style>
