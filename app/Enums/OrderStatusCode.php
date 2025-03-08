<?php

namespace App\Enums;

enum OrderStatusCode: string
{
    case Confirmed = 'confirmed';
    case CreatedShipment = 'shipped_to_warehouse';
    case Delivered = 'delivered';
    case OutforDelivery = 'out_for_delivery';
    case Cancelled = 'cancelled';
}
