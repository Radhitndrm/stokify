import { ChartNoAxesCombined } from "lucide-react";
import { SidebarGroup, SidebarGroupContent, SidebarGroupLabel, SidebarMenu, SidebarMenuItem, SidebarMenuButton } from "../ui/sidebar";
import { Link } from "@inertiajs/react";

type sideStatProps = {
    url: string
    setOpenMobile: (open: boolean) => void
}

export function SideStat({ url, setOpenMobile }: sideStatProps) {
    return (
        <SidebarGroup>
            <SidebarGroupLabel>Stats</SidebarGroupLabel>
            <SidebarGroupContent>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton asChild tooltip={"Dashboard"} isActive={url === '/apps/dashboard'}>
                            <Link href={route('apps.dashboard')} onClick={() => setOpenMobile(false)}>
                                <ChartNoAxesCombined />
                                <span>Dashboard</span>
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    );
}
