import type { Component } from 'vue';

export interface SidebarNavigationInterface {
    name: string;
    href: string;
    icon: Component;
    current: boolean;
}
