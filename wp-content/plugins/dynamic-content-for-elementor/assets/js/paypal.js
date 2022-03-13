function initializePayPalButtons(w) {
    let buttons = w.querySelector(".dce-paypal-buttons")
    if ( typeof paypal === "undefined" ) {
        buttons.textContent = "There was an error loading PayPal. Is the PayPal Client ID valid?";
    } else {
        let orderIDInput =  w.querySelector("input");
        let approvedMsg =   w.querySelector(".dce-paypal-approved")
        let buttonsID =     `#${buttons.getAttribute('id')}`;
        let orderName =     buttons.getAttribute('data-name');
        let orderCurrency = buttons.getAttribute('data-currency');
        let orderValue =    buttons.getAttribute('data-value');
        let description =   buttons.getAttribute('data-description');
        let sku =           buttons.getAttribute('data-sku');
        let height =        parseInt(buttons.getAttribute('data-height'));
        paypal.Buttons({
            style: {
                layout: 'horizontal',
                height: height,
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        items: [
                            {
                                name: orderName,
                                sku: sku,
                                description: description,
                                unit_amount: {
                                    currency_code: orderCurrency,
                                    value: orderValue
                                },
                                quantity: '1'
                            }
                        ]
                        ,
                        amount: {
                            value: orderValue,
                            breakdown: { item_total: {
                                value: orderValue,
                                currency_code: orderCurrency
                            } }
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                orderIDInput.value = data.orderID;
                buttons.style.display = "none";
                approvedMsg.style.display = "block";
            }
        }).render(buttonsID);
    }
};

function initializeAllPayPalButtons($scope) {
    $scope.find('.elementor-field-type-dce_form_paypal').each((_, w) => initializePayPalButtons(w));
}

jQuery(window).on('elementor/frontend/init', function() {
    elementorFrontend.hooks.addAction('frontend/element_ready/form.default', initializeAllPayPalButtons);
});
