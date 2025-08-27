import { Users2, UserCog, UserRoundCheck } from "lucide-react";
import { SidebarMenu, SidebarMenuItem, SidebarMenuButton, SidebarGroup, SidebarGroupLabel, SidebarGroupContent } from "../ui/sidebar";
import { Link } from "@inertiajs/react";
import hasAnyPermission from "@/utils/has-permission";

type sideUserManegementProps = {
    url: string;
    setOpenMobile: (open: boolean) => void

}

export function SideUserManagement({ url, setOpenMobile }: sideUserManegementProps) {
    return (
        <SidebarGroup>
            {(hasAnyPermission(['permissions-data']) || hasAnyPermission(['users-data']) || hasAnyPermission(['roles-data'])) && (
                <SidebarGroupLabel>Manajemen Pengguna</SidebarGroupLabel>
            )}
            <SidebarGroupContent>
                <SidebarMenu>
                    {hasAnyPermission(['permissions-data']) && (
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Hak Akses"} isActive={url.startsWith('/apps/permissions')}>
                                <Link href={route('apps.permissions.index')} onClick={() => setOpenMobile(false)}>
                                    <Users2 />
                                    <span>Hak Akses</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    )}
                    {hasAnyPermission(['roles-data']) && (
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Akses Group"} isActive={url.startsWith('/apps/roles')}>
                                <Link href={route('apps.roles.index')} onClick={() => setOpenMobile(false)}>
                                    <UserCog />
                                    <span>Akses Group</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    )}
                    {hasAnyPermission(['users-data']) && (
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Pengguna"} isActive={url.startsWith('/apps/users')}>
                                <Link href={route('apps.users.index')} onClick={() => setOpenMobile(false)}>
                                    <UserRoundCheck />
                                    <span>Pengguna</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    )}
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    );
}
