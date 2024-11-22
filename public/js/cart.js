let selectedCartIds = JSON.parse(localStorage.getItem('selectedCartIds')) || [];
const selectAllCheckbox = document.querySelector('.checkbox-all');
const checkboxes = document.querySelectorAll('.cart-checkbox');
document.querySelectorAll('.cart-item-center__quantity').forEach(countdown => {
    const prev = countdown.querySelector('#prev');
    const add = countdown.querySelector('#add');
    const quantityInput = countdown.querySelector('#quantity');
    prev.onclick = () => {
        var currentValue = parseInt(quantityInput.value);
        if (currentValue > 1) {
            quantityInput.value = currentValue - 1;
            updateHidden(prev, quantityInput.value);
        }
    }
    add.onclick = () => {
        var currentValue = parseInt(quantityInput.value);
        quantityInput.value = currentValue + 1;
        updateHidden(add, quantityInput.value);
    }
});

function updateHidden(element, quantity) {
    const cartId = element.dataset.cartId;
    const productId = element.dataset.product_id;
    document.getElementById('hiddenCartId').value = cartId;
    document.getElementById('hiddenProductId').value = productId;
    document.getElementById('hiddenQuantity').value = quantity;
    document.getElementById('updateCartForm').submit();
}
checkboxes.forEach(checkbox => {
    const cartId = checkbox.getAttribute('data-cart-id');
    if (selectedCartIds.includes(cartId)) {
        checkbox.checked = true;
    }
});
if (checkboxes.length === selectedCartIds.length) {
    selectAllCheckbox.checked = true;
}
selectAllCheckbox.addEventListener('change', (event) => {
    const isChecked = event.target.checked;
    checkboxes.forEach(checkbox => {
        checkbox.checked = isChecked;
        const cartId = checkbox.getAttribute('data-cart-id');
        if (isChecked) {
            if (!selectedCartIds.includes(cartId)) {
                selectedCartIds.push(cartId);
            }
        } else {
            selectedCartIds = [];
        }
    });
    localStorage.setItem('selectedCartIds', JSON.stringify(selectedCartIds));
    sendCartIds();
});

checkboxes.forEach(checkbox => {
    checkbox.addEventListener('change', (event) => {
        const cartId = event.target.getAttribute('data-cart-id');
        if (event.target.checked) {
            if (!selectedCartIds.includes(cartId)) {
                selectedCartIds.push(cartId);
            }
        } else {
            selectedCartIds = selectedCartIds.filter(id => id !== cartId);
            selectAllCheckbox.checked = false;
        }

        if (checkboxes.length === selectedCartIds.length) {
            selectAllCheckbox.checked = true;
        }
        localStorage.setItem('selectedCartIds', JSON.stringify(selectedCartIds));
        sendCartIds();
    });
});

function buyProduct() {
    document.getElementById('sendIdsInput').value = JSON.stringify(selectedCartIds);
    document.getElementById('sendIdsForm').submit();
}

function sendCartIds() {
    document.getElementById('selectedIds').value = JSON.stringify(selectedCartIds);
    document.getElementById('myForm').submit();
}

function goToCheckout() {
    document.getElementById('selectedIds').value = JSON.stringify(selectedCartIds);
    if (selectedCartIds.length === 0) {
        alert("Vui lòng chọn ít nhất một sản phẩm để thanh toán.");
        return;
    }
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = './index.php?id=11';

    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = 'selectedCartIds';
    input.value = JSON.stringify(selectedCartIds);

    form.appendChild(input);
    document.body.appendChild(form);
    form.submit();
}

window.addEventListener('load', () => {
    if (!localStorage.getItem('selectedCartIds')) {
        selectedCartIds = [];
        selectAllCheckbox.checked = false;
        checkboxes.forEach(checkbox => {
            checkbox.checked = false;
        });
    }
})