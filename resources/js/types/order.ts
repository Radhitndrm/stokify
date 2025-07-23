import { Supplier } from "./supplier";

export interface Order {
    id: number;
    order_code: string;
    supplier: Supplier;
    order_date: string;
    total_ammount: number;
    status: string;
    [key: string]: any;
}

export interface OrderLink {
    url: string | any;
    label: string;
    active: boolean;
}
