<?php

namespace App\Models;

use App\Events\ProductCreating;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
  protected $guarded = ['id'];

  protected $hidden = ['created_at', 'updated_at'];

  protected static function boot() {
    parent::boot();

    static::creating(function ($product) {
      static::onCreating($product);
    });

    static::updating(function ($product) {
      static::onUpdating($product);
    });
  }

  public static function onCreating(&$product) {
    static::prepareCategory($product);
    static::prepareNumeric($product);
    static::generateSku($product);
  }

  public static function onUpdating(&$product) {
    static::prepareCategory($product);
    static::prepareNumeric($product);
  }

  protected static function prepareCategory(&$product) {
    if (!empty($product->category)) {
      $product->category = strtoupper($product->category);
    }
  }

  protected static function prepareNumeric(&$product) {
    if (!empty($product->price)) {
      $product->price = (int) $product->price;
    }

    if (!empty($product->stock)) {
      $product->stock = (int) $product->stock;
    }
  }

  protected static function generateSku(&$product) {
    if (!empty($product->category)) {
      $latestProduct = static::where(['category' => $product->category])
        ->orderBy('id', 'desc')
        ->first(['sku']);

      $sku = $latestProduct ? $latestProduct->sku : 'NULL-000';

      $highestSku = (int) explode('-', $sku)[1];

      $product->sku = substr($product->category, 0, 3)
        . '-'
        . str_pad(++$highestSku, 3, '0', STR_PAD_LEFT);
    }
  }
}
