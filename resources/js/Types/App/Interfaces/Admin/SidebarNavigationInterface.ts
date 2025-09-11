import type { Component } from 'vue';

export interface SidebarNavigationInterface {
    name: string;
    route: string;
    icon: Component;
    current: boolean;
}
