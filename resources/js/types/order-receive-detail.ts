import { OrderDetail } from "./order-detail";
import { OrderReceive } from "./order-receive";

export interface OrderReceiveDetail {
    id: number;
    order_receive: OrderReceive;
    order_detail: OrderDetail;
    [key: string]: any;
}

export interface OrderReceiveDetailLink {
    url: string | null;
    label: string;
    active: boolean;
}
