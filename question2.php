<?php
// Problem 2 - Shopping Cart

class Product {

    public $name;
    public $price;
    public $quantity;
    public $total_discount;
    public $total_price;

    public function __construct($name, $price, $quantity)
    {
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->total_discount = 0;
        $this->totalPrice();
    }

    public function totalPrice()
    {
        $this->total_price = $this->price * $this->quantity - $this->total_discount;
    }
}

class Discount {

    public $name;
    public $type; // percentage or minus
    public $discount; // if percentage, 10 means 10%

    public function __construct($name, $type, $discount)
    {
        $this->name = $name;
        $this->type = $type;
        $this->discount = $discount;
    }
}

class Cart {

    private $products = [];
    private $discounts = [];

    // Get all products in cart
    public function getCart()
    {
      return $this->products;
    }

    public function addProduct($name, $price, $quantity)
    {
      $product = new Product($name, $price, $quantity);
      $this->products[] = $product;
      return $product;
    }

    public function removeProduct($name)
    {
      foreach ($this->products as $key => $product) {
        if ($product->name === $name) {
            unset($this->products[$key]);
            break;
        }
      }
    }

    public function editProduct($name, $quantity)
    {
      foreach ($this->products as $product) {
          if ($product->name === $name) {
              $product->quantity = $quantity;
              $product->totalPrice();
              break;
          }
      }
    }

    public function getDiscounts()
    {
      return $this->discounts;
    }

    public function addDiscount($name, $type, $discount)
    {
      $discount = new Discount($name, $type, $discount);
      $this->discounts[] = $discount;
      return $discount;
    }

    public function deleteDiscount($name)
    {
      foreach ($this->discounts as $key => $discount) {
          if ($discount->name === $name) {
              unset($this->discounts[$key]);
              break;
          }
      }
    }

    public function useDiscount(Product $product, Discount $discount)
    {
      if ($product->total_discount == 0) {  // can use only one discount
        if ($discount->type === 'percentage') {
          $product->total_discount += $product->price * (1 - $discount->discount / 100) * $product->quantity;
        } else {
          $product->total_discount += $discount->discount * $product->quantity;
        }

        if ($product->total_discount > $product->price * $product->quantity) { // total price cannot be negative
          $product->total_discount = $product->price * $product->quantity;
        }
        $product->totalPrice();
      } else {
        echo "One product for one discount, it will use the former one.";
      }
    }

    //  Remove discount from product
    public function removeDiscount(Product $product, Discount $discount) // 要同時刪掉 Product total discount
    {
      if ($product->total_discount != 0) {
        $product->total_discount = 0;
        $product->totalPrice();
      } else {
        echo "No discount for this product.";
      }
    }

    public function checkout()
    {
        $totalPrice = 0;

        foreach ($this->products as $product) {
            $product->totalPrice();
            $totalPrice += $product->total_price;
        }

        return $totalPrice;
    }
}