$(function () {

  var goToCartIcon = function($addTocartBtn){
    var $cartIcon = $(".my-cart-icon");
    var $image = $('<img width="30px" height="30px" src="' + $addTocartBtn.data("image") + '"/>').css({"position": "absolute", "z-index": "10000", "top" : $addTocartBtn.offset().top, "left" : $addTocartBtn.offset().left}).appendTo('body');

    //$addTocartBtn.prepend($image);
    var position = $cartIcon.offset();
    console.log($cartIcon.parent());

    $image.animate({
      top : position.top,
      left : position.left
    }, 200 , "swing", function() {
      $cartIcon.parent().effect("bounce", {
                  times: 2
              }, 400);
      $image.remove();
    });
  }

  $('.my-cart-btn').myCart({
    currencySymbol: '$',
    classCartIcon: 'my-cart-icon',
    classCartBadge: 'my-cart-badge',
    classProductQuantity: 'my-product-quantity',
    classProductRemove: 'my-product-remove',
    classCheckoutCart: 'my-cart-checkout',
    affixCartIcon: true,
    showCheckoutModal: true,
    numberOfDecimals: 2,
    cartItems: cart["products"],
    clickOnAddToCart: function($addTocart){
      goToCartIcon($addTocart);
    },
    afterAddOnCart: function(products, totalPrice, totalQuantity) {
      console.log("afterAddOnCart", products, totalPrice, totalQuantity);
      var contents = JSON.stringify({products: products, totalPrice: totalPrice, totalQuantity: totalQuantity});
      $.ajax({
        data: {cart_contents: cart_contents},
        url: 'store_cart.php'
      });
    },
    clickOnCartIcon: function($cartIcon, products, totalPrice, totalQuantity) {
      console.log("cart icon clicked", $cartIcon, products, totalPrice, totalQuantity);
    },
    checkoutCart: function(products, totalPrice, totalQuantity) {
      var checkoutString = "Total Price: " + totalPrice + "\nTotal Quantity: " + totalQuantity;
      checkoutString += "\n\n id \t name \t\t\t\t  price \t\t\t quantity";
      $.each(products, function(){
        checkoutString += ("\n " + this.id + " \t " + this.name + " \t \t\t  " + this.price + " \t\t\t\t " + this.quantity);
      });
      alert(checkoutString)
      console.log("checking out", products, totalPrice, totalQuantity);
      var data = {products: products, totalPrice: totalPrice, totalQuantity: totalQuantity};
      window.location.href = "transfer.php?data=" + JSON.stringify(data);
    },
    getDiscountPrice: function(products, totalPrice, totalQuantity) {
      console.log("calculating discount", products, totalPrice, totalQuantity);
      return totalPrice * 0.5;
    }
  });


});
