import { PackageCheck, PackagePlus } from "lucide-react";
import { SidebarMenu, SidebarMenuItem, SidebarMenuButton, SidebarGroup, SidebarGroupLabel, SidebarGroupContent } from "../ui/sidebar";
import hasAnyPermission from "@/utils/has-permission";
type sideStockProps = {
    url: string,
    setOpenMobile: (open: boolean) => void
}
import { Link } from "@inertiajs/react";

export function SideStock({ url, setOpenMobile }: sideStockProps) {
    return (
        <SidebarGroup>
            {(hasAnyPermission(['stocks-data']) || hasAnyPermission(['order-receives-data'])) && (
                <SidebarGroupLabel>Manajemen Stok</SidebarGroupLabel>
            )}
            <SidebarGroupContent>
                <SidebarMenu>
                    {hasAnyPermission(['stocks-data']) && (
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Stok Awal"}>
                                <Link href='' onClick={() => setOpenMobile(false)}>
                                    <PackagePlus />
                                    <span>Stok Awal</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    )}
                    {hasAnyPermission(['order-receives-data']) && (
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Penerimaan"}>
                                <Link href='' onClick={() => setOpenMobile(false)}>
                                    <PackageCheck />
                                    <span>Penerimaan</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    )}
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    );
}
