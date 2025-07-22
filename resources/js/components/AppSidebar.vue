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
        title: 'Admin',
        href: '/admin',
        icon: LayoutGrid,
    },
    {
        title: 'History',
        icon: BookOpen,
        items: [
            {
                title: 'History Page',
                href: '/admin/history',
            },
            {
                title: 'Create History',
                href: '/admin/about/create',
            },
        ],
    },
    {
        title: 'Services',
        icon: Folder,
        items: [
            {
                title: 'Services Page',
                href: '/admin/services/admin',
            },
            {
                title: 'Create Services',
                href: '/admin/services/create',
            },
        ],
    },
    {
        title: 'Contact Messages',
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
