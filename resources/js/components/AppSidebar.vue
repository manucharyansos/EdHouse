<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { BookOpen, Folder, LayoutGrid } from 'lucide-vue-next';
import AppLogo from './AppLogo.vue';

const mainNavItems: NavItem[] = [
    {
        title: 'Ադմին',
        href: '/admin',
        icon: LayoutGrid,
    },
    {
        title: 'Պատմություն',
        href: '/admin/history',
        icon: BookOpen,
    },
    {
        title: 'Խառայություններ',
        href: '/admin/services/admin',
        icon: Folder,
    },
    {
        title: 'Պռոեկտներ',
        href: '/admin/projects',
        icon: Folder,
    },
    {
        title: 'Նորություններ',
        href: '/admin/news',
        icon: LayoutGrid,
    },
    {
        title: 'Կոնտակտային հաղորդագրություններ',
        href: '/admin/contact-messages',
        icon: LayoutGrid,
    },
];
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('admin')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="mainNavItems" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
