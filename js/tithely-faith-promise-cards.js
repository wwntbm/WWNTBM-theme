(function($){
    $(document).ready(function(){
        updateTithelyButton();
        $('.fp-donation-input').on('change', updateTithelyButton);
    });

    function updateTithelyButton() {
        var cardStyleOption = $('select[name="card-style"]'),
            cardQuantityOption = $('select[name="card-quantity"]'),
            cardQuantityChoice = cardQuantityOption.find('option:selected'),
            shippingMethodOption = $('input[name="shipping-method"]:checked'),
            cardStyle = cardStyleOption.val(),
            cardQuantity = cardQuantityOption.val(),
            shippingMethod = shippingMethodOption.val(),
            printingCost = cardQuantityChoice.data('printing'),
            shippingPriorityCost = cardQuantityChoice.data('priority-cost'),
            shippingExpressCost = cardQuantityChoice.data('express-cost'),
            shippingCost = cardQuantityChoice.data(shippingMethodOption.val()+'-cost'),
            selectedOptions = ' - ' + cardStyle + ' style - ' + cardQuantity + ' quantity - ' + shippingMethod + ' shipping',
            totalAmount = Number(Number(printingCost) + Number(shippingCost)).toFixed(2);

        $('.fp-donation-input.priority .cost').html('$'+shippingPriorityCost);
        $('.fp-donation-input.express .cost').html('$'+shippingExpressCost);

        var buttonText = 'Donate $'+totalAmount+' to cover printing/shipping costs';

        $('.tithely-give-btn').text(buttonText).attr('data-giving-to', 'Faith Promise Cards'+selectedOptions).attr('data-amount', totalAmount);
    }
})(jQuery);
