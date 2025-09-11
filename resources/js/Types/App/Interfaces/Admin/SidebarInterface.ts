import type { SidebarNavigationInterface } from '@/Types/App/Interfaces/Admin/SidebarNavigationInterface';

export interface SidebarInterface {
    navigation: SidebarNavigationInterface[];
    open?: boolean;
}
