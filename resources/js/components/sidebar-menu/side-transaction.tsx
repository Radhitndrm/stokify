import { ReceiptText, ShoppingBag } from "lucide-react";
import { SidebarGroup, SidebarGroupLabel, SidebarGroupContent, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from "../ui/sidebar";
import { Link } from "@inertiajs/react";
import hasAnyPermission from "@/utils/has-permission";

type sideTransactionProps = {
    url: string;
    setOpenMobile: (open: boolean) => void
}

export function SideTransaction({ url, setOpenMobile }: sideTransactionProps) {
    return (
        <SidebarGroup>
            {(hasAnyPermission(['sales-data']) || hasAnyPermission(['orders-data'])) && (
                <SidebarGroupLabel>Transaksi</SidebarGroupLabel>
            )}
            <SidebarGroupContent>
                <SidebarMenu>
                    {hasAnyPermission(['sales-data']) &&
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Penjualan"}>
                                <Link href='' onClick={() => setOpenMobile(false)}>
                                    <ReceiptText />
                                    <span>Penjualan</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    }
                    {hasAnyPermission(['orders-data']) &&
                        <SidebarMenuItem>
                            <SidebarMenuButton asChild tooltip={"Pembelian"}>
                                <Link href='' onClick={() => setOpenMobile(false)}>
                                    <ShoppingBag />
                                    <span>Pembelian</span>
                                </Link>
                            </SidebarMenuButton>
                        </SidebarMenuItem>
                    }
                </SidebarMenu>
            </SidebarGroupContent>
        </SidebarGroup>
    );
}
