<script setup lang="ts">
import { ref } from 'vue';
import { NavItem } from '@/types';
import { SidebarMenu, SidebarMenuButton, SidebarMenuItem, SidebarMenuSub, SidebarMenuSubButton, SidebarMenuSubItem } from '@/components/ui/sidebar';
import { Link } from '@inertiajs/vue3';
import { Collapsible, CollapsibleContent, CollapsibleTrigger } from '@/components/ui/collapsible';
import { ChevronRight } from 'lucide-vue-next';

defineProps<{
    items: NavItem[];
}>();

const openStates = ref<Record<string, boolean>>({});
</script>

<template>
    <SidebarMenu>
        <SidebarMenuItem v-for="item in items" :key="item.title">
            <Collapsible
                v-if="item.items && item.items.length"
                v-model="openStates[item.title]"
                class="w-full"
            >
                <CollapsibleTrigger as-child>
                    <SidebarMenuButton class="flex items-center justify-between w-full">
                        <div class="flex items-center gap-2">
                            <component :is="item.icon" v-if="item.icon" class="h-4 w-4" />
                            <span>{{ item.title }}</span>
                        </div>
                        <ChevronRight
                            class="h-4 w-4 transition-transform duration-200"
                            :class="{ 'rotate-90': openStates[item.title] }"
                        />
                    </SidebarMenuButton>
                </CollapsibleTrigger>
                <CollapsibleContent>
                    <SidebarMenuSub>
                        <SidebarMenuSubItem v-for="subItem in item.items" :key="subItem.title">
                            <SidebarMenuSubButton as-child>
                                <Link :href="subItem.href!">{{ subItem.title }}</Link>
                            </SidebarMenuSubButton>
                        </SidebarMenuSubItem>
                    </SidebarMenuSub>
                </CollapsibleContent>
            </Collapsible>

            <!-- If item has no sub-items, render a single link -->
            <SidebarMenuButton v-else as-child>
                <Link :href="item.href!">
                    <component :is="item.icon" v-if="item.icon" class="h-4 w-4" />
                    <span>{{ item.title }}</span>
                </Link>
            </SidebarMenuButton>
        </SidebarMenuItem>
    </SidebarMenu>
</template>
