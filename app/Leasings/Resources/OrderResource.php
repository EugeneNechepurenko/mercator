<?php

namespace App\Leasings\Resources;

use App\Http\Resources\AuditResource;
use App\Portal\Http\Resources\V1\OfferAccessoryResource;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'number' => $this->number,
            'offerId' => $this->offer->id,
            'company' => CompanyResource::make($this->company),
            'product' => [
                'categoryId' => $this->productCategory->id,
                'brand' => $this->productBrand,
                'model' => $this->productModel,
                'color' => $this->productColor,
                'size' => $this->productSize,
            ],
            'supplier' => [
                'name' => $this->supplierName,
                'street' => $this->supplierStreet,
                'city' => $this->supplierCity,
                'postalCode' => $this->supplierPostalCode,
                'country' => $this->supplierCountry,
                'bankName' => $this->supplierBankName,
                'bankAccount' => $this->supplierBankAccount,
                'adminFullName' => $this->supplierAdminName,
                'phone' => $this->supplierPhone,
                'email' => $this->supplierEmail,
            ],
            'employee' => [
                'id' => $this->user->id,
                'name' => $this->employeeName,
                'salutation' => $this->employeeSalutation,
                'street' => $this->employeeStreet,
                'city' => $this->employeeCity,
                'postalCode' => $this->employeePostalCode,
                'email' => $this->employeeEmail,
                'phone' => $this->employeePhone,
                'number' => $this->employeeNumber,
            ],
            'pricing' => [
                'listPrice' => $this->productListPrice,
                'discountedPrice' => $this->productDiscountedPrice,
                'discount' => $this->productDiscount,
                'agreedPurchasePrice' => $this->agreedPurchasePrice,
                'accessoriesPrice' => $this->accessoriesPrice,
                'accessoriesDiscountedPrice' => $this->accessoriesDiscountedPrice,
            ],
            
            'accessories' => OfferAccessoryResource::collection($this->offer->accessories),
            'accessoriesText' => $this->notes,
            'creditNote' => $this->creditNoteFile ? "/leasings/orders/{$this->id}/credit-note" : null,
            'status' => StatusResource::make($this->status),
            'expiryDate' => $this->expiryDate,
            'deliveryDate' => $this->deliveryDate,
            'createdAt' => $this->created_at,
        ];
    }
}
