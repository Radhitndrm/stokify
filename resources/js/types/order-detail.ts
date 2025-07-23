import { Order } from "./order";
import { ProductUnit } from "./product-unit";

export interface OrderDetail {
    id: number;
    order: Order;
    product_unit: ProductUnit;
    quantity: number;
    unit_price: number;
    [key: string]: any;
}

export interface OrderDetailLink {
    url: string | null;
    label: string;
    active: boolean;
}
