import React from "react";
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger, DropdownMenuLabel, DropdownMenuSeparator, DropdownMenuItem } from "./ui/dropdown-menu";
import { Link } from "@inertiajs/react";
import hasAnyPermission from "@/utils/has-permission";
import { Ellipsis, Edit, Trash, CircleArrowRight } from "lucide-react";

export interface ActionButtonProps {
    isModal: boolean;
    withEdit?: boolean;
    withDetail?: boolean;
    withDelete?: boolean;
    actionEdit?: () => void;
    actionDelete?: () => void;
    actionEditHref?: string;
    actionDetailHref?: string;
    permissionPrefix: string;
    children: React.ReactNode;
}

export function ActionButton({
    withDetail = false,
    withEdit = true,
    withDelete = true,
    isModal = false,
    actionEdit,
    actionDetailHref = '',
    actionEditHref = '',
    actionDelete,
    permissionPrefix,
    children,
}: ActionButtonProps) {
    return (
        <DropdownMenu>
            <DropdownMenuTrigger className="focus-within:outline-none">
                <Ellipsis />
            </DropdownMenuTrigger>
            <DropdownMenuContent side="left" align="start">
                <DropdownMenuLabel>Aksi</DropdownMenuLabel>
                <DropdownMenuSeparator />
                {children}
                {withDetail && hasAnyPermission()}
            </DropdownMenuContent>
        </DropdownMenu>
    )
}
