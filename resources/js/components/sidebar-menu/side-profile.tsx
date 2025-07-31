import { BadgeCheck, Bell, ChevronsUpDown, CreditCard, LogOut, Sparkles, Sun, Moon } from "lucide-react";
import { Avatar, AvatarFallback, AvatarImage } from "../ui/avatar";
import { DropdownMenu, DropdownMenuContent, DropdownMenuGroup, DropdownMenuLabel, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuTrigger } from "../ui/dropdown-menu";
import { SidebarMenu, SidebarMenuButton, SidebarMenuItem, useSidebar } from "../ui/sidebar";
import { Link, usePage } from "@inertiajs/react";
import { useTheme } from "../theme-provider";

export function SideProfile() {
    const { auth } = usePage().props
    const { isMobile } = useSidebar();
    const { theme, setTheme } = useTheme();

    return (
        <SidebarMenu>
            <SidebarMenuItem>
                <DropdownMenu>
                    <DropdownMenuTrigger asChild>
                        <SidebarMenuButton size="lg"
                            className="data-[state=open]:bg-side-accent data-[state=open]:text-sidebar-accent-foreground">
                            <Avatar className="h-8 w-8 rounded-full">
                                <AvatarImage src={auth.user.avatar}
                                    alt={auth.user.name}
                                />
                            </Avatar>
                            <div className="grid flex-1 text-left text-sm leading-light">
                                <span className="truncate font-semibold">{auth.user.name}</span>
                                <span className="truncate text-xs">{auth.user.email}</span>
                            </div>
                            <ChevronsUpDown className="ml-auto size-4" />
                        </SidebarMenuButton>
                    </DropdownMenuTrigger>

                </DropdownMenu>
            </SidebarMenuItem>
        </SidebarMenu>
    )
}

