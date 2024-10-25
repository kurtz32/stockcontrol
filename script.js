// Initialize stock array
let stockItems = [];

// Function to render stock items
function renderStockItems(filter = '') {
    const stockTableBody = document.querySelector('#stock-table tbody');
    stockTableBody.innerHTML = ''; // Clear existing items

    stockItems.forEach((item, index) => {
        // Filter items based on the search input
        if (item.name.toLowerCase().includes(filter.toLowerCase())) {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.name}</td>
                <td>${item.quantity}</td>
                <td>
                    <input type="number" min="1" id="quantity-decrease-${index}" placeholder="Amount to Decrease" />
                    <button class="minus-button" onclick="decreaseStockItem(${index})">Decrease</button>
                </td>
            `;
            stockTableBody.appendChild(row);
        }
    });
}

// Function to add a new stock item
document.getElementById('stock-form').addEventListener('submit', function(event) {
    event.preventDefault();

    const itemName = document.getElementById('item-name').value.trim();
    const itemQuantity = parseInt(document.getElementById('item-quantity').value);

    // Check if the item already exists
    const existingItemIndex = stockItems.findIndex(item => item.name.toLowerCase() === itemName.toLowerCase());

    if (existingItemIndex > -1) {
        // Item exists, update quantity
        stockItems[existingItemIndex].quantity += itemQuantity;
    } else {
        // New item, add to stock
        const newItem = {
            name: itemName,
            quantity: itemQuantity,
        };
        stockItems.push(newItem);
    }

    renderStockItems(); // Render updated stock items

    // Clear input fields
    this.reset();
});

// Function to decrease stock quantity
function decreaseStockItem(index) {
    const decreaseAmountInput = document.getElementById(`quantity-decrease-${index}`);
    const decreaseAmount = parseInt(decreaseAmountInput.value);

    if (decreaseAmount > 0 && stockItems[index].quantity >= decreaseAmount) {
        stockItems[index].quantity -= decreaseAmount; // Decrease by specified amount
    } else {
        alert('Invalid amount to decrease.');
    }
    renderStockItems(); // Render updated stock items
}

// Function to search for items
function searchItems() {
    const searchInput = document.getElementById('search-input').value;
    renderStockItems(searchInput); // Render stock items based on search input
}

// Initial render
renderStockItems();